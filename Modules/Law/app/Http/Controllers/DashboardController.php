<?php

namespace Modules\Law\Http\Controllers;

use Modules\Law\Models\CaseModel;
use Modules\Law\Models\CaseStage;
use Modules\Law\Models\CaseType;
use Modules\Law\Models\Court;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Permission\Traits\HasRoles;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        try {
            if ($user->hasRole('admin')) {
                // Admin dashboard: Show all cases and users
                $cases = CaseModel::with(['caseType', 'caseStage', 'court', 'user'])
                    ->orderBy('created_at', 'desc') // Newest first
                    ->get();
                $users = User::with('roles')->get();
                return view('law::dashboard.admin', compact('cases', 'users'));
            }

            // User dashboard: Show only user's cases
            $casesQuery = $user->cases();

            // Handle filters from query parameters
            $filter = $request->query('filter', 'all');

            // Apply filters
            if ($filter === 'today') {
                $casesQuery = $casesQuery->whereDate('next_date', Carbon::today());
            } elseif ($filter === 'tomorrow') {
                $casesQuery = $casesQuery->whereDate('next_date', Carbon::tomorrow());
            } elseif ($filter === 'week') {
                $casesQuery = $casesQuery->whereBetween('next_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            } elseif ($filter === 'month') {
                $casesQuery = $casesQuery->whereBetween('next_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
            } elseif ($filter === 'active') {
                $casesQuery = $casesQuery->where('status', 'active');
            } elseif ($filter === 'pending') {
                $casesQuery = $casesQuery->where('status', 'pending');
            } elseif ($filter === 'archived') {
                $casesQuery = $casesQuery->where('status', 'archived');
            }

            // Calculate counts
            $todayCount = $user->cases()->whereDate('next_date', Carbon::today())->count();
            $tomorrowCount = $user->cases()->whereDate('next_date', Carbon::tomorrow())->count();
            $weekCount = $user->cases()->whereBetween('next_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $monthCount = $user->cases()->whereBetween('next_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
            $activeCount = $user->cases()->where('status', 'active')->count();
            $pendingCount = $user->cases()->where('status', 'pending')->count();
            $archivedCount = $user->cases()->where('status', 'archived')->count();
            $totalCount = $user->cases()->count();

            // Fetch cases with sorting
            $cases = $casesQuery->with(['caseType', 'caseStage', 'court'])
                ->orderBy('created_at', 'desc') // Newest first
                ->get();

            // Format case data and add color class
            foreach ($cases as $case) {
                $case->display_case_title = ($case->client_name ?? 'N/A') . ' v ' . ($case->opponent_name ?? 'N/A');
                $case->display_court = $case->court->name ?? 'N/A';
                $case->display_prev_dt = $case->previous_date ? Carbon::parse($case->previous_date)->format('d/m/Y') : 'N/A';
                $case->display_next_dt = $case->next_date ? Carbon::parse($case->next_date)->format('d/m/Y') : 'N/A';
                $case->display_stage = $case->caseStage->name ?? 'N/A';

                // Add color class based on next_date
                if (!$case->next_date) {
                    $case->color_class = 'bg-gray-50 border-gray-300';
                } elseif (Carbon::parse($case->next_date)->isPast()) {
                    $case->color_class = 'bg-red-50 border-red-300';
                } elseif (Carbon::parse($case->next_date)->diffInDays(Carbon::now()) <= 3) {
                    $case->color_class = 'bg-yellow-50 border-yellow-300';
                } else {
                    $case->color_class = 'bg-green-50 border-green-300';
                }
            }

            return view('law::dashboard.user', compact(
                'cases',
                'todayCount',
                'tomorrowCount',
                'weekCount',
                'monthCount',
                'activeCount',
                'pendingCount',
                'archivedCount',
                'totalCount',
                'filter'
            ));
        } catch (\Exception $e) {
            return view('law::dashboard.user', [
                'cases' => collect(),
                'todayCount' => 0,
                'tomorrowCount' => 0,
                'weekCount' => 0,
                'monthCount' => 0,
                'activeCount' => 0,
                'pendingCount' => 0,
                'archivedCount' => 0,
                'totalCount' => 0,
                'errorMessage' => 'Something went wrong: ' . $e->getMessage(),
                'filter' => 'all'
            ]);
        }
    }

    // ---------------------------------form for create a court --------------------------------

    public function courtIndex()
    {
        $user = Auth::user();
        $courts = Court::all();
        return view('law::dashboard.cases.court.index', compact('courts'));
    }
    public function createCourt(Request $request)
    {
        $user = Auth::user();
        $courts = Court::all();
        return view('law::dashboard.cases.court.create', compact('courts'));
    }
    public function storeCourt(Request $request)
    {
        // কোর্ট নামের জন্য যথাযথ validation
        $request->validate([
            'name' => 'required|string|max:255|unique:courts,name',
        ]);

        // কোর্ট সেভ করুন
        Court::create([
            'name' => $request->input('name'),
        ]);

        // সফলতার মেসেজসহ রিডাইরেক্ট
        return redirect()->route('law.courts.create')->with('success', 'New court added successfully!');
    }
    // form for creating a case
    public function store(Request $request)
    {
        $request->validate([
            'court_id' => 'required|exists:courts,id',
            'name' => 'required|string|max:255',
        ]);
        if ($request->input('court_id') === 'add_new') {
            $court = Court::create([
                'name' => $request->input('new_court_name'),
            ]);
            $courtId = $court->getKey();
        } else {
            $courtId = $request->input('court_id');
        }
        // Court::create([
        //     'name' => $request->input('name'),
        // ]);

        CaseModel::create([
            'court_id' => $courtId,
        ]);
        return redirect()->route('law.cases.index')->with('success', 'Court created successfully!');
    }
    // --------------------------main Form-------------------
    public function caseIndex(Request $request)
    {
        $user = Auth::user();
        $query = CaseModel::with(['caseType', 'caseStage', 'court'])
            ->where('user_id', $user->getKey());

        // Filter logic
        $filter = $request->input('filter');
        if ($filter === 'active') {
            $query->where('status', 'active');
        } elseif ($filter === 'pending') {
            $query->where('status', 'pending');
        } elseif ($filter === 'decided') {
            $query->where('status', 'decided');
        } elseif ($filter === 'archived') {
            $query->where('status', 'archived');
        } elseif ($filter === 'date') {
            $query->orderBy('next_date');
        }
        // Custom filter (optional)
        if ($request->filled('custom')) {
            $query->where('case_title', 'like', '%' . $request->input('custom') . '%');
        }

        $storeCases = $query->get();

        // তারিখ ফরম্যাটিং (optional, যদি formatted_next_date ব্যবহার করেন)
        foreach ($storeCases as $case) {
            $case->formatted_next_date = (!empty($case->next_date) && is_string($case->next_date))
                ? \Carbon\Carbon::parse($case->next_date)->format('d/m/Y')
                : '-';
        }

        return view('law::dashboard.cases.index', compact('storeCases'));
    }
    public function caseCalendar()
    {
        $user = Auth::user();
        $cases = CaseModel::with(['caseType', 'caseStage', 'court'])
            ->where('user_id', $user->getKey())
            ->whereNotNull('next_date')
            ->get();

        // Format cases for calendar display
        $calendarEvents = [];
        foreach ($cases as $case) {
            if (!empty($case->next_date)) {
                $calendarEvents[] = [
                    'id' => $case->id,
                    'title' => ($case->client_name ?? 'N/A') . ' v ' . ($case->opponent_name ?? 'N/A'),
                    'start' => \Carbon\Carbon::parse($case->next_date)->format('Y-m-d'),
                    'case_no' => $case->court_case_number ?? 'N/A',
                    'court' => $case->court->name ?? 'N/A',
                    'stage' => $case->caseStage->name ?? 'N/A',
                    'url' => route('law.cases.show', $case->id)
                ];
            }
        }

        return view('law::dashboard.cases.calendar', compact('calendarEvents'));
    }
    public function casePrint()
    {
        $user = Auth::user();
        $cases = CaseModel::with(['caseType', 'caseStage', 'court'])
            ->where('user_id', $user->getKey())
            ->get();

        $pdf = PDF::loadView('law::dashboard.cases.print', compact('cases'));
        return $pdf->download('cases.pdf');
    }
    public function caseCreate()
    {
        $courts = Court::all();
        $caseTypes = CaseType::all();
        $caseStages = CaseStage::all();
        return view('law::dashboard.cases.create', compact('courts', 'caseTypes', 'caseStages'));
    }

    public function caseStore(Request $request)
    {
        // Validate the request
        $request->validate([
            'case_no' => 'required|string|max:255',
            'court_case_number' => 'required|string|max:255',
            'case_title' => 'required|string|max:255',
            'case_type' => 'required|exists:case_types,id',
            'case_stage' => 'required|exists:case_stages,id',
            'court_id' => 'required|exists:courts,id',
            'client_name' => 'required|string|max:255',
            'opponent_name' => 'required|string|max:255',
            'status' => 'required|in:pending,active,decided,archived',
        ]);

        // Parse dates in Y-m-d format (from form)
        $previousDate = $request->input('previous_date') ? Carbon::createFromFormat('Y-m-d', $request->input('previous_date'))->format('Y-m-d') : null;
        $nextDate = $request->input('next_date') ? Carbon::createFromFormat('Y-m-d', $request->input('next_date'))->format('Y-m-d') : null;
        $openingDate = $request->input('opening_date') ? Carbon::createFromFormat('Y-m-d', $request->input('opening_date'))->format('Y-m-d') : null;

        CaseModel::create([
            'user_id' => auth()->id(),
            'case_type_id' => $request->input('case_type'),
            'court_id' => $request->input('court_id'),
            'court_case_number' => $request->input('court_case_number'),
            'case_title' => $request->input('case_title'),
            'case_stage_id' => $request->input('case_stage'),
            'opening_date' => $openingDate,
            'previous_date' => $previousDate,
            'next_date' => $nextDate,
            'client_name' => $request->input('client_name'),
            'opponent_name' => $request->input('opponent_name'),
            'opponent_lawyer' => $request->input('opponent_lawyer'),
            'case_fee' => $request->input('case_fee') ?? 0,
            'notes' => $request->input('payment_history'),
            'office_file_number' => $request->input('case_no'),
            'status' => $request->input('status') ?? 'pending',
            'share_token' => null,
        ]);

        return redirect()->route('law.cases.create')->with('success', 'Case created successfully!');
    }

    public function searchCaseTypes(Request $request)
    {
        $query = $request->input('query', '');
        $caseTypes = CaseType::where('name', 'LIKE', "%{$query}%")->get(['id', 'name']);
        return response()->json($caseTypes);
    }

    public function addCaseType(Request $request)
    {
        $name = $request->input('name');
        if ($name) {
            $caseType = CaseType::create(['name' => $name]);
            return response()->json(['id' => $caseType->id, 'name' => $caseType->name]);
        }
        return response()->json(['error' => 'Name is required'], 400);
    }
    public function searchCaseStages(Request $request)
    {
        $query = $request->input('query', '');
        $caseStages = CaseStage::where('name', 'LIKE', "%{$query}%")->get(['id', 'name']);
        return response()->json($caseStages);
    }

    public function addCaseStage(Request $request)
    {
        $name = $request->input('name');
        if ($name) {
            $caseStage = CaseStage::create(['name' => $name]);
            return response()->json(['id' => $caseStage->id, 'name' => $caseStage->name]);
        }
        return response()->json(['error' => 'Name is required'], 400);
    }

    public function searchCourts(Request $request)
    {
        $query = $request->input('query', '');
        $courts = Court::where('name', 'LIKE', "%{$query}%")->get(['id', 'name']);
        return response()->json($courts);
    }

    public function addCourt(Request $request)
    {
        $name = $request->input('name');
        if ($name) {
            $court = Court::create(['name' => $name]);
            return response()->json(['id' => $court->id, 'name' => $court->name]);
        }
        return response()->json(['error' => 'Name is required'], 400);
    }

    public function caseShow(string $id)
    {
        $case = CaseModel::with(['caseType', 'caseStage', 'court'])->findOrFail($id);

        // তারিখ ফরম্যাটিং (caseStore এর মতো)
        $case->formatted_previous_date = !empty($case->previous_date) ? \Carbon\Carbon::parse($case->previous_date)->format('d/m/Y') : '-';
        $case->formatted_next_date = !empty($case->next_date) ? \Carbon\Carbon::parse($case->next_date)->format('d/m/Y') : '-';

        // সব ফিল্ড fallback সহ দেখানো (caseStore এর মতো)
        $case->case_type = $case->caseType->name ?? 'N/A';
        $case->case_no = $case->court_case_number ?? 'N/A';
        $case->case_title = $case->case_title ?? 'N/A';
        $case->case_stage = $case->caseStage->name ?? 'N/A';
        $case->court = $case->court->name ?? 'N/A';
        $case->client_name = $case->client_name ?? 'N/A';
        $case->opponent_name = $case->opponent_name ?? 'N/A';
        $case->opponent_lawyer = $case->opponent_lawyer ?? 'N/A';
        $case->case_fee = $case->case_fee ?? 0;
        $case->notes = $case->notes ?? '';
        $case->office_file_number = $case->office_file_number ?? 'N/A';

        return view('law::dashboard.cases.show', compact('case'));
    }
    public function caseDownload(CaseModel $case)
    {
        $user = Auth::user();

        // Security check
        if ($case->getAttribute('user_id') !== $user->getKey()) {
            abort(403, 'Unauthorized access to this case.');
        }

        $case->load(['caseType', 'caseStage', 'court']);

        $case->formatted_previous_date = !empty($case->previous_date) ? Carbon::parse((string) $case->previous_date)->format('d/m/Y') : 'N/A';
        $case->formatted_next_date = !empty($case->next_date) ? Carbon::parse((string) $case->next_date)->format('d/m/Y') : 'N/A';

        $case->case_type_name = $case->caseType->name ?? 'N/A';
        $case->case_stage_name = $case->caseStage->name ?? 'N/A';
        $case->court_name = $case->court->name ?? 'N/A';

        $pdf = Pdf::loadView('law::dashboard.cases.view', compact('case'));
        $pdf->setPaper('A4', 'portrait');
        $filename = 'Case_' . ($case->court_case_number ?? $case->getKey()) . '_' . date('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }
    public function caseShare($token)
    {
        $case = CaseModel::where('share_token', $token)
            ->with(['caseType', 'caseStage', 'court', 'attachments'])
            ->firstOrFail();
        return view('law::dashboard.cases.share', compact('case'));
    }
    public function caseEdit(CaseModel $case)
    {
        $user = Auth::user();

        // Check if user owns this case (security check)
        if ($case->user_id !== $user->getKey()) {
            abort(403, 'Unauthorized access to this case.');
        }

        $courts = Court::all();
        $caseTypes = CaseType::all();
        $caseStages = CaseStage::all();

        // Format dates for form display (d-m-Y format)
        $case->formatted_previous_date = !empty($case->previous_date) ? \Carbon\Carbon::parse($case->previous_date)->format('d-m-Y') : '';
        $case->formatted_next_date = !empty($case->next_date) ? \Carbon\Carbon::parse($case->next_date)->format('d-m-Y') : '';

        return view('law::dashboard.cases.edit', compact('case', 'caseStages', 'caseTypes', 'courts'));
    }
    public function caseUpdate(Request $request, CaseModel $case)
    {
        $user = Auth::user();

        // Check if user owns this case (security check)
        if ($case->user_id !== $user->getKey()) {
            abort(403, 'Unauthorized access to this case.');
        }

        $validated = $request->validate([
            'case_type' => 'required|exists:case_types,id',
            'case_no' => 'required|string|max:255',
            'case_title' => 'required|string|max:255',
            'case_stage' => 'required|exists:case_stages,id',
            'court_id' => 'required|exists:courts,id',
            'previous_date' => ['nullable', 'regex:/^(0?[1-9]|[12][0-9]|3[01])-(0?[1-9]|1[012])-\d{4}$/'],
            'next_date' => ['nullable', 'regex:/^(0?[1-9]|[12][0-9]|3[01])-(0?[1-9]|1[012])-\d{4}$/'],
            'client_name' => 'required|string|max:255',
            'opponent_name' => 'required|string|max:255',
            'opponent_lawyer' => 'nullable|string|max:255',
            'case_fee' => 'nullable|numeric|min:0',
            'payment_history' => 'nullable|string',
            'status' => 'nullable|string|in:pending,active,decided,archived',
        ]);

        // Convert date format from d-m-Y to Y-m-d for database storage
        $previousDate = $validated['previous_date'] ? Carbon::createFromFormat('d-m-Y', $validated['previous_date'])->format('Y-m-d') : null;
        $nextDate = $validated['next_date'] ? Carbon::createFromFormat('d-m-Y', $validated['next_date'])->format('Y-m-d') : null;

        $case->update([
            'case_type_id' => $validated['case_type'],
            'court_id' => $validated['court_id'],
            'court_case_number' => $validated['case_no'],
            'case_title' => $validated['case_title'],
            'case_stage_id' => $validated['case_stage'],
            'previous_date' => $previousDate,
            'next_date' => $nextDate,
            'client_name' => $validated['client_name'],
            'opponent_name' => $validated['opponent_name'],
            'opponent_lawyer' => $validated['opponent_lawyer'] ?? null,
            'case_fee' => $validated['case_fee'] ?? 0,
            'notes' => $validated['payment_history'] ?? null,
            'office_file_number' => $validated['case_no'],
            'status' => $validated['status'] ?? 'pending',
        ]);

        return redirect()->route('law.cases.show', $case->id)->with('success', 'Case updated successfully!');
    }
    public function caseDestroy(CaseModel $case)
    {
        $user = Auth::user();

        // Check if user owns this case (security check)
        if ($case->user_id !== $user->getKey()) {
            abort(403, 'Unauthorized access to this case.');
        }

        try {
            // Soft delete - sends to recycle bin instead of permanent deletion
            $case->delete();
            return redirect()->route('law.cases.index')->with('success', 'Case moved to recycle bin successfully!');
        } catch (\Exception $e) {
            return redirect()->route('law.cases.index')->with('error', 'Failed to move case to recycle bin: ' . $e->getMessage());
        }
    }
    public function recycleBin()
    {
        $user = Auth::user();

        // Get soft deleted cases for the authenticated user
        $deletedCases = CaseModel::onlyTrashed()
            ->with(['caseType', 'caseStage', 'court'])
            ->where('user_id', $user->getKey())
            ->get();

        // Format dates for display
        foreach ($deletedCases as $case) {
            $case->formatted_next_date = (!empty($case->next_date) && is_string($case->next_date))
                ? \Carbon\Carbon::parse($case->next_date)->format('d/m/Y')
                : '-';
        }

        return view('law::dashboard.cases.recycle-bin', compact('deletedCases'));
    }
    public function restoreCase($id)
    {
        $user = Auth::user();

        $case = CaseModel::onlyTrashed()
            ->where('user_id', $user->getKey())
            ->findOrFail($id);

        try {
            $case->restore();
            return redirect()->route('law.cases.recycle-bin')->with('success', 'Case restored successfully!');
        } catch (\Exception $e) {
            return redirect()->route('law.cases.recycle-bin')->with('error', 'Failed to restore case: ' . $e->getMessage());
        }
    }
    public function permanentDelete($id)
    {
        $user = Auth::user();

        $case = CaseModel::onlyTrashed()
            ->where('user_id', $user->getKey())
            ->findOrFail($id);

        try {
            $case->forceDelete();
            return redirect()->route('law.cases.recycle-bin')->with('success', 'Case permanently deleted!');
        } catch (\Exception $e) {
            return redirect()->route('law.cases.recycle-bin')->with('error', 'Failed to permanently delete case: ' . $e->getMessage());
        }
    }
    // Profile Function
    public function showProfile()
    {
        $user = Auth::user();
        return view('law::dashboard.profile.index', [
            'user' => $user,
            'section' => 'profile',
        ]);
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('law::dashboard.profile.index', [
            'user' => $user,
            'section' => 'profile',
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->getKey()],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $user->update($validated);

        return redirect()->route('law.profile.show')->with('success', 'Profile updated successfully.');
    }

    public function showChangePassword()
    {
        $user = Auth::user();
        return view('law::dashboard.profile.index', [
            'user' => $user,
            'section' => 'password',
        ]);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!\Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
        }

        $user->update([
            'password' => \Hash::make($validated['password']),
        ]);

        return redirect()->route('law.profile.show')->with('success', 'Password updated successfully.');
    }
}

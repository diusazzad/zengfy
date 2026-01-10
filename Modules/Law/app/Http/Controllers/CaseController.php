<?php

namespace Modules\Law\Http\Controllers;

use Modules\Law\Models\Attachment;
use Modules\Law\Models\CaseModel;
use Modules\Law\Models\CaseStage;
use Modules\Law\Models\CaseType;
use Modules\Law\Models\Court;
use Modules\Law\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CaseModel::with('court', 'caseType', 'caseStage', 'caseDates', 'contacts', 'payments');
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        $cases = $query->get();
        return view('law::dashboard.cases.index', compact('cases'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courts = Court::all();
        $caseTypes = CaseType::all();
        $caseStages = CaseStage::orderBy('order')->get();
        return view('law::dashboard.cases.create', compact('courts', 'caseTypes', 'caseStages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'office_file_number' => 'required|unique:cases,office_file_number',
            'case_number' => 'required|unique:cases,case_number',
            'case_title' => 'required|string|max:255',
            'case_type_id' => 'required_without:new_case_type|exists:case_types,id',
            'new_case_type' => 'required_without:case_type_id|string|max:255',
            'case_stage_id' => 'required_without:new_case_stage|exists:case_stages,id',
            'new_case_stage' => 'required_without:case_stage_id|string|max:255',
            'case_opening_date' => 'nullable|date_format:d-m-Y',
            'previous_date' => 'nullable|date_format:d-m-Y',
            'next_date' => 'nullable|date_format:d-m-Y',
            'notes' => 'nullable|string',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
            'client_name' => 'required|string|max:255',
            'opponent_name' => 'nullable|string|max:255',
            'opponent_lawyer' => 'nullable|string|max:255',
            'case_fee' => 'nullable|numeric|min:0',
            'payment_history' => 'nullable|string',
        ]);

        // Create new case type if provided
        if ($request->filled('new_case_type')) {
            $caseType = CaseType::create([
                'name' => $validated['new_case_type'],
            ]);
            $validated['case_type_id'] = $caseType->id;
        }

        // Create new case stage if provided
        if ($request->filled('new_case_stage')) {
            $caseStage = CaseStage::create([
                'name' => $validated['new_case_stage'],
            ]);
            $validated['case_stage_id'] = $caseStage->id;
        }

        // Create the case
        $case = CaseModel::create([
            'user_id' => auth()->id(),
            'office_file_number' => $validated['office_file_number'],
            'court_case_number' => $validated['case_number'],
            'case_title' => $validated['case_title'],
            'case_type_id' => $validated['case_type_id'],
            'case_stage_id' => $validated['case_stage_id'],
            'court_id' => $request->court_id, // Assuming court_id is in request
            'opening_date' => $request->case_opening_date ? \Carbon\Carbon::createFromFormat('d-m-Y', $request->case_opening_date)->toDateString() : null,
            'previous_date' => $request->previous_date ? \Carbon\Carbon::createFromFormat('d-m-Y', $request->previous_date)->toDateString() : null,
            'next_date' => $request->next_date ? \Carbon\Carbon::createFromFormat('d-m-Y', $request->next_date)->toDateString() : null,
            'client_name' => $validated['client_name'],
            'opponent_name' => $validated['opponent_name'] ?? null,
            'opponent_lawyer' => $validated['opponent_lawyer'] ?? null,
            'case_fee' => $validated['case_fee'] ?? 0,
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $path = $attachment->store('attachments', 'public');
                Attachment::create([
                    'case_id' => $case->id,
                    'file_path' => $path,
                    'file_name' => $attachment->getClientOriginalName(),
                    'file_type' => $attachment->getClientMimeType(),
                ]);
            }
        }

        if ($request->filled('payment_history') || $request->filled('case_fee')) {
            Payment::create([
                'case_id' => $case->id,
                'amount' => $validated['case_fee'] ?? 0,
                'payment_date' => now(),
                'description' => $validated['payment_history'] ?? null,
            ]);
        }

        return redirect()->route('law.cases.index')->with('success', 'কেস সফলভাবে তৈরি হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function caseShow(string $id)
    {
        // $case = CaseModel::with('caseType', 'caseDates', 'contacts', 'payments', 'attachments')
        //     ->findOrFail($id);
        // return view('law::cases.show', compact('case'));

        try {
            // কেসটি ID দিয়ে লোড করুন, রিলেশনসহ
            $case = CaseModel::with(['caseType', 'caseStage', 'court', 'user'])->findOrFail($id);

            // যদি প্রয়োজন হয়, কাস্টম ফিল্ড যেমন formatted dates যোগ করতে পারেন
            $case->display_previous_date = $case->previous_date ? \Carbon\Carbon::parse($case->previous_date)->format('d/m/Y') : 'N/A';
            $case->display_next_date = $case->next_date ? \Carbon\Carbon::parse($case->next_date)->format('d/m/Y') : 'N/A';

            // client_name v opponent_name ফরম্যাটে একটি ডিসপ্লে নাম
            $case->display_case_title = ($case->client_name ?? 'N/A') . ' v ' . ($case->opponent_name ?? 'N/A');

            // View এ case পাঠান
            return view('law::dashboard.cases.show', compact('case'));
        } catch (\Exception $e) {
            // Error handling: 404 বা রিডাইরেক্ট করতে পারেন
            return redirect()->route('law.cases.index')->with('error', 'Case not found or something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $case = CaseModel::findOrFail($id);
        $caseTypes = CaseType::all();
        $courts = Court::all();
        $caseStages = CaseStage::orderBy('order')->get();
        return view('law::dashboard.cases.edit', compact('case', 'caseTypes', 'courts', 'caseStages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the form data
        $validated = $request->validate([
            'office_file_number' => 'required|unique:case_models,office_file_number,' . $id,
            'case_number' => 'required|unique:case_models,court_case_number,' . $id,
            'case_title' => 'required|string|max:255',
            'case_type_id' => 'required_without:new_case_type|exists:case_types,id',
            'new_case_type' => 'required_without:case_type_id|string|max:255',
            'case_opening_date' => 'nullable|date_format:d-m-Y',
            'previous_date' => 'nullable|date_format:d-m-Y',
            'next_date' => 'nullable|date_format:d-m-Y',
            'notes' => 'nullable|string',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
            'client_name' => 'required|string|max:255',
            'opponent_name' => 'nullable|string|max:255',
            'opponent_lawyer' => 'nullable|string|max:255',
            'case_fee' => 'nullable|numeric|min:0',
            'payment_history' => 'nullable|string',
        ]);

        $case = CaseModel::findOrFail($id);

        // Create new case type if provided
        if ($request->filled('new_case_type')) {
            $caseType = CaseType::create([
                'name' => $validated['new_case_type'],
            ]);
            $validated['case_type_id'] = $caseType->id;
        }

        // Update the case
        $case->update([
            'office_file_number' => $validated['office_file_number'],
            'court_case_number' => $validated['case_number'],
            'case_title' => $validated['case_title'],
            'case_type_id' => $validated['case_type_id'],
            'opening_date' => $request->case_opening_date ? \Carbon\Carbon::createFromFormat('d-m-Y', $request->case_opening_date)->toDateString() : null,
            'previous_date' => $request->previous_date ? \Carbon\Carbon::createFromFormat('d-m-Y', $request->previous_date)->toDateString() : null,
            'next_date' => $request->next_date ? \Carbon\Carbon::createFromFormat('d-m-Y', $request->next_date)->toDateString() : null,
            'client_name' => $validated['client_name'],
            'opponent_name' => $validated['opponent_name'] ?? null,
            'opponent_lawyer' => $validated['opponent_lawyer'] ?? null,
            'case_fee' => $validated['case_fee'] ?? 0,
            'notes' => $validated['notes'] ?? null,
        ]);

        // Store new attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $path = $attachment->store('attachments', 'public');
                Attachment::create([
                    'case_id' => $case->id,
                    'file_path' => $path,
                    'file_name' => $attachment->getClientOriginalName(),
                    'file_type' => $attachment->getClientMimeType(),
                ]);
            }
        }

        // Update or create payment history
        if ($request->filled('payment_history') || $request->filled('case_fee')) {
            $case->payments()->updateOrCreate(
                ['case_id' => $case->id],
                [
                    'amount' => $validated['case_fee'] ?? 0,
                    'payment_date' => now(),
                    'description' => $validated['payment_history'] ?? null,
                ]
            );
        }

        return redirect()->route('law.cases.index')->with('success', 'কেস সফলভাবে আপডেট হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $case = CaseModel::findOrFail($id);
        $case->delete();
        return redirect()->route('law.cases.index')->with('success', 'কেস সফলভাবে মুছে ফেলা হয়েছে।');
    }
}


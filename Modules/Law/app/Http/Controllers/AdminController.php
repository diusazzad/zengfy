<?php

namespace Modules\Law\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::with('roles')->orderByDesc('created_at')->paginate(15);

        return view('law::admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('law::admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,user'],
            'plan' => ['nullable', 'string', 'max:50'],
            'account_status' => ['required', 'in:active,pending_payment'],
        ]);

        $role = $validated['role'];
        $plan = $validated['plan'] ?? 'basic';

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'account_status' => $validated['account_status'],
            'plan' => $plan,
        ]);

        // Ensure the role exists, then assign it.
        Role::firstOrCreate(['name' => $role]);
        $user->syncRoles([$role]);

        return redirect()->route('law.admin.users.index')->with('status', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('law::admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->getKey()],
            'phone' => ['nullable', 'string', 'max:50'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,user'],
            'plan' => ['nullable', 'string', 'max:50'],
            'account_status' => ['required', 'in:active,pending_payment'],
        ]);

        $role = $validated['role'];
        $plan = $validated['plan'] ?? 'basic';

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'account_status' => $validated['account_status'],
            'plan' => $plan,
        ]);

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        Role::firstOrCreate(['name' => $role]);
        $user->syncRoles([$role]);

        return redirect()->route('law.admin.users.index')->with('status', 'User updated successfully.');
    }
}

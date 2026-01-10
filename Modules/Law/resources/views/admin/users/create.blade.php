@extends('layouts.app')

@section('title', 'Admin · Add user')

@section('content')
    <div class="mb-6">
        <p class="text-sm font-semibold text-cyan-700">Admin</p>
        <h1 class="text-2xl font-bold text-slate-900">Add user</h1>
        <p class="text-sm text-slate-500">Create an account and set a password manually.</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('law.admin.users.store') }}" class="space-y-5">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2">
            <div class="space-y-2">
                <label for="name" class="block text-sm font-semibold text-slate-700">Full name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-base shadow-sm transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100"
                    placeholder="Jane Advocate">
            </div>
            <div class="space-y-2">
                <label for="email" class="block text-sm font-semibold text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-base shadow-sm transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100"
                    placeholder="user@example.com">
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
            <div class="space-y-2">
                <label for="phone" class="block text-sm font-semibold text-slate-700">Phone (optional)</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-base shadow-sm transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100"
                    placeholder="+1 555 123 4567">
            </div>
            <div class="space-y-2">
                <label for="role" class="block text-sm font-semibold text-slate-700">Role</label>
                <select id="role" name="role" required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-base shadow-sm transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100">
                    <option value="user" {{ old('role', 'user') === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="space-y-2">
                <label for="account_status" class="block text-sm font-semibold text-slate-700">Status</label>
                <select id="account_status" name="account_status" required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-base shadow-sm transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100">
                    <option value="active" {{ old('account_status', 'active') === 'active' ? 'selected' : '' }}>Active
                    </option>
                    <option value="pending_payment" {{ old('account_status') === 'pending_payment' ? 'selected' : '' }}>
                        Pending payment</option>
                </select>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="space-y-2">
                <label for="plan" class="block text-sm font-semibold text-slate-700">Plan</label>
                <select id="plan" name="plan"
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-base shadow-sm transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100">
                    <option value="basic" {{ old('plan', 'basic') === 'basic' ? 'selected' : '' }}>Basic</option>
                    <option value="pro" {{ old('plan') === 'pro' ? 'selected' : '' }}>Pro</option>
                </select>
            </div>
            <div class="space-y-2">
                <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-base shadow-sm transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100"
                    placeholder="At least 8 characters">
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="space-y-2">
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Confirm
                    password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-base shadow-sm transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100"
                    placeholder="Repeat password">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                class="inline-flex items-center gap-2 rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-200">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14"></path>
                    <path d="M5 12h14"></path>
                </svg>
                Create user
            </button>
            <a href="{{ route('law.admin.users.index') }}"
                class="text-sm font-semibold text-slate-600 hover:text-slate-800">
                Cancel
            </a>
        </div>
    </form>
@endsection
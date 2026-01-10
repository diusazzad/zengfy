@extends('layouts.app')

@section('title', 'Admin · Users')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm font-semibold text-cyan-700">Admin</p>
            <h1 class="text-2xl font-bold text-slate-900">All users</h1>
            <p class="text-sm text-slate-500">Manage access, billing plan, and credentials without exposing personal info.
            </p>
        </div>
        <a href="{{ route('law.admin.users.create') }}"
            class="inline-flex items-center gap-2 rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-200">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 5v14"></path>
                <path d="M5 12h14"></path>
            </svg>
            Add user
        </a>
    </div>

    @if (session('status'))
        <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Name</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Email</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Email</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Name</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Subscription</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Billing plan</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Access</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse ($users as $user)
                    <tr class="hover:bg-slate-50/70">
                        <td class="px-4 py-3 text-slate-700">{{ $user->email }}</td>
                        <td class="px-4 py-3 font-semibold text-slate-900">{{ $user->name }}</td>
                        <td class="px-4 py-3">
                            <span
                                class="inline-flex items-center rounded-full px-2 py-1 text-xs font-semibold
                                        {{ $user->account_status === 'active' ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200' : 'bg-amber-50 text-amber-700 ring-1 ring-amber-200' }}">
                                {{ $user->account_status === 'active' ? 'On' : 'Off / Pending payment' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-700 text-capitalize">
                            {{ $user->plan ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-slate-700">
                            {{ implode(', ', $user->getRoleNames()->toArray()) ?: '—' }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('law.admin.users.edit', $user) }}"
                                    class="rounded-lg border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-700 hover:border-cyan-200 hover:text-cyan-800">
                                    Edit / Set password
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-slate-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-4 py-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="text-sm font-semibold text-cyan-700">Profile</p>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Your account</h1>
                <p class="text-sm text-slate-500">Update your details or change your password.</p>
            </div>
            <div
                class="rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-white shadow-sm">
                {{ implode(', ', $user->getRoleNames()->toArray()) }}
            </div>
        </div>

        @if (session('success'))
            <div class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid gap-4 lg:grid-cols-2">
            <div class="space-y-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Profile details</h2>
                        <p class="text-sm text-slate-500">Keep your contact information up to date.</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('law.profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold text-slate-700">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm placeholder:text-slate-400 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                    </div>
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-semibold text-slate-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm placeholder:text-slate-400 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                    </div>
                    <div class="space-y-2">
                        <label for="phone" class="text-sm font-semibold text-slate-700">Phone (Optional)</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm placeholder:text-slate-400 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                    </div>
                    <button type="submit"
                        class="w-full rounded-xl bg-cyan-600 px-4 py-3 text-sm font-semibold text-white shadow-md shadow-cyan-200 transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-200">
                        Save changes
                    </button>
                </form>
            </div>

            <div class="space-y-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Change password</h2>
                        <p class="text-sm text-slate-500">Use a strong, unique password.</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('law.profile.update-password') }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="space-y-2">
                        <label for="current_password" class="text-sm font-semibold text-slate-700">Current password</label>
                        <input type="password" id="current_password" name="current_password"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm placeholder:text-slate-400 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                    </div>
                    <div class="space-y-2">
                        <label for="password" class="text-sm font-semibold text-slate-700">New password</label>
                        <input type="password" id="password" name="password"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm placeholder:text-slate-400 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                    </div>
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-sm font-semibold text-slate-700">Confirm new
                            password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm placeholder:text-slate-400 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                    </div>
                    <button type="submit"
                        class="w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white shadow-md shadow-slate-300 transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        Update password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
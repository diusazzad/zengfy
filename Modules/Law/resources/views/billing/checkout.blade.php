@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Complete Payment</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-info" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="mb-4">
                            Hi {{ auth()->user()->name ?? 'there' }}, finish your payment to activate your account.
                        </p>

                        <div class="mb-3">
                            <h5 class="mb-2">Plan selected</h5>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold text-capitalize">{{ $plan ?? 'basic' }} plan</span>
                                    <span class="text-muted small">Demo checkout</span>
                                </li>
                            </ul>
                        </div>

                        <form method="POST" action="{{ route('law.billing.complete') }}">
                            @csrf
                            <input type="hidden" name="plan" value="{{ $plan ?? 'basic' }}">
                            <button type="submit" class="btn btn-success w-100">
                                Complete payment & activate
                            </button>
                        </form>

                        <p class="text-muted small mt-3 mb-0">
                            This is a placeholder checkout. Swap this step with your payment gateway (Stripe, PayPal, etc.)
                            and set users to <code>account_status = active</code> after a successful charge.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
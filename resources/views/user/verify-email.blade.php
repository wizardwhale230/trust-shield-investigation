@extends('layouts.dashboard')
@section('title', 'Verify Email')
@section('page-title', 'Email Verification')

@section('content')
	<div class="max-w-2xl mx-auto">
		@if (session('status') == 'verification-link-sent')
			<div class="mb-4 p-3 rounded-md bg-success-light text-success text-sm">
				A new verification link has been sent to your email address.
			</div>
		@endif

		<div class="dash-card text-center">
			<div class="w-14 h-14 rounded-full bg-primary-light flex items-center justify-center mx-auto mb-4">
				<i data-lucide="mail-check" class="w-7 h-7 text-primary"></i>
			</div>

			<h2 class="text-lg font-heading font-semibold text-content mb-2">Verify your email address</h2>
			<p class="text-sm text-content-secondary mb-6">
				Before continuing, please verify your email using the link we sent. If you did not receive it, request a new one below.
			</p>

			<div class="flex flex-col sm:flex-row justify-center gap-3">
				<form method="POST" action="{{ route('verification.send') }}">
					@csrf
					<button type="submit" class="btn-primary">Resend Verification Email</button>
				</form>

				<form method="POST" action="{{ route('logout') }}">
					@csrf
					<button type="submit" class="btn-secondary">Log Out</button>
				</form>
			</div>
		</div>
	</div>
@endsection

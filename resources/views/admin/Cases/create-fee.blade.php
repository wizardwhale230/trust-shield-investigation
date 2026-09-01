@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <a href="{{ route('admin.cases.show', $case->id) }}" class="text-muted small">&larr; Back to {{ $case->case_number }}</a>
                    <h1 class="title1">Create Fee Request</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="mb-4 p-3 bg-light rounded">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="text-muted small mb-1">Case</p>
                                            <p class="fw-bold mb-0">{{ $case->case_number }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="text-muted small mb-1">Client</p>
                                            <p class="fw-bold mb-0">{{ $case->user->name ?? '' }} {{ $case->user->l_name ?? '' }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="text-muted small mb-1">Amount Lost</p>
                                            <p class="fw-bold mb-0">{{ $settings->currency }}{{ number_format($case->amount_lost, 2) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('admin.fee.store') }}">
                                    @csrf
                                    <input type="hidden" name="case_id" value="{{ $case->id }}">

                                    <div class="form-group">
                                        <label>Fee Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g., Legal filing fee, Court application fee" required>
                                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Amount ({{ $settings->currency }}) <span class="text-danger">*</span></label>
                                        <input type="number" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="0.00" step="0.01" min="0.01" required>
                                        @error('amount') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Description (optional)</label>
                                        <textarea name="description" class="form-control" rows="3" placeholder="Explain what this fee covers...">{{ old('description') }}</textarea>
                                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Create Fee Request</button>
                                        <a href="{{ route('admin.cases.show', $case->id) }}" class="btn btn-outline-secondary ml-2">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

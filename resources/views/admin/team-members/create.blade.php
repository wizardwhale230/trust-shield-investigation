@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <a href="{{ route('admin.team-members.index') }}" class="text-muted small">&larr; Team Members</a>
                    <h1 class="title1 mb-0">Add Team Member</h1>
                </div>
                <x-danger-alert />

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.team-members.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                                               class="form-control @error('first_name') is-invalid @enderror" required>
                                        @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                                               class="form-control @error('last_name') is-invalid @enderror" required>
                                        @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Job Title <span class="text-danger">*</span></label>
                                <input type="text" name="job_title" value="{{ old('job_title') }}"
                                       class="form-control @error('job_title') is-invalid @enderror"
                                       placeholder="e.g. Senior Recovery Attorney" required>
                                @error('job_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Specialization</label>
                                <input type="text" name="specialization" value="{{ old('specialization') }}"
                                       class="form-control @error('specialization') is-invalid @enderror"
                                       placeholder="e.g. Crypto Fraud, Wire Fraud">
                                @error('specialization') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label>Bio</label>
                                <textarea name="bio" rows="4"
                                          class="form-control @error('bio') is-invalid @enderror"
                                          placeholder="Short professional biography...">{{ old('bio') }}</textarea>
                                @error('bio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <small class="text-muted">(optional — shown to clients if provided)</small></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                               class="form-control @error('email') is-invalid @enderror">
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone <small class="text-muted">(optional — shown to clients if provided)</small></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}"
                                               class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Years of Experience</label>
                                        <input type="number" name="years_experience" value="{{ old('years_experience') }}"
                                               min="0" max="99"
                                               class="form-control @error('years_experience') is-invalid @enderror">
                                        @error('years_experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Profile Photo</label>
                                        <input type="file" name="photo" accept="image/*"
                                               class="form-control-file @error('photo') is-invalid @enderror">
                                        <small class="text-muted">Max 2 MB. JPG, PNG, GIF, WebP.</small>
                                        @error('photo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-check mb-4">
                                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">Active (visible for case assignment)</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Team Member</button>
                            <a href="{{ route('admin.team-members.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

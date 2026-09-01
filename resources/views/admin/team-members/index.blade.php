@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="d-flex align-items-center justify-content-between mt-2 mb-4">
                    <h1 class="title1">Team Members</h1>
                    <a href="{{ route('admin.team-members.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus mr-1"></i> Add Member
                    </a>
                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="card shadow p-4">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Job Title</th>
                                    <th>Specialization</th>
                                    <th>Exp.</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td>
                                            <img src="{{ $member->photo_url }}" alt="{{ $member->full_name }}"
                                                 class="rounded-circle" style="width:42px;height:42px;object-fit:cover;">
                                        </td>
                                        <td>
                                            <strong>{{ $member->full_name }}</strong>
                                            @if($member->email)
                                                <br><small class="text-muted">{{ $member->email }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $member->job_title }}</td>
                                        <td>{{ $member->specialization ?? '—' }}</td>
                                        <td>{{ $member->years_experience ? $member->years_experience . ' yrs' : '—' }}</td>
                                        <td>
                                            @if($member->is_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.team-members.edit', $member->id) }}"
                                               class="btn btn-sm btn-outline-primary mr-1">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.team-members.destroy', $member->id) }}"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Delete {{ $member->full_name }}? This cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            No team members yet.
                                            <a href="{{ route('admin.team-members.create') }}">Add the first one.</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($members->hasPages())
                        <div class="mt-3">{{ $members->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

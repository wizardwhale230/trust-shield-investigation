<form method="POST" action="{{ route('updateuserpass') }}">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
        <div>
            <label class="form-label">Old Password</label>
            <input type="password" name="current_password" class="input-field" required>
        </div>
        <div>
            <label class="form-label">New Password</label>
            <input type="password" name="password" class="input-field" required>
        </div>
        <div>
            <label class="form-label">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="input-field" required>
        </div>
    </div>

    <div class="flex items-center justify-between flex-wrap gap-3 mb-5">
        <button type="submit" class="btn-primary">Update Password</button>
        <a href="{{ route('twofa') }}" class="text-sm text-primary hover:text-primary-dark font-medium">
            Advanced Account Settings
            <i data-lucide="arrow-right" class="w-3.5 h-3.5 inline-block ml-1"></i>
        </a>
    </div>
</form>

<div class="p-4 rounded-md bg-surface-muted border border-border-muted">
    <h4 class="text-sm font-medium text-content mb-2">Password requirements:</h4>
    <ul class="text-xs text-content-secondary space-y-1 list-disc pl-4">
        <li>Minimum 8 characters long - the more, the better</li>
        <li>At least one lowercase character</li>
        <li>At least one uppercase character</li>
        <li>At least one number, symbol.</li>
    </ul>
</div>
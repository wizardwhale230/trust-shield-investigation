<form method="POST" action="javascript:void(0)" id="updateemailpref">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
        <div>
            <label class="form-label">Send confirmation OTP to my email when withdrawing funds</label>
            <div class="flex gap-3 mt-2" x-data="{ otpSend: '{{ Auth::user()->sendotpemail ?? 'Yes' }}' }">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="otpsend" id="otpsendYes" value="Yes" x-model="otpSend"
                        class="w-4 h-4 text-primary border-border focus:ring-primary">
                    <span class="text-sm text-content">Yes</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="otpsend" id="otpsendNo" value="No" x-model="otpSend"
                        class="w-4 h-4 text-primary border-border focus:ring-primary">
                    <span class="text-sm text-content">No</span>
                </label>
            </div>
        </div>
        <div>
            <label class="form-label">Send me email on case status updates</label>
            <div class="flex gap-3 mt-2" x-data="{ roiEmail: '{{ Auth::user()->sendroiemail ?? 'Yes' }}' }">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="roiemail" id="roiemailYes" value="Yes" x-model="roiEmail"
                        class="w-4 h-4 text-primary border-border focus:ring-primary">
                    <span class="text-sm text-content">Yes</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="roiemail" id="roiemailNo" value="No" x-model="roiEmail"
                        class="w-4 h-4 text-primary border-border focus:ring-primary">
                    <span class="text-sm text-content">No</span>
                </label>
            </div>
        </div>
        <div>
            <label class="form-label">Send me email on recovery updates</label>
            <div class="flex gap-3 mt-2" x-data="{ invPlanEmail: '{{ Auth::user()->sendinvplanemail ?? 'Yes' }}' }">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="invplanemail" id="invplanemailYes" value="Yes" x-model="invPlanEmail"
                        class="w-4 h-4 text-primary border-border focus:ring-primary">
                    <span class="text-sm text-content">Yes</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="invplanemail" id="invplanemailNo" value="No" x-model="invPlanEmail"
                        class="w-4 h-4 text-primary border-border focus:ring-primary">
                    <span class="text-sm text-content">No</span>
                </label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn-primary">Save Preferences</button>
</form>

<script>
    document.getElementById('updateemailpref').addEventListener('submit', function() {
        $.ajax({
            url: "{{ route('updateemail') }}",
            type: 'POST',
            data: $('#updateemailpref').serialize(),
            success: function(response) {
                if (response.status === 200) {
                    if (typeof swal !== 'undefined') {
                        swal("Success", response.success, "success");
                    } else {
                        alert(response.success);
                    }
                }
            },
            error: function(data) {
                console.log(data);
            },
        });
    });
</script>

<form method="post" action="javascript:void(0)" id="updatewithdrawalinfo">
    @csrf
    @method('PUT')

    {{-- Bank Details --}}
    <div class="mb-5">
        <h4 class="text-sm font-medium text-content mb-3">Bank Details</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="form-label">Bank Name</label>
                <input type="text" name="bank_name" value="{{ Auth::user()->bank_name }}" class="input-field"
                    placeholder="Enter bank name">
            </div>
            <div>
                <label class="form-label">Account Name</label>
                <input type="text" name="account_name" value="{{ Auth::user()->account_name }}" class="input-field"
                    placeholder="Enter Account name">
            </div>
            <div>
                <label class="form-label">Account Number</label>
                <input type="text" name="account_no" value="{{ Auth::user()->account_number }}" class="input-field"
                    placeholder="Enter Account Number">
            </div>
            <div>
                <label class="form-label">Swift Code</label>
                <input type="text" name="swiftcode" value="{{ Auth::user()->swift_code }}" class="input-field"
                    placeholder="Enter Swift Code">
            </div>
        </div>
    </div>

    {{-- Crypto Wallets --}}
    <div class="mb-5">
        <h4 class="text-sm font-medium text-content mb-3">Crypto Wallets</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="form-label">Bitcoin</label>
                <input type="text" name="btc_address" value="{{ Auth::user()->btc_address }}" class="input-field"
                    placeholder="Enter Bitcoin Address">
                <p class="text-xs text-content-tertiary mt-1">Your Bitcoin address for withdrawals</p>
            </div>
            <div>
                <label class="form-label">Ethereum</label>
                <input type="text" name="eth_address" value="{{ Auth::user()->eth_address }}" class="input-field"
                    placeholder="Enter Ethereum Address">
                <p class="text-xs text-content-tertiary mt-1">Your Ethereum address for withdrawals</p>
            </div>
            <div>
                <label class="form-label">Litecoin</label>
                <input type="text" name="ltc_address" value="{{ Auth::user()->ltc_address }}" class="input-field"
                    placeholder="Enter Litecoin Address">
                <p class="text-xs text-content-tertiary mt-1">Your Litecoin address for withdrawals</p>
            </div>
            <div>
                <label class="form-label">USDT.TRC20</label>
                <input type="text" name="usdt_address" value="{{ Auth::user()->usdt_address }}" class="input-field"
                    placeholder="Enter USDT.TRC20 Address">
                <p class="text-xs text-content-tertiary mt-1">Your USDT.TRC20 address for withdrawals</p>
            </div>
        </div>
    </div>

    <button type="submit" class="btn-primary">Save Changes</button>
</form>


<script>
    document.getElementById('updatewithdrawalinfo').addEventListener('submit', function() {
        $.ajax({
            url: "{{ route('updateacount') }}",
            type: 'POST',
            data: $('#updatewithdrawalinfo').serialize(),
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

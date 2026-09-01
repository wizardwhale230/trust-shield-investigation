@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Settle Fee')

@section('content')
    {{-- Alerts --}}
    @if(session('success'))
        <div class="mb-4 p-3 rounded-md bg-success-light text-success text-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 rounded-md bg-danger-light text-danger text-sm">{{ session('error') }}</div>
    @endif
    @if(session('message'))
        <div class="mb-4 p-3 rounded-md bg-info-light text-info text-sm">{{ session('message') }}</div>
    @endif

    <div class="max-w-2xl mx-auto">
        {{-- Letterhead band --}}
        <div class="mb-6 pb-5 border-b border-border-muted">
            <p class="text-xs uppercase tracking-widest text-accent font-semibold mb-2">Secure Payment</p>
            <h2 class="text-xl sm:text-2xl font-heading font-semibold text-content">Settle fee</h2>
            <p class="text-sm text-content-secondary mt-1 max-w-2xl">
                You are authorising payment of the fee detailed below into the firm's client trust account.
            </p>
            <div class="mt-4 h-px w-16 bg-accent"></div>
        </div>

        {{-- Invoice context strip --}}
        @if(!empty($feeRequest))
            <div class="mb-4 rounded-md bg-surface-muted border border-border-muted px-4 py-3 text-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                    <span class="text-content-tertiary">Matter</span>
                    <span class="font-mono font-medium text-primary">{{ $case->case_number ?? 'N/A' }}</span>
                    <span class="text-content-tertiary">• Fee</span>
                    <span class="font-medium text-content">{{ $feeRequest->title }}</span>
                </div>
                <span class="text-xs text-content-tertiary">Issued {{ $feeRequest->created_at->format('M d, Y') }}</span>
            </div>
        @endif

        {{-- Payment Summary Card --}}
        <div class="dash-card mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-primary-light flex items-center justify-center flex-shrink-0">
                        @if (!empty($payment_mode->img_url))
                            <img src="{{ $payment_mode->img_url }}" alt="{{ $payment_mode->name }}" class="w-8 h-8 object-contain">
                        @else
                            <i data-lucide="wallet" class="w-6 h-6 text-primary"></i>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-content">{{ $payment_mode->name }}</h3>
                        <p class="text-xs text-content-tertiary">Payment Channel</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-semibold text-content">{{ $settings->currency }}{{ number_format($amount) }}</p>
                    <p class="text-xs text-content-tertiary">Amount to authorise</p>
                    @if(!empty($feeRequest))
                        <p class="text-xs text-content-tertiary mt-0.5">Reference: FR-{{ $feeRequest->id }}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Payment Form Card --}}
        <div class="dash-card">
            @if ($title != 'Complete Payment')
                @php
                    if ($payment_mode->name == 'Bitcoin') {
                        $coin = 'BTC';
                    } elseif ($payment_mode->name == 'Litecoin') {
                        $coin = 'LTC';
                    } elseif ($payment_mode->name == 'Ethereum') {
                        $coin = 'ETH';
                    } elseif ($payment_mode->name == 'BUSD') {
                        $coin = 'BUSD';
                    } else {
                        $coin = 'USDT.TRC20';
                    }
                @endphp

                <div class="mb-5">
                    <p class="text-sm text-content-secondary">
                        You are authorising
                        <strong class="text-content">{{ $settings->currency }}{{ number_format($amount) }}</strong>
                        in respect of <strong class="text-content">{{ $feeRequest->title ?? 'this fee' }}</strong>@if(!empty($case)) on Matter <strong class="text-content font-mono">{{ $case->case_number }}</strong>@endif.
                        Funds will be received by the firm's client trust account.
                    </p>
                </div>

                {{-- QR/Barcode --}}
            
                    <div class="flex justify-center mb-5">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ $payment_mode->wallet_address }}" alt="Payment QR" class="w-40 h-40 object-contain rounded-lg border border-border-muted p-2">
                    </div>
          

                {{-- Auto payment options --}}
                @if ($settings->deposit_option != 'manual')
                    @if ($payment_mode->name == 'Bitcoin' || $payment_mode->name == 'Litecoin' || $payment_mode->name == 'Ethereum' || $payment_mode->name == 'USDT' || $payment_mode->name == 'BUSD')
                        @if ($payment_mode->name == 'USDT' && $settings->auto_merchant_option == 'Binance' && $settings->deposit_option == 'auto')
                            <livewire:user.crypto-payment />
                        @else
                            <div class="text-center mb-5">
                                <a href="{{ url('dashboard/cpay') }}/{{ $amount }}/{{ $coin }}/{{ Auth::user()->id }}/new"
                                   class="btn-primary">
                                    <i data-lucide="bitcoin" class="w-4 h-4 mr-2"></i>
                                    Pay Via Coinpayment
                                </a>
                            </div>
                        @endif
                    @else
                        @if ((!empty($payment_mode->barcode) || $payment_mode->barcode != null) && $payment_mode->methodtype != 'currency')
                            <div class="flex justify-center mb-5">
                                <img src="{{ asset('storage/' . $payment_mode->barcode) }}" alt="QR Code" class="w-48 rounded-lg border border-border-muted p-2">
                            </div>
                        @endif
                    @endif
                @endif

                {{-- Wallet Address (for crypto non-auto modes) --}}
                @if ($payment_mode->methodtype != 'currency')
                    @if (($payment_mode->name == 'Bitcoin' || $payment_mode->name == 'Litecoin' || $payment_mode->name == 'Ethereum' || $payment_mode->name == 'USDT' || $payment_mode->name == 'BUSD') && $settings->deposit_option != 'manual')
                        {{-- Auto crypto — no wallet address shown --}}
                    @else
                        <div class="mb-5">
                            <label class="form-label">{{ $payment_mode->name }} Address</label>
                            <div class="flex gap-2">
                                <input type="text" class="input-field flex-1" value="{{ $payment_mode->wallet_address }}" id="myInput" readonly>
                                <button type="button" onclick="myFunction()" class="btn-secondary flex-shrink-0">
                                    <i data-lucide="copy" class="w-4 h-4"></i>
                                </button>
                            </div>
                            @if($payment_mode->network)
                                <p class="text-xs text-content-tertiary mt-1.5">
                                    <strong>Network Type:</strong> {{ $payment_mode->network }}
                                </p>
                            @endif
                        </div>
                    @endif
                @else
                    {{-- Currency-based payment methods --}}
                    @if ($payment_mode->defaultpay == 'yes')
                        {{-- Paystack --}}
                        @if ($payment_mode->name == 'Credit Card' && $settings->credit_card_provider == 'Paystack')
                            <?php $payamount = $amount * 100; ?>
                            <form method="POST" action="{{ route('pay.paystack') }}" accept-charset="UTF-8" class="mb-5">
                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                <input type="hidden" name="amount" value="{{ $payamount }}">
                                <input type="hidden" name="currency" value="{{ $settings->s_currency }}">
                                <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value']) }}">
                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                                @csrf
                                <button type="submit" class="btn-primary w-full">
                                    <i data-lucide="credit-card" class="w-4 h-4 mr-2"></i>
                                    Pay with Card
                                </button>
                            </form>
                        @endif

                        {{-- Flutterwave --}}
                        @if ($payment_mode->name == 'Credit Card' && $settings->credit_card_provider == 'Flutterwave')
                            <form method="POST" action="{{ route('paybyflutterwave') }}" class="mb-5">
                                @csrf
                                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                <input type="hidden" name="phone" value="{{ Auth::user()->phone }}">
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <button type="submit" class="btn-primary w-full">
                                    <i data-lucide="credit-card" class="w-4 h-4 mr-2"></i>
                                    Pay with Card
                                </button>
                            </form>
                        @endif

                        {{-- Stripe --}}
                        @if ($payment_mode->name == 'Credit Card' && $settings->credit_card_provider == 'Stripe')
                            <div class="mb-5">
                                <form id="payment-form">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label">Card Details</label>
                                        <div id="card-element" class="input-field py-3"></div>
                                    </div>
                                    <button id="stripesubmit" class="btn-primary w-full">
                                        <div class="hidden" id="spinner">
                                            <svg class="animate-spin h-4 w-4 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                        </div>
                                        <span id="buttontext">Authorise &amp; Pay {{ $settings->currency }}{{ number_format($amount) }}</span>
                                    </button>
                                </form>
                                <div class="hidden mt-4 p-3 rounded-md bg-success-light text-success text-sm text-center" id="stripesuccess">
                                    Payment Completed, redirecting...
                                </div>
                                <form id="selectform" method="POST" action="javascript:void(0)">
                                    @csrf
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                </form>
                            </div>
                        @endif

                        {{-- Paypal --}}
                        @if ($payment_mode->name == 'Paypal')
                            <div class="mb-5">
                                @include('includes.paypal')
                            </div>
                        @endif

                        {{-- Bank Transfer --}}
                        @if ($payment_mode->name == 'Bank Transfer')
                            <div class="space-y-3 mb-5">
                                @if (!empty($payment_mode->bankname))
                                    <div>
                                        <label class="form-label">Bank Name</label>
                                        <div class="flex gap-2">
                                            <input type="text" class="input-field flex-1" value="{{ $payment_mode->bankname }}" readonly>
                                            <button type="button" onclick="copyToClipboard('{{ $payment_mode->bankname }}')" class="btn-secondary flex-shrink-0">
                                                <i data-lucide="copy" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                @if (!empty($payment_mode->account_name))
                                    <div>
                                        <label class="form-label">Account Name</label>
                                        <div class="flex gap-2">
                                            <input type="text" class="input-field flex-1" value="{{ $payment_mode->account_name }}" readonly>
                                            <button type="button" onclick="copyToClipboard('{{ $payment_mode->account_name }}')" class="btn-secondary flex-shrink-0">
                                                <i data-lucide="copy" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                @if (!empty($payment_mode->account_number))
                                    <div>
                                        <label class="form-label">Account Number</label>
                                        <div class="flex gap-2">
                                            <input type="text" class="input-field flex-1" value="{{ $payment_mode->account_number }}" readonly>
                                            <button type="button" onclick="copyToClipboard('{{ $payment_mode->account_number }}')" class="btn-secondary flex-shrink-0">
                                                <i data-lucide="copy" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                @if (!empty($payment_mode->swift_code))
                                    <div>
                                        <label class="form-label">Swift Code</label>
                                        <div class="flex gap-2">
                                            <input type="text" class="input-field flex-1" value="{{ $payment_mode->swift_code }}" readonly>
                                            <button type="button" onclick="copyToClipboard('{{ $payment_mode->swift_code }}')" class="btn-secondary flex-shrink-0">
                                                <i data-lucide="copy" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @else
                        {{-- Non-default pay: show bank details for non-default methods --}}
                        <div class="space-y-3 mb-5">
                            @if (!empty($payment_mode->bankname))
                                <div>
                                    <label class="form-label">Bank Name</label>
                                    <div class="flex gap-2">
                                        <input type="text" class="input-field flex-1" value="{{ $payment_mode->bankname }}" readonly>
                                        <button type="button" onclick="myFunction()" class="btn-secondary flex-shrink-0">
                                            <i data-lucide="copy" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($payment_mode->account_name))
                                <div>
                                    <label class="form-label">Account Name</label>
                                    <div class="flex gap-2">
                                        <input type="text" class="input-field flex-1" value="{{ $payment_mode->account_name }}" readonly>
                                        <button type="button" onclick="myFunction()" class="btn-secondary flex-shrink-0">
                                            <i data-lucide="copy" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($payment_mode->account_number))
                                <div>
                                    <label class="form-label">Account Number</label>
                                    <div class="flex gap-2">
                                        <input type="text" class="input-field flex-1" value="{{ $payment_mode->account_number }}" readonly>
                                        <button type="button" onclick="myFunction()" class="btn-secondary flex-shrink-0">
                                            <i data-lucide="copy" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($payment_mode->swift_code))
                                <div>
                                    <label class="form-label">Swift Code</label>
                                    <div class="flex gap-2">
                                        <input type="text" class="input-field flex-1" value="{{ $payment_mode->swift_code }}" readonly>
                                        <button type="button" onclick="myFunction()" class="btn-secondary flex-shrink-0">
                                            <i data-lucide="copy" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                @endif

                {{-- Upload proof form (auto + bank transfer / auto + non-default) --}}
                @if (($settings->deposit_option == 'auto' && $payment_mode->name == 'Bank Transfer') ||
                     ($settings->deposit_option == 'auto' && $payment_mode->defaultpay != 'yes'))
                    <div class="border-t border-border-muted pt-5 mt-5">
                        <p class="text-xs text-content-tertiary mb-3">Wire the exact amount to the firm's client trust account using the details above, then upload your remittance advice for reconciliation.</p>
                        <form method="post" action="{{ route('savedeposit') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Upload remittance advice / payment receipt</label>
                                <input type="file" name="proof" class="input-field" required>
                            </div>
                            <input type="hidden" name="amount" value="{{ $amount }}">
                            <input type="hidden" name="paymethd_method" value="{{ $payment_mode->name }}">
                            <button type="submit" class="btn-primary w-full">
                                <i data-lucide="upload" class="w-4 h-4 mr-2"></i>
                                Submit for reconciliation
                            </button>
                        </form>
                    </div>
                @endif

                {{-- Manual upload (non credit card, non paypal) --}}
                @if ($settings->deposit_option == 'manual' && $payment_mode->name != 'Credit Card' && $payment_mode->name != 'Paypal')
                    <div class="border-t border-border-muted pt-5 mt-5">
                        <p class="text-xs text-content-tertiary mb-3">After completing payment, upload your remittance advice or payment receipt so our reconciliation team can apply it to your matter.</p>
                        <form method="post" action="{{ route('savedeposit') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Upload remittance advice / payment receipt</label>
                                <input type="file" name="proof" class="input-field" required>
                            </div>
                            <input type="hidden" name="amount" value="{{ $amount }}">
                            <input type="hidden" name="paymethd_method" value="{{ $payment_mode->name }}">
                            <button type="submit" class="btn-primary w-full">
                                <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i>
                                Submit for reconciliation
                            </button>
                        </form>
                    </div>
                @endif

            @else
                {{-- Automatic Cryptopayment QR code --}}
                <div class="text-center py-4">
                    <div class="w-14 h-14 rounded-full bg-warning-light flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="scan" class="w-7 h-7 text-warning"></i>
                    </div>
                    <p class="text-sm text-content-secondary mb-4">
                        Send the exact amount of <strong class="text-content">{{ $amount }}</strong> to the secure address below or scan the <strong>{{ $coin }}</strong> QR code. The firm's reconciliation team is notified automatically once funds are detected on-chain.
                    </p>

                    <div class="mb-4">
                        <div class="inline-block bg-surface-muted rounded-lg border border-border-muted p-2 mb-3">
                            <img width="200" height="200" alt="Payment QR code" src="{{ $p_qrcode }}" class="rounded">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-left">Wallet Address</label>
                        <div class="flex gap-2">
                            <input type="text" class="input-field flex-1 text-xs font-mono" value="{{ $p_address }}" id="myInput" readonly>
                            <button type="button" onclick="myFunction()" class="btn-secondary flex-shrink-0">
                                <i data-lucide="copy" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <p class="text-xs text-content-tertiary">
                        You may exit this page once the transaction is broadcast. Funds are credited to your matter file automatically on confirmation, and a formal receipt will be issued.
                    </p>
                </div>
            @endif
        </div>

        {{-- Trust-account disclaimer --}}
        <p class="text-xs text-content-tertiary leading-relaxed mt-4">
            All payments are received into the firm's client trust account in accordance with the terms of your retainer agreement. Transactions are encrypted in transit and reconciled by our finance team.
        </p>
    </div>

    @push('scripts')
    <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            if (copyText) {
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                if (typeof swal !== 'undefined') {
                    swal("Copied", copyText.value, "success");
                }
            }
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                if (typeof swal !== 'undefined') {
                    swal("Copied", text, "success");
                }
            });
        }
    </script>

    @if ($payment_mode->name == 'Credit Card' && ($settings->credit_card_provider ?? '') == 'Stripe' && $title != 'Complete Payment')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        var stripe = Stripe("{{ $settings->s_p_k }}");
        var elements = stripe.elements();
        var style = { base: { color: "#32325d", fontFamily: 'Inter, sans-serif', fontSize: '14px' } };
        const paybtn = document.querySelector('#stripesubmit');
        paybtn.disabled = true;

        var card = elements.create("card", { style: style });
        card.mount("#card-element");

        function checkcardforerrors() {
            card.on('change', function(event) {
                if (event.error) {
                    swal("Error", event.error.message, "error");
                    paybtn.disabled = true;
                } else {
                    paybtn.disabled = false;
                }
            });
        }
        checkcardforerrors();

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(ev) {
            paybtn.disabled = true;
            ev.preventDefault();
            checkcardforerrors();
            document.getElementById('spinner').classList.remove('hidden');
            document.getElementById('buttontext').classList.add('hidden');

            var clientSecret = "{{ $intent }}";
            stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: { name: "{{ Auth::user()->name }}" }
                }
            }).then(function(result) {
                if (result.error) {
                    swal("Error", 'There was an error processing your payment, Please try again from the fee authorisation page', "error");
                    document.getElementById('spinner').classList.add('hidden');
                    document.getElementById('buttontext').classList.remove('hidden');
                    paybtn.disabled = false;
                } else {
                    if (result.paymentIntent.status === 'succeeded') {
                        $.ajax({
                            url: "{{ url('/dashboard/submit-stripe-payment') }}",
                            type: 'POST',
                            data: $('#selectform').serialize(),
                            success: function(data) {
                                swal("Success", data.success, "success");
                                setTimeout(function() {
                                    window.location.replace(data.redirect || "{{ route('user.fee-requests') }}");
                                }, 2000);
                            },
                            error: function(error) {
                                alert('Error Submiting Payment Data');
                                console.log(error);
                            },
                        });
                    }
                }
            });
        });
    </script>
    @endif
    @endpush
@endsection

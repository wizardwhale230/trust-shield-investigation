@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <x-danger-alert />
                <x-success-alert />

                <div class="page-header mb-4">
                    <h4 class="page-title">About This Script</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="{{ url('/admin/dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item">About Script</li>
                    </ul>
                </div>

                {{-- Support Links --}}
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card shadow-sm border-primary">
                            <div class="card-body py-4">
                                <div class="row align-items-center">
                                    <div class="col-md-3 mb-3 mb-md-0">
                                        <h5 class="font-weight-bold text-primary mb-1">Need Help?</h5>
                                        <p class="text-muted mb-0 small">Get support &amp; updates</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="https://chat.whatsapp.com/IGNOxpV7SatAPu3Q4UAGRs?mode=gi_t" target="_blank" class="btn btn-success">
                                                <i class="fab fa-whatsapp mr-1"></i> Join WhatsApp
                                            </a>
                                            <a href="https://t.me/+heFFLpE7w5RjZjQ0" target="_blank" class="btn btn-info">
                                                <i class="fab fa-telegram-plane mr-1"></i> Join Telegram
                                            </a>
                                            <a href="https://remedycodes.com/" target="_blank" class="btn btn-outline-primary">
                                                <i class="fas fa-globe mr-1"></i> Visit Website
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Platform info --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body text-center py-5">
                                <h1 class="font-weight-bold text-primary mb-1">Recovery Platform</h1>
                                <p class="text-muted mb-4">Laravel 8 &bull; Law Firm / Scam Recovery Management System</p>
                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                    <span class="badge badge-primary px-3 py-2">Laravel 8</span>
                                    <span class="badge badge-info px-3 py-2">Livewire v2</span>
                                    <span class="badge badge-success px-3 py-2">Alpine.js v3</span>
                                    <span class="badge badge-warning px-3 py-2">Tailwind CSS</span>
                                    <span class="badge badge-secondary px-3 py-2">Jetstream + Fortify</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick nav --}}
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header"><h5 class="card-title mb-0">Jump to Section</h5></div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="#sec-cases" class="btn btn-sm btn-outline-primary">Case Management</a>
                                    <a href="#sec-team" class="btn btn-sm btn-outline-primary">Team Members</a>
                                    <a href="#sec-fees" class="btn btn-sm btn-outline-primary">Fee Requests</a>
                                    <a href="#sec-documents" class="btn btn-sm btn-outline-primary">Documents</a>
                                    <a href="#sec-users" class="btn btn-sm btn-outline-primary">User Management</a>
                                    <a href="#sec-kyc" class="btn btn-sm btn-outline-primary">KYC Verification</a>
                                    <a href="#sec-tickets" class="btn btn-sm btn-outline-primary">Support Tickets</a>
                                    <a href="#sec-payments" class="btn btn-sm btn-outline-primary">Payments</a>
                                    <a href="#sec-settings" class="btn btn-sm btn-outline-primary">Settings</a>
                                    <a href="#sec-content" class="btn btn-sm btn-outline-primary">Content Management</a>
                                    <a href="#sec-public" class="btn btn-sm btn-outline-primary">Public / Claim Wizard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     1. CASE MANAGEMENT
                ===================================================== --}}
                <div class="row mt-4" id="sec-cases">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0"><i class="fas fa-folder-open mr-2"></i>1. Recovery Case Management</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">The central feature of the platform. Every client file is tracked as a <strong>FraudCase</strong> with statuses, notes, documents and fee requests.</p>

                                <h6 class="font-weight-bold mt-3">Case Statuses (Pipeline)</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead class="thead-light"><tr><th>Status</th><th>Meaning</th></tr></thead>
                                        <tbody>
                                            <tr><td><span class="badge badge-secondary">new</span></td><td>Case filed, awaiting review and assignment</td></tr>
                                            <tr><td><span class="badge badge-info">assigned</span></td><td>A team member / attorney has been assigned to the matter</td></tr>
                                            <tr><td><span class="badge badge-warning">investigating</span></td><td>Active investigation in progress</td></tr>
                                            <tr><td><span class="badge badge-warning">legal_action</span></td><td>Legal proceedings have been initiated</td></tr>
                                            <tr><td><span class="badge badge-success">funds_recovered</span></td><td>Funds have been recovered from the fraudster</td></tr>
                                            <tr><td><span class="badge badge-success">withdrawal_ready</span></td><td>Funds cleared for disbursement to client</td></tr>
                                            <tr><td><span class="badge badge-dark">closed</span></td><td>Matter closed (resolved or concluded)</td></tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h6 class="font-weight-bold mt-4">How to use — Admin</h6>
                                <ol>
                                    <li>Go to <strong>Recovery Cases</strong> in the sidebar to see all cases with filters by status.</li>
                                    <li>Click <strong>View</strong> on any case to open the case file.</li>
                                    <li>Use <strong>Assign Team Member</strong> to assign an attorney from your team.</li>
                                    <li>Use <strong>Update Status</strong> to advance the case through the pipeline.</li>
                                    <li>Use <strong>Add Note</strong> to post docket updates visible to the client.</li>
                                    <li>Use <strong>Credit Recovery</strong> to record an amount recovered on the case — this updates the client's progress bar and available balance.</li>
                                    <li>Use <strong>Create Fee Request</strong> to raise a fee/payment request against this matter.</li>
                                    <li>Download any uploaded evidence documents directly from the case file.</li>
                                </ol>

                                <h6 class="font-weight-bold mt-4">How to use — Client (User)</h6>
                                <ol>
                                    <li>Navigate to <strong>Matters</strong> in the user dashboard to see all filed cases.</li>
                                    <li>Click a case to view the full matter file: status pipeline, assigned attorney, docket notes, documents and fee authorisations.</li>
                                    <li>Upload additional supporting evidence using the <strong>Upload</strong> button in the Evidence section.</li>
                                    <li>Download evidence previously uploaded by clicking the download icon.</li>
                                    <li>Track progress in the <strong>Recovery Pipeline</strong> sidebar panel.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     2. TEAM MEMBERS
                ===================================================== --}}
                <div class="row mt-4" id="sec-team">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h5 class="card-title mb-0"><i class="fas fa-users mr-2"></i>2. Team Members</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Manage the attorneys and recovery specialists who are assigned to client cases. Team members appear in the client's case file as their "Lead Counsel".</p>
                                <h6 class="font-weight-bold mt-3">How to use</h6>
                                <ol>
                                    <li>Go to <strong>Team Members</strong> in the sidebar.</li>
                                    <li>Click <strong>Add New</strong> to create a team member profile: name, job title, specialisation, bio, photo.</li>
                                    <li>Edit or delete existing members with the action buttons.</li>
                                    <li>To assign a member to a case, open the case → click <strong>Assign Team Member</strong> → select from the dropdown.</li>
                                    <li>Clients can view their assigned attorney's full profile from their matter file.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     3. FEE REQUESTS
                ===================================================== --}}
                <div class="row mt-4" id="sec-fees">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-warning">
                                <h5 class="card-title mb-0"><i class="fas fa-file-invoice-dollar mr-2"></i>3. Fee Requests</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Raise billable fee requests against a case. The client sees these in their matter file and can authorise payment by depositing funds.</p>
                                <h6 class="font-weight-bold mt-3">Statuses</h6>
                                <ul>
                                    <li><span class="badge badge-warning">pending</span> — Awaiting client payment</li>
                                    <li><span class="badge badge-success">paid</span> — Client has deposited payment</li>
                                    <li><span class="badge badge-secondary">cancelled</span> — Fee request voided</li>
                                </ul>
                                <h6 class="font-weight-bold mt-3">How to use — Admin</h6>
                                <ol>
                                    <li>Open a case file → click <strong>Create Fee Request</strong>.</li>
                                    <li>Enter a title, amount and optional description → submit.</li>
                                    <li>The fee appears on the client's matter file immediately.</li>
                                    <li>To cancel a pending fee, click <strong>Cancel</strong> next to the fee in the case file.</li>
                                </ol>
                                <h6 class="font-weight-bold mt-3">How to use — Client</h6>
                                <ol>
                                    <li>Open the matter file → scroll to <strong>Fee Authorisations</strong> in the sidebar.</li>
                                    <li>Click <strong>Authorize payment</strong> on any pending fee — this takes you to the deposit page.</li>
                                    <li>Complete payment — the fee status updates once the admin approves the deposit.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     4. DOCUMENT MANAGEMENT
                ===================================================== --}}
                <div class="row mt-4" id="sec-documents">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="card-title mb-0"><i class="fas fa-paperclip mr-2"></i>4. Evidence &amp; Document Management</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Both clients and admin can upload supporting evidence to a case. Files are stored server-side and downloaded through secure controller routes (no public symlink required).</p>
                                <h6 class="font-weight-bold mt-3">Supported file types</h6>
                                <p>JPG, PNG, GIF, PDF, DOC, DOCX, XLS, XLSX, TXT &mdash; max <strong>10 MB</strong> per file.</p>
                                <h6 class="font-weight-bold mt-3">How to use — Client upload</h6>
                                <ol>
                                    <li>Open the matter file → <strong>Evidence &amp; Documents</strong> section.</li>
                                    <li>Click <strong>Upload</strong> → choose file, add optional description → click <strong>Upload Document</strong>.</li>
                                    <li>Click the download icon on any document to download it.</li>
                                </ol>
                                <h6 class="font-weight-bold mt-3">How to use — During initial claim (Claim Wizard)</h6>
                                <ol>
                                    <li>On Step 4 of the claim wizard, click the upload zone or drag files in.</li>
                                    <li>Multiple files can be attached at once — they are saved with the case on submission.</li>
                                </ol>
                                <h6 class="font-weight-bold mt-3">How to use — Admin</h6>
                                <ol>
                                    <li>Open any case → scroll to the <strong>Documents</strong> section.</li>
                                    <li>Click the download button next to any file to retrieve it securely.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     5. USER MANAGEMENT
                ===================================================== --}}
                <div class="row mt-4" id="sec-users">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header" style="background:#5d78ff;color:#fff">
                                <h5 class="card-title mb-0"><i class="fas fa-user-circle mr-2"></i>5. User Management</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Full CRUD over client accounts. Accessed via <strong>Manage Users</strong> in the sidebar.</p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead class="thead-light"><tr><th>Action</th><th>How</th></tr></thead>
                                        <tbody>
                                            <tr><td>View all users</td><td>Sidebar → Manage Users. Use the search/filter bar to find a specific user.</td></tr>
                                            <tr><td>View user profile</td><td>Click the user's name or the <strong>View</strong> button → shows personal info, balance, all cases, KYC status.</td></tr>
                                            <tr><td>Edit user</td><td>User detail page → Actions → <strong>Edit</strong> → update name, email, phone, country.</td></tr>
                                            <tr><td>Reset password</td><td>Actions → <strong>Reset Password</strong> → a new temporary password is set.</td></tr>
                                            <tr><td>Block / Unblock</td><td>Actions → <strong>Block</strong> or <strong>Unblock</strong> — blocks prevent login.</td></tr>
                                            <tr><td>Verify email</td><td>Actions → <strong>Verify Email</strong> — manually marks email as verified.</td></tr>
                                            <tr><td>Adjust balance</td><td>Actions → <strong>Adjust Available Balance</strong> → credit or debit the account balance.</td></tr>
                                            <tr><td>Login as user</td><td>Actions → <strong>Login as [name]</strong> — impersonates the user session for support purposes.</td></tr>
                                            <tr><td>Delete user</td><td>Actions → <strong>Delete</strong> → removes the user and ALL their cases, documents, notes, fee requests, deposits, withdrawals and KYC records.</td></tr>
                                            <tr><td>Bulk operations</td><td>On the Manage Users list, tick checkboxes → choose Delete or Clear from the action dropdown → Apply.</td></tr>
                                            <tr><td>Send email</td><td>Actions → <strong>Send Email</strong> → compose and send a one-off email to the user.</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     6. KYC VERIFICATION
                ===================================================== --}}
                <div class="row mt-4" id="sec-kyc">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0"><i class="fas fa-id-card mr-2"></i>6. KYC / Identity Verification</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Clients must complete KYC before accessing certain dashboard features. Submissions are reviewed by admin.</p>
                                <h6 class="font-weight-bold mt-3">How to use — Admin</h6>
                                <ol>
                                    <li>Sidebar → <strong>KYC Application(s)</strong> to see all submissions.</li>
                                    <li>Click a submission to view the uploaded ID documents (front and back).</li>
                                    <li>Click <strong>Approve</strong> or <strong>Reject</strong> — the client is notified and their status updates.</li>
                                    <li>Alternatively, from a user's detail page → Actions → <strong>Verify Email</strong> (for email-only verification).</li>
                                </ol>
                                <h6 class="font-weight-bold mt-3">How to use — Client</h6>
                                <ol>
                                    <li>Dashboard → <strong>Verify Account</strong> → upload a government-issued photo ID (front and back).</li>
                                    <li>Submit and wait for admin approval — status shows as Pending until reviewed.</li>
                                    <li>Once approved, full dashboard features become accessible.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     7. SUPPORT TICKETS
                ===================================================== --}}
                <div class="row mt-4" id="sec-tickets">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header" style="background:#ff6d00;color:#fff">
                                <h5 class="card-title mb-0"><i class="fas fa-envelope mr-2"></i>7. Support Tickets</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">A threaded messaging system between clients and the admin team. Each ticket has open/closed status.</p>
                                <h6 class="font-weight-bold mt-3">How to use — Admin</h6>
                                <ol>
                                    <li>Sidebar → <strong>Support Tickets</strong> — shows all tickets with a badge count of open ones.</li>
                                    <li>Click a ticket to read the full thread.</li>
                                    <li>Type a reply in the reply box and submit — the client sees it immediately.</li>
                                    <li>Change ticket status to <strong>Closed</strong> when resolved.</li>
                                </ol>
                                <h6 class="font-weight-bold mt-3">How to use — Client</h6>
                                <ol>
                                    <li>Dashboard → <strong>Support</strong> → <strong>My Tickets</strong>.</li>
                                    <li>Click <strong>New Ticket</strong> → choose a subject, write the message, submit.</li>
                                    <li>Replies from counsel appear in the thread — you'll receive an email notification.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     8. PAYMENTS (DEPOSITS & WITHDRAWALS)
                ===================================================== --}}
                <div class="row mt-4" id="sec-payments">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-dark text-white">
                                <h5 class="card-title mb-0"><i class="fas fa-credit-card mr-2"></i>8. Deposits &amp; Withdrawals</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="font-weight-bold">Supported Payment Gateways</h6>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge badge-primary px-3 py-2">Stripe</span>
                                    <span class="badge badge-success px-3 py-2">Paystack</span>
                                    <span class="badge badge-warning px-3 py-2">Flutterwave</span>
                                    <span class="badge badge-info px-3 py-2">BitPay / Crypto</span>
                                    <span class="badge badge-secondary px-3 py-2">Binance Pay</span>
                                    <span class="badge badge-secondary px-3 py-2">PayPal</span>
                                    <span class="badge badge-dark px-3 py-2">Manual Bank Transfer</span>
                                </div>

                                <h6 class="font-weight-bold mt-3">How to use — Deposits (Admin)</h6>
                                <ol>
                                    <li>Sidebar → <strong>Manage Deposits</strong> to see all deposit requests.</li>
                                    <li>For manual transfers, click <strong>View Image</strong> to inspect proof of payment.</li>
                                    <li>Click <strong>Approve</strong> to credit the user's account balance. Click <strong>Delete</strong> to reject.</li>
                                    <li>Use <strong>Edit Amount</strong> if the actual amount differs from requested.</li>
                                    <li>To manually fund a user, open the user's detail page → <strong>Adjust Available Balance</strong>.</li>
                                </ol>

                                <h6 class="font-weight-bold mt-3">How to use — Deposits (Client)</h6>
                                <ol>
                                    <li>Dashboard → <strong>Deposits</strong> → choose a payment method.</li>
                                    <li>Enter the amount → proceed through the selected gateway checkout.</li>
                                    <li>For manual bank transfer, upload proof of payment — admin approves manually.</li>
                                </ol>

                                <h6 class="font-weight-bold mt-3">How to use — Withdrawals (Admin)</h6>
                                <ol>
                                    <li>Sidebar → <strong>Manage Withdrawal</strong> to see pending requests.</li>
                                    <li>Click <strong>Process</strong> on a request → review details → approve.</li>
                                    <li>The user's available balance is deducted on approval.</li>
                                </ol>

                                <h6 class="font-weight-bold mt-3">How to use — Withdrawals (Client)</h6>
                                <ol>
                                    <li>Dashboard → <strong>Withdraw Funds</strong> → select a withdrawal method (bank, crypto wallet, etc.).</li>
                                    <li>Enter the amount → confirm. A request is submitted to admin for processing.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     9. SETTINGS
                ===================================================== --}}
                <div class="row mt-4" id="sec-settings">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header" style="background:#37474f;color:#fff">
                                <h5 class="card-title mb-0"><i class="fas fa-cog mr-2"></i>9. Settings</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Accessible by <strong>Super Admin</strong> only via Settings in the sidebar.</p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead class="thead-light"><tr><th>Setting Area</th><th>What it controls</th></tr></thead>
                                        <tbody>
                                            <tr><td>App Settings</td><td>Company name, logo, favicon, website URL, contact email, currency symbol, timezone</td></tr>
                                            <tr><td>Payment Settings</td><td>Enable/disable gateways (Stripe, Paystack, Flutterwave, BitPay), API keys, manual transfer bank details, crypto wallet addresses</td></tr>
                                            <tr><td>Email Preferences</td><td>SMTP configuration, transactional email on/off toggles, notification templates</td></tr>
                                            <tr><td>Referral Settings</td><td>Referral bonus amounts and reward structure</td></tr>
                                            <tr><td>IP Address Whitelist</td><td>Restrict admin panel access to specific IP addresses</td></tr>
                                            <tr><td>Withdrawal Methods</td><td>Add / edit / remove withdrawal options shown to clients (bank, crypto, PayPal, etc.)</td></tr>
                                            <tr><td>Admin Theme</td><td>Switch the admin dashboard between light and dark mode</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     10. CONTENT MANAGEMENT
                ===================================================== --}}
                <div class="row mt-4" id="sec-content">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0"><i class="fas fa-globe mr-2"></i>10. Website Content Management</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Edit all public-facing website content directly from the admin panel — no code required for most changes.</p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead class="thead-light"><tr><th>Content Area</th><th>How to manage</th></tr></thead>
                                        <tbody>
                                            <tr><td>FAQs</td><td>Frontpage Editor → FAQ section → Add / Edit / Delete questions and answers.</td></tr>
                                            <tr><td>Testimonials</td><td>Frontpage Editor → Testimonials → Add client success stories with name and star rating.</td></tr>
                                            <tr><td>Hero / Page Content</td><td>Frontpage Editor → Content sections → update headlines, body text, and call-to-action buttons.</td></tr>
                                            <tr><td>Images</td><td>Frontpage Editor → Upload images for homepage banners, service icons etc.</td></tr>
                                            <tr><td>Privacy Policy &amp; Terms</td><td>Settings → App Settings → Privacy Policy / Terms &amp; Conditions text editor.</td></tr>
                                            <tr><td>Services / Category Pages</td><td>Managed through the services database — content pages rendered at <code>/services/{slug}</code>.</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     11. PUBLIC SITE & CLAIM WIZARD
                ===================================================== --}}
                <div class="row mt-4" id="sec-public">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0"><i class="fas fa-file-alt mr-2"></i>11. Public Site &amp; Claim Wizard</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">A fully public-facing marketing site and multi-step claim intake wizard. No login required to start a claim.</p>
                                <h6 class="font-weight-bold mt-3">Public pages</h6>
                                <ul>
                                    <li><code>/</code> — Homepage with hero, services and testimonials</li>
                                    <li><code>/services</code> — Services listing</li>
                                    <li><code>/start-your-claim</code> — Claim intake landing page</li>
                                    <li><code>/contact</code> — Contact enquiry form</li>
                                    <li><code>/testimonials</code> — Client success stories</li>
                                    <li><code>/our-company</code> — About the firm</li>
                                    <li><code>/page/{slug}</code> — CMS dynamic pages (e.g. privacy policy, terms)</li>
                                </ul>

                                <h6 class="font-weight-bold mt-3">Claim Wizard (5 steps)</h6>
                                <ol>
                                    <li><strong>Fraud type</strong> — client selects the category of fraud (trading scam, crypto, romance scam, etc.)</li>
                                    <li><strong>Amount lost</strong> — client selects an amount range (e.g. £5,000 – £25,000)</li>
                                    <li><strong>Timeframe</strong> — when the fraud occurred</li>
                                    <li><strong>Case details</strong> — free-text description + optional evidence file upload (up to 10 MB per file)</li>
                                    <li><strong>Account creation</strong> (guests) — or <strong>Review &amp; submit</strong> (existing logged-in users). Guest submissions automatically register a new client account and file the case.</li>
                                </ol>
                                <p>After submission, the case appears in the admin panel with status <code>new</code> and a badge count updates in the sidebar.</p>

                                <h6 class="font-weight-bold mt-3">Logged-in user filing a new case</h6>
                                <ol>
                                    <li>Dashboard → <strong>Matters</strong> → <strong>File a New Claim</strong>.</li>
                                    <li>Fill in fraud type, amount, timeframe, description and upload any documents.</li>
                                    <li>Submit — the case is created and appears in the My Cases list immediately.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================
                     12. ADMIN MANAGEMENT
                ===================================================== --}}
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header" style="background:#880e4f;color:#fff">
                                <h5 class="card-title mb-0"><i class="fas fa-user-shield mr-2"></i>12. Administrator Management</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Available to <strong>Super Admin</strong> only. Manage all admin accounts and their access levels.</p>
                                <ol>
                                    <li>Sidebar → <strong>Administrator(s)</strong> → <strong>Add Manager</strong> to create a new admin account (set name, email, password, type).</li>
                                    <li>Sidebar → <strong>Administrator(s)</strong> → <strong>Manage Admin(s)</strong> to edit, block, unblock or delete existing admins.</li>
                                    <li>Admin types: <strong>Super Admin</strong> (full access), <strong>Admin</strong> (case & user management), limited roles for agents.</li>
                                    <li>Each admin can update their own profile and password from <strong>Admin Profile</strong>.</li>
                                    <li>Two-factor authentication is enforced for all admin logins — a 2FA code is sent to the registered email.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    @endsection

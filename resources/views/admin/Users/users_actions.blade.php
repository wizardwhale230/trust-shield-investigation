 <!-- Assign Case Modal -->
 @if (isset($cases) && $cases->isNotEmpty() && isset($admins))
     <div id="assignCaseModal" class="modal fade" role="dialog">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title">Assign a case for {{ $user->name }}</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                 </div>
                 <div class="modal-body">
                     <form id="assignCaseForm" method="post" action="">
                         @csrf
                         <div class="form-group">
                             <label class="font-weight-bold">Select Case</label>
                             <select id="assignCaseSelect" class="form-control" name="case_id" required>
                                 <option value="" selected disabled>Choose a case</option>
                                 @foreach ($cases as $case)
                                     <option value="{{ $case->id }}"
                                         data-url="{{ route('admin.cases.assign', $case->id) }}"
                                         data-current="{{ $case->assigned_to }}">
                                         {{ $case->case_number }} — {{ $case->fraud_type }}
                                         ({{ $case->status_label ?? $case->status }})
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="form-group">
                             <label class="font-weight-bold">Assign To</label>
                             <select id="assignAdminSelect" class="form-control" name="assigned_to" required>
                                 <option value="" selected disabled>Choose an admin</option>
                                 @foreach ($admins as $adm)
                                     <option value="{{ $adm->id }}">{{ $adm->name ?? trim(($adm->firstName ?? '') . ' ' . ($adm->lastName ?? '')) }} ({{ $adm->email }})</option>
                                 @endforeach
                             </select>
                             <small class="text-muted">The selected admin will be notified and the case status will move to <em>assigned</em>.</small>
                         </div>
                         <div class="form-group mb-0">
                             <button type="submit" class="btn btn-primary" id="assignCaseSubmit" disabled>
                                 <i class="fa fa-user-plus"></i> Assign Case
                             </button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     <script>
         (function () {
             var sel = document.getElementById('assignCaseSelect');
             var form = document.getElementById('assignCaseForm');
             var btn = document.getElementById('assignCaseSubmit');
             var adminSel = document.getElementById('assignAdminSelect');
             if (!sel || !form) return;
             function sync() {
                 var opt = sel.options[sel.selectedIndex];
                 var url = opt ? opt.getAttribute('data-url') : '';
                 form.setAttribute('action', url || '');
                 var current = opt ? opt.getAttribute('data-current') : '';
                 if (current && adminSel) adminSel.value = current;
                 btn.disabled = !url;
             }
             sel.addEventListener('change', sync);
             sync();
         })();
     </script>
 @endif

 <!-- Top Up Modal -->
 <div id="topupModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header ">
                 <h4 class="modal-title ">Adjust Available Balance for {{ $user->name }}.</strong></h4>
                 <button type="button" class="close " data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body ">
                 <form method="post" action="{{ route('topup') }}">
                     @csrf
                     <div class="form-group">
                         <input class="form-control  " placeholder="Enter amount" type="text" name="amount"
                             required>
                     </div>
                     <div class="form-group">
                         <h5 class="">Select adjustment target</h5>
                         <select class="form-control  " name="type" required>
                             <option value="" selected disabled>Select option</option>
                             <option value="balance">Available Balance</option>
                             <option value="Deposit">Record Deposit</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <h5 class="">Select credit to add, debit to subtract.</h5>
                         <select class="form-control  " name="t_type" required>
                             <option value="">Select type</option>
                             <option value="Credit">Credit</option>
                             <option value="Debit">Debit</option>
                         </select>
                         <small> <b>NOTE:</b> You cannot debit deposit</small>
                     </div>
                     <div class="form-group">
                         <input type="hidden" name="user_id" value="{{ $user->id }}">
                         <input type="submit" class="btn " value="Submit">
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- /Adjust Available Balance Modal -->


 <!-- send a single user email Modal-->
 <div id="sendmailtooneuserModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header ">
                 <h4 class="modal-title ">Send Email</h4>
                 <button type="button" class="close " data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body ">
                 <p class="">This message will be sent to {{ $user->name }}</p>
                 <form style="padding:3px;" role="form" method="post" action="{{ route('sendmailtooneuser') }}">
                     @csrf
                     <div class=" form-group">
                         <input type="text" name="subject" class="form-control  " placeholder="Subject" required>
                     </div>
                     <div class=" form-group">
                         <textarea placeholder="Type your message here" class="form-control  " name="message" row="8"
                             placeholder="Type your message here" required></textarea>
                     </div>
                     <div class=" form-group">
                         <input type="hidden" name="user_id" value="{{ $user->id }}">
                         <input type="submit" class="btn " value="Send">
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- /send a single user email Modal -->

 <!-- Edit user Modal -->
 <div id="edituser" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header ">
                 <h4 class="modal-title ">Edit {{ $user->name }} details.</strong></h4>
                 <button type="button" class="close " data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body ">
                 <form role="form" method="post" action="{{ route('edituser') }}">
                     <div class="form-group">
                         <h5 class=" ">Username</h5>
                         <input class="form-control  " id="input1" value="{{ $user->username }}" type="text"
                             name="username" required>
                         <small>Note: same username should be use in the referral link.</small>
                     </div>
                     <div class="form-group">
                         <h5 class=" ">Fullname</h5>
                         <input class="form-control  " value="{{ $user->name }}" type="text" name="name"
                             required>
                     </div>
                     <div class="form-group">
                         <h5 class=" ">Email</h5>
                         <input class="form-control  " value="{{ $user->email }}" type="text" name="email"
                             required>
                     </div>
                     <div class="form-group">
                         <h5 class=" ">Phone Number</h5>
                         <input class="form-control  " value="{{ $user->phone }}" type="text" name="phone"
                             required>
                     </div>
                     <div class="form-group">
                         <h5 class=" ">Country</h5>
                         <input class="form-control  " value="{{ $user->country }}" type="text" name="country">
                     </div>
                     <div class="form-group">
                         <h5 class=" ">Referral link</h5>
                         <input class="form-control  " value="{{ $user->ref_link }}" type="text" name="ref_link"
                             required>
                     </div>
                     <div class="form-group">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <input type="hidden" name="user_id" value="{{ $user->id }}">
                         <input type="submit" class="btn " value="Update">
                     </div>
                 </form>
             </div>
             <script>
                 $('#input1').on('keypress', function(e) {
                     return e.which !== 32;
                 });
             </script>
         </div>
     </div>
 </div>
 <!-- /Edit user Modal -->

 <!-- Reset user password Modal -->
 <div id="resetpswdModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header ">
                 <h4 class="modal-title ">Reset Password</strong></h4>
                 <button type="button" class="close " data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body ">
                 <p class="">Are you sure you want to reset password for {{ $user->name }} to <span
                         class="text-primary font-weight-bolder">user01236</span></p>
                 <a class="btn " href="{{ url('admin/dashboard/resetpswd') }}/{{ $user->id }}">Reset Now</a>
             </div>
         </div>
     </div>
 </div>
 <!-- /Reset user password Modal -->

 <!-- Switch useraccount Modal -->
 <div id="switchuserModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header ">
                 <h4 class="modal-title ">You are about to login as {{ $user->name }}.</strong></h4>
                 <button type="button" class="close " data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body ">
                 <a class="btn btn-success"
                     href="{{ url('admin/dashboard/switchuser') }}/{{ $user->id }}">Proceed</a>
             </div>
         </div>
     </div>
 </div>
 <!-- /Switch user account Modal -->

 <!-- Clear account Modal -->
 <div id="clearacctModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header ">
                 <h4 class="modal-title ">Clear Account</strong></h4>
                 <button type="button" class="close " data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body ">
                 <p class="">You are clearing account for {{ $user->name }} to {{ $settings->currency }}0.00
                 </p>
                 <a class="btn " href="{{ url('admin/dashboard/clearacct') }}/{{ $user->id }}">Proceed</a>
             </div>
         </div>
     </div>
 </div>
 <!-- /Clear account Modal -->

 <!-- Delete user Modal -->
 <div id="deleteModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header ">

                 <h4 class="modal-title ">Delete User</strong></h4>
                 <button type="button" class="close " data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body  p-3">
                 <p class="">Are you sure you want to delete {{ $user->name }} Account? Everything associated
                     with this account will be loss.</p>
                 <a class="btn btn-danger" href="{{ url('admin/dashboard/delsystemuser') }}/{{ $user->id }}">Yes
                     i'm sure</a>
             </div>
         </div>
     </div>
 </div>
 <!-- /Delete user Modal -->

@extends('layouts.master')
@section('meta_title', 'Loan Plan')
@section('contant')

    <div class="p-4">


        <!-- Card START -->
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-light border-0 rounded-top-4 py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Create Party Master
                </h5>
                <small class="text-muted">
                    Fill in the details below to create a new party master.
                </small>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.party-master.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h4>Party Master Info</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Party Code</label>
                            <input type="text" name="party_code" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Cust. Id</label>
                            <input type="text" name="cust_id" value="{{ time() }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Party Name *</label>
                            <input type="text" name="party_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Father Name</label>
                            <input type="text" name="father_name" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Account Group</label>
                            <input type="text" name="account_group" class="form-control" value="Sundry Debtors">
                        </div>
                        <div class="col-md-4">
                            <label>Group</label>
                            <input type="text" name="group" class="form-control">
                        </div>
                    </div>

                    <!-- Address / Contact -->
                    <h4 class="mt-4">Address / Contact</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Address</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label>Area</label>
                            <input type="text" name="area" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>City</label>
                            <input type="text" name="city" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>State</label>
                            <input type="text" name="state" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Pincode</label>
                            <input type="text" name="pincode" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label>Mobile No</label>
                            <input type="tel" name="mobile_no" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Mobile No 2</label>
                            <input type="tel" name="mobile_no2" class="form-control">
                        </div>

                    </div>

                    <!-- Reference 1 -->
                    <h4 class="mt-4">Reference 1 / Guarantor 1 / Co Applicant</h4>
                    <div class="row">
                        <div class="col-md-4"><label>Name</label><input type="text" name="ref1_name"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Father Name</label><input type="text" name="ref1_father_name"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Mobile</label><input type="text" name="ref1_mobile"
                                class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Relation</label><input type="text" name="ref1_relation"
                                class="form-control"></div>
                        <div class="col-md-8"><label>Address</label><input type="text" name="ref1_address"
                                class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>PAN No</label><input type="text" name="ref1_pan_no"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Aadhaar No</label><input type="text" name="ref1_aadhaar_no"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Voter ID</label><input type="text" name="ref1_voter_id"
                                class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Birthdate</label><input type="date" name="ref1_birthdate"
                                class="form-control"></div>
                        <div class="col-md-4">
                            <label>Gender</label>
                            <select name="ref1_gender" class="form-control">
                                <option value="">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4"><label>Pincode</label><input type="text" name="ref1_pincode"
                                class="form-control"></div>
                    </div>

                    <!-- Reference 2 -->
                    <h4 class="mt-4">Reference 2 / Guarantor 2 / Nominee</h4>
                    <div class="row">
                        <div class="col-md-4"><label>Name</label><input type="text" name="ref2_name"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Father Name</label><input type="text" name="ref2_father_name"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Mobile</label><input type="text" name="ref2_mobile"
                                class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Relation</label><input type="text" name="ref2_relation"
                                class="form-control"></div>
                        <div class="col-md-8"><label>Address</label><input type="text" name="ref2_address"
                                class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>PAN No</label><input type="text" name="ref2_pan_no"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Aadhaar No</label><input type="text" name="ref2_aadhaar_no"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Voter ID</label><input type="text" name="ref2_voter_id"
                                class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Birthdate</label><input type="date" name="ref2_birthdate"
                                class="form-control"></div>
                        <div class="col-md-4">
                            <label>Gender</label>
                            <select name="ref2_gender" class="form-control">
                                <option value="">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4"><label>Pincode</label><input type="text" name="ref2_pincode"
                                class="form-control"></div>
                    </div>

                    <!-- Bank & Loan Details -->
                    <h4 class="mt-4">Bank & Loan Details</h4>
                    <div class="row">
                        <div class="col-md-4"><label>Email</label><input type="email" name="email"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Balance</label><input type="number" step="0.01" name="balance"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Loan Limit</label><input type="text" name="loan_limit"
                                class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Bank Name</label><input type="text" name="bank_name"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Branch</label><input type="text" name="branch"
                                class="form-control"></div>
                        <div class="col-md-4"><label>IFSC</label><input type="text" name="ifsc"
                                class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label>Account No</label><input type="text" name="account_no"
                                class="form-control"></div>
                        <div class="col-md-6"><label>Account Holder</label><input type="text" name="account_holder"
                                class="form-control"></div>
                    </div>

                    <!-- Other Info -->
                    <h4 class="mt-4">Other Info</h4>
                    <div class="row">
                        <div class="col-md-4"><label>PAN No</label><input type="text" name="pan_no"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Aadhaar No</label><input type="text" name="aadhaar_no"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Occupation</label><input type="text" name="occupation"
                                class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Voter ID</label><input type="text" name="voter_id"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Birthdate</label><input type="date" name="birthdate"
                                class="form-control"></div>
                        <div class="col-md-4">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label>Remarks</label>
                            <textarea name="remarks" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="image" class="form-label">Aadhaar</label>
                            <input type="file" name="aadhaar" id="input-file-max-fs1" class="dropify dropify-event"
                                data-default-file="{{ isset($profileImage) ? asset($profileImage) : '' }}"
                                data-allowed-file-extensions="png jpg jpeg" data-max-file-size="2M" />
                        </div>
                        <div class="col-md-4">
                            <label for="image" class="form-label">PAN</label>
                            <input type="file" name="pan" id="input-file-max-fs1" class="dropify dropify-event"
                                data-default-file="{{ isset($profileImage) ? asset($profileImage) : '' }}"
                                data-allowed-file-extensions="png jpg jpeg" data-max-file-size="2M" />
                        </div>
                        <div class="col-md-4">
                            <label for="image" class="form-label">Bank-Passbook</label>
                            <input type="file" name="profile" id="input-file-max-fs1" class="dropify dropify-event"
                                data-default-file="{{ isset($profileImage) ? asset($profileImage) : '' }}"
                                data-allowed-file-extensions="png jpg jpeg" data-max-file-size="2M" />
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.loanplan.index') }}" class="btn btn-light border rounded px-4">
                            <i class="bi bi-arrow-left me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary rounded px-4 shadow-sm">
                            <i class="bi bi-save2 me-1"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

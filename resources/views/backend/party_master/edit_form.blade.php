@extends('layouts.master')
@section('meta_title', 'Loan Plan')
@section('contant')
    <div class="p-4">
        <!-- Card START -->
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-light border-0 rounded-top-4 py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    {{ @$editMember ? 'Edit Party Master' : 'Create Party Master' }}
                </h5>
                <small class="text-muted">
                    {{ @$editMember ? 'Update the loan plan details.' : 'Fill in the details below to create a new loan plan.' }}
                </small>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.party-master.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h4>Party Master Info</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Party Code</label>
                            <input type="text" name="party_code" value="{{ $editMember->party_code }}"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Cust. Id</label>
                            <input type="text" name="cust_id" value="{{ @$editMember->cust_id }}" class="form-control"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Party Name *</label>
                            <input type="text" name="party_name" value="{{ @$editMember->party_name }}"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Father Name</label>
                            <input type="text" name="father_name" value="{{ @$editMember->father_name }}"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Account Group</label>
                            <input type="text" name="account_group" value="{{ @$editMember->account_group }}"
                                class="form-control" value="Sundry Debtors">
                        </div>
                        <div class="col-md-4">
                            <label>Group</label>
                            <input type="text" name="group" value="{{ @$editMember->group }}" class="form-control">
                        </div>
                    </div>

                    <!-- Address / Contact -->
                    <h4 class="mt-4">Address / Contact</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Address</label>
                            <textarea name="address" class="form-control">{{ $editMember->address }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label>Area</label>
                            <input type="text" name="area" value="{{ @$editMember->area }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>City</label>
                            <input type="text" name="city" value="{{ @$editMember->city }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>State</label>
                            <input type="text" name="state" value="{{ @$editMember->state }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Pincode</label>
                            <input type="text" name="pincode" value="{{ @$editMember->pincode }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label>Mobile No</label>
                            <input type="tel" name="mobile_no" value="{{ @$editMember->mobile_no }}"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Mobile No 2</label>
                            <input type="tel" name="mobile_no2" value="{{ @$editMember->mobile_no2 }}"
                                class="form-control">
                        </div>

                    </div>

                    <!-- Reference 1 -->
                    <h4 class="mt-4">Reference 1 / Guarantor 1 / Co Applicant</h4>
                    <div class="row">
                        <div class="col-md-4"><label>Name</label><input type="text"
                                value="{{ @$editMember->ref1_name }}" name="ref1_name" class="form-control"></div>
                        <div class="col-md-4"><label>Father Name</label><input type="text"
                                value="{{ @$editMember->ref1_father_name }}" name="ref1_father_name" class="form-control">
                        </div>
                        <div class="col-md-4"><label>Mobile</label><input type="text"
                                value="{{ @$editMember->ref1_mobile }}" name="ref1_mobile" class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Relation</label><input type="text"
                                value="{{ @$editMember->ref1_relation }}" name="ref1_relation" class="form-control">
                        </div>
                        <div class="col-md-8"><label>Address</label><input type="text"
                                value="{{ @$editMember->ref1_address }}" name="ref1_address" class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>PAN No</label><input type="text"
                                value="{{ @$editMember->ref1_pan_no }}" name="ref1_pan_no" class="form-control"></div>
                        <div class="col-md-4"><label>Aadhaar No</label><input type="text"
                                value="{{ @$editMember->ref1_aadhaar_no }}" name="ref1_aadhaar_no" class="form-control">
                        </div>
                        <div class="col-md-4"><label>Voter ID</label><input type="text"
                                value="{{ @$editMember->ref1_voter_id }}" name="ref1_voter_id" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Birthdate</label><input type="date"
                                value="{{ @$editMember->ref1_birthdate }}" name="ref1_birthdate" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Gender</label>
                            <select name="ref1_gender" class="form-control">
                                <option value="">Select</option>
                                <option value="male" {{ @$editMember->ref1_gender == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ @$editMember->ref1_gender == 'female' ? 'selected' : '' }}>
                                    Female</option>
                                <option value="other" {{ @$editMember->ref1_gender == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4"><label>Pincode</label><input type="text"
                                value="{{ @$editMember->ref1_pincode }}" name="ref1_pincode" class="form-control"></div>
                    </div>

                    <!-- Reference 2 -->
                    <h4 class="mt-4">Reference 2 / Guarantor 2 / Nominee</h4>
                    <div class="row">
                        <div class="col-md-4"><label>Name</label><input type="text"
                                value="{{ @$editMember->ref2_name }}" name="ref2_name" class="form-control"></div>
                        <div class="col-md-4"><label>Father Name</label><input type="text"
                                value="{{ @$editMember->ref2_father_name }}" name="ref2_father_name"
                                class="form-control"></div>
                        <div class="col-md-4"><label>Mobile</label><input type="text"
                                value="{{ @$editMember->ref2_mobile }}" name="ref2_mobile" class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Relation</label><input type="text"
                                value="{{ @$editMember->ref2_relation }}" name="ref2_relation" class="form-control">
                        </div>
                        <div class="col-md-8"><label>Address</label><input type="text"
                                value="{{ @$editMember->ref2_address }}" name="ref2_address" class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>PAN No</label><input type="text"
                                value="{{ @$editMember->ref2_pan_no }}" name="ref2_pan_no" class="form-control"></div>
                        <div class="col-md-4"><label>Aadhaar No</label><input type="text"
                                value="{{ @$editMember->ref2_aadhaar_no }}" name="ref2_aadhaar_no" class="form-control">
                        </div>
                        <div class="col-md-4"><label>Voter ID</label><input type="text"
                                value="{{ @$editMember->ref2_voter_id }}" name="ref2_voter_id" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Birthdate</label><input type="date" name="ref2_birthdate"
                                class="form-control"></div>
                        <div class="col-md-4">
                            <label>Gender</label>
                            <select name="ref2_gender" class="form-control">
                                <option value="">Select</option>
                                <option value="male" {{ @$editMember->ref2_gender == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ @$editMember->ref2_gender == 'female' ? 'selected' : '' }}>
                                    Female</option>
                                <option value="other" {{ @$editMember->ref2_gender == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4"><label>Pincode</label><input type="text"
                                value="{{ @$editMember->ref2_pincode }}" name="ref2_pincode" class="form-control"></div>
                    </div>

                    <!-- Bank & Loan Details -->
                    <h4 class="mt-4">Bank & Loan Details</h4>
                    <div class="row">
                        <div class="col-md-4"><label>Email</label><input type="email"
                                value="{{ @$editMember->email }}" name="email" class="form-control"></div>
                        <div class="col-md-4"><label>Balance</label><input type="number"
                                value="{{ @$editMember->balance }}" step="0.01" name="balance" class="form-control">
                        </div>
                        <div class="col-md-4"><label>Loan Limit</label><input type="text"
                                value="{{ @$editMember->loan_limit }}" name="loan_limit" class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Bank Name</label><input type="text"
                                value="{{ @$editMember->bank_name }}" name="bank_name" class="form-control"></div>
                        <div class="col-md-4"><label>Branch</label><input type="text"
                                value="{{ @$editMember->branch }}" name="branch" class="form-control"></div>
                        <div class="col-md-4"><label>IFSC</label><input type="text" value="{{ @$editMember->ifsc }}"
                                name="ifsc" class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label>Account No</label><input type="text"
                                value="{{ @$editMember->account_no }}" name="account_no" class="form-control"></div>
                        <div class="col-md-6"><label>Account Holder</label><input type="text"
                                value="{{ @$editMember->account_holder }}" name="account_holder" class="form-control">
                        </div>
                    </div>

                    <!-- Other Info -->
                    <h4 class="mt-4">Other Info</h4>
                    <div class="row">
                        <div class="col-md-4"><label>PAN No</label><input type="text"
                                value="{{ @$editMember->pan_no }}" name="pan_no" class="form-control"></div>
                        <div class="col-md-4"><label>Aadhaar No</label><input type="text"
                                value="{{ @$editMember->aadhaar_no }}" name="aadhaar_no" class="form-control"></div>
                        <div class="col-md-4"><label>Occupation</label><input type="text"
                                value="{{ @$editMember->occupation }}" name="occupation" class="form-control"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><label>Voter ID</label><input type="text"
                                value="{{ @$editMember->voter_id }}" name="voter_id" class="form-control"></div>
                        <div class="col-md-4"><label>Birthdate</label><input type="date"
                                value="{{ @$editMember->birthdate }}" name="birthdate" class="form-control"></div>
                        <div class="col-md-4">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select</option>
                                <option value="male" {{ @$editMember->gender == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ @$editMember->gender == 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other" {{ @$editMember->gender == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label>Remarks</label>
                            <textarea name="remarks" class="form-control">{{ $editMember->remarks }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="image" class="form-label">Aadhaar</label>
                            <input type="file" name="aadhaar" id="input-file-max-fs1" class="dropify dropify-event"
                                data-default-file="{{ uploaded_asset($editMember->aadhaar) }}"
                                data-allowed-file-extensions="png jpg jpeg" data-max-file-size="2M" />
                        </div>
                        <div class="col-md-4">
                            <label for="image" class="form-label">PAN</label>
                            <input type="file" name="pan" id="input-file-max-fs1" class="dropify dropify-event"
                                data-default-file="{{ uploaded_asset($editMember->pan) }}"
                                data-allowed-file-extensions="png jpg jpeg" data-max-file-size="2M" />
                        </div>
                        <div class="col-md-4">
                            <label for="image" class="form-label">Bank-Passbook</label>
                            <input type="file" name="profile" id="input-file-max-fs1" class="dropify dropify-event"
                                data-default-file="{{ uploaded_asset($editMember->profile) }}"
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

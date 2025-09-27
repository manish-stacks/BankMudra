@extends('layouts.master')
@section('meta_title', 'Loan Plan')
@section('contant')

<div class="page-content-wrapper border">
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0 fw-bold text-dark">Loan Plan</h1>
        </div>
    </div>

    <!-- Card START -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-light border-0 rounded-top-4 py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-file-earmark-text me-2"></i> 
                {{ $editPlan ? 'Edit Loan Plan' : 'Create Loan Plan' }}
            </h5>
            <small class="text-muted">
                {{ $editPlan ? 'Update the loan plan details.' : 'Fill in the details below to create a new loan plan.' }}
            </small>
        </div>

        <div class="card-body p-4">
            <form action="{{ $editPlan ? route('admin.daily.loans.update', $editPlan->id) : route('admin.daily.loans.store') }}" method="POST">
                @csrf
                @if($editPlan)
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <!-- Loan Types -->
                    {{-- <div class="col-md-6">
                        <label for="loan_type_id" class="form-label fw-semibold">Loan Types <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-list-check"></i></span>
                            <select name="loan_type_id" id="loan_type_id" class="form-select rounded-end-3 @error('loan_type_id') is-invalid @enderror" required>
                                <option value="">-- Select Loan Type --</option>
                                @foreach($loanTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('loan_type_id', $editPlan->loan_type_id ?? '') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('loan_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}

                    <!-- Plan Name -->
                    <div class="col-md-6">
                        <label for="plan_name" class="form-label fw-semibold">Plan Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-credit-card-2-front"></i></span>
                            <input type="text" name="plan_name" id="plan_name" 
                                   class="form-control rounded-end-3 @error('plan_name') is-invalid @enderror" 
                                   placeholder="Enter plan name" 
                                   value="{{ old('plan_name', $editPlan->plan_name ?? '') }}" required>
                            @error('plan_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Disbursement -->
                    <div class="col-md-6">
                        <label for="disbursement" class="form-label fw-semibold">Disbursement <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-bank"></i></span>
                            <select name="disbursement" id="disbursement" class="form-select rounded-end-3 @error('disbursement') is-invalid @enderror" required>
                                <option value="">-- Select Disbursement --</option>
                                <option value="bank_transfer" {{ old('disbursement', $editPlan->disbursement ?? '') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="cheque" {{ old('disbursement', $editPlan->disbursement ?? '') == 'cheque' ? 'selected' : '' }}>Cheque</option>
                                <option value="online" {{ old('disbursement', $editPlan->disbursement ?? '') == 'online' ? 'selected' : '' }}>Online Transfer</option>
                            </select>
                            @error('disbursement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Collection -->
                    <div class="col-md-6">
                        <label for="collection" class="form-label fw-semibold">Collection <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-wallet2"></i></span>
                            <select name="collection" id="collection" class="form-select rounded-end-3 @error('collection') is-invalid @enderror" required>
                                <option value="">-- Select Collection --</option>
                                <option value="monthly" {{ old('collection', $editPlan->collection ?? '') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="quarterly" {{ old('collection', $editPlan->collection ?? '') == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                <option value="yearly" {{ old('collection', $editPlan->collection ?? '') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                            </select>
                            @error('collection')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Tenure -->
                    <div class="col-md-6">
                        <label for="tenure" class="form-label fw-semibold">Tenure (Months) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-calendar"></i></span>
                            <input type="number" name="tenure" id="tenure" 
                                   class="form-control rounded-end-3 @error('tenure') is-invalid @enderror" 
                                   placeholder="Enter tenure in months" 
                                   value="{{ old('tenure', $editPlan->tenure ?? '') }}" required>
                            @error('tenure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-toggle-on"></i></span>
                            <select name="status" id="status" class="form-select rounded-end-3 @error('status') is-invalid @enderror" required>
                                <option value="">-- Select Status --</option>
                                <option value="active" {{ old('status', $editPlan->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $editPlan->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Plan Amount -->
                    <div class="col-md-6">
                        <label for="plan_amount" class="form-label fw-semibold">Plan Amount</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-cash-stack"></i></span>
                            <input type="number" name="plan_amount" id="plan_amount" class="form-control rounded-end-3"
                                   placeholder="Enter plan amount"
                                   value="{{ old('plan_amount', $editPlan->plan_amount ?? '') }}">
                        </div>
                    </div>

                    <!-- No of EMI -->
                    <div class="col-md-6">
                        <label for="no_of_emi" class="form-label fw-semibold">No of EMI</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-123"></i></span>
                            <input type="number" name="no_of_emi" id="no_of_emi" class="form-control rounded-end-3"
                                   placeholder="Enter no of EMI"
                                   value="{{ old('no_of_emi', $editPlan->no_of_emi ?? '') }}">
                        </div>
                    </div>

                    <!-- EMI Amount -->
                    <div class="col-md-6">
                        <label for="emi_amount" class="form-label fw-semibold">EMI Amount</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-currency-rupee"></i></span>
                            <input type="number" name="emi_amount" id="emi_amount" class="form-control rounded-end-3"
                                   placeholder="Enter EMI amount"
                                   value="{{ old('emi_amount', $editPlan->emi_amount ?? '') }}">
                        </div>
                    </div>

                    <!-- Paid Amount -->
                    <div class="col-md-6">
                        <label for="paid_amount" class="form-label fw-semibold">Paid Amount</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-wallet"></i></span>
                            <input type="number" name="paid_amount" id="paid_amount" class="form-control rounded-end-3"
                                   placeholder="Enter paid amount"
                                   value="{{ old('paid_amount', $editPlan->paid_amount ?? '') }}">
                        </div>
                    </div>

                    <!-- Recovery Type -->
                    <div class="col-md-6">
                        <label for="recovery_type" class="form-label fw-semibold">Recovery Type</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-receipt"></i></span>
                            <select name="recovery_type" id="recovery_type" class="form-select rounded-end-3">
                                <option value="">-- Select Recovery Type --</option>
                                <option value="daily" {{ old('recovery_type', $editPlan->recovery_type ?? '') == 'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="weekly" {{ old('recovery_type', $editPlan->recovery_type ?? '') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="monthly" {{ old('recovery_type', $editPlan->recovery_type ?? '') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            </select>
                        </div>
                    </div>

                    <!-- File Charge Include -->
                    <div class="col-md-6">
                        <label for="file_charge_include" class="form-label fw-semibold">File Charge Include</label>
                        <select name="file_charge_include" id="file_charge_include" class="form-select rounded-3">
                            <option value="yes" {{ old('file_charge_include', $editPlan->file_charge_include ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('file_charge_include', $editPlan->file_charge_include ?? '') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- File Charge -->
                    <div class="col-md-6">
                        <label for="file_charge" class="form-label fw-semibold">File Charge</label>
                        <input type="number" name="file_charge" id="file_charge" class="form-control"
                               placeholder="Enter file charge"
                               value="{{ old('file_charge', $editPlan->file_charge ?? '') }}">
                    </div>

                    <!-- Process Fee Include -->
                    <div class="col-md-6">
                        <label for="process_fee_include" class="form-label fw-semibold">Process Fee Include</label>
                        <select name="process_fee_include" id="process_fee_include" class="form-select rounded-3">
                            <option value="yes" {{ old('process_fee_include', $editPlan->process_fee_include ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('process_fee_include', $editPlan->process_fee_include ?? '') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- Process Fee Amount -->
                    <div class="col-md-6">
                        <label for="process_fee_amount" class="form-label fw-semibold">Process Fee Amount</label>
                        <input type="number" name="process_fee_amount" id="process_fee_amount" class="form-control"
                               placeholder="Enter process fee amount"
                               value="{{ old('process_fee_amount', $editPlan->process_fee_amount ?? '') }}">
                    </div>

                    <!-- Insurance Fee Include -->
                    <div class="col-md-6">
                        <label for="insurance_fee_include" class="form-label fw-semibold">Insurance Fee Include</label>
                        <select name="insurance_fee_include" id="insurance_fee_include" class="form-select rounded-3">
                            <option value="yes" {{ old('insurance_fee_include', $editPlan->insurance_fee_include ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('insurance_fee_include', $editPlan->insurance_fee_include ?? '') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- Insurance Fee Type -->
                    <div class="col-md-6">
                        <label for="insurance_fee_type" class="form-label fw-semibold">Insurance Fee Type</label>
                        <select name="insurance_fee_type" id="insurance_fee_type" class="form-select rounded-3">
                            <option value="fixed" {{ old('insurance_fee_type', $editPlan->insurance_fee_type ?? '') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            <option value="percentage" {{ old('insurance_fee_type', $editPlan->insurance_fee_type ?? '') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                        </select>
                    </div>

                    <!-- Insurance Fee Amount -->
                    <div class="col-md-6">
                        <label for="insurance_fee_amount" class="form-label fw-semibold">Insurance Fee Amount</label>
                        <input type="number" name="insurance_fee_amount" id="insurance_fee_amount" class="form-control"
                               placeholder="Enter insurance fee amount"
                               value="{{ old('insurance_fee_amount', $editPlan->insurance_fee_amount ?? '') }}">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    {{-- <a href="{{ route('admin.loanplan.index') }}" class="btn btn-light border rounded px-4">
                        <i class="bi bi-arrow-left me-1"></i> Cancel
                    </a> --}}
                    <button type="submit" class="btn btn-primary rounded px-4 shadow-sm">
                        <i class="bi bi-save2 me-1"></i> {{ $editPlan ? 'Update' : 'Submit' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

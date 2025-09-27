@extends('layouts.master')
@section('meta_title', 'Loan Plans')
@section('contant')

    <div class="page-content-wrapper border">
        <div class="row mb-3">
            <div class="col-12 d-sm-flex justify-content-between align-items-center">
                <h1 class="h3 mb-2 mb-sm-0 fw-bold text-dark">Loan Plans</h1>
                <a href="{{route('admin.daily.loans.create')}}" class="btn btn-primary rounded shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Add Loan Plan
                </a>
            </div>
        </div>

        <!-- Card START -->
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">
                <div style=" overflow-x: auto; white-space: nowrap;">
                    <table class="table align-middle table-hover table-striped mb-0" id="myTable">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th scope="col" class="rounded-start">#</th>
                                <th scope="col">Cust id</th>
                                <th scope="col">Loan Id</th>
                                <th scope="col">Loan Date</th>
                                <th scope="col">Party Name</th>
                                <th scope="col">Aadhar No</th>
                                <th scope="col">Mobile No</th>
                                <th scope="col">Principal</th>
                                <th scope="col">Interest</th>
                                <th scope="col">File Charge</th>
                                <th scope="col">Total Charge</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center rounded-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>CUST001</td>
                                <td>LN1001</td>
                                <td>2025-01-15</td>
                                <td><a href="partidetails">Ramesh Kumar</a> </td>
                                <td>1234 5678 9123</td>
                                <td>9876543210</td>
                                <td>₹50,000</td>
                                <td>₹5,000</td>
                                <td>₹1,000</td>
                                <td>₹56,000</td>
                                <td><span class="badge bg-success rounded px-3 py-2">Active</span></td>
                                <td class="text-center">
                                    <a href="javascript:void(0);"
                                        class="btn btn-primary btn-sm rounded px-3 shadow-sm mx-2">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>
                                     <a href="javascript:void(0);"
                                        class="btn btn-info btn-sm rounded px-3 shadow-sm mx-2">
                                        <i class="bi bi-pencil-square me-1">Hold</i> 
                                    </a>
                                     <a href="javascript:void(0);"
                                        class="btn btn-danger btn-sm rounded px-3 shadow-sm mx-2">
                                        <i class="bi bi-pencil-square me-1"></i> Cancel 
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm rounded px-3 shadow-sm">
                                        <i class="bi bi-trash me-1"></i> Delete
                                    </button>
                                </td>
                            </tr>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">

                <!-- Header -->
                <div class="modal-header bg-white border-0 d-flex justify-content-between align-items-start">
                    <div class="w-100 text-center">
                        <div class="text-danger mb-3">
                            <i class="bi bi-trash3-fill fs-1"></i>
                        </div>

                        <h4 class="fw-bold mb-1">Delete Confirmation</h4>
                        <p class="text-muted mb-0">
                            Are you sure you want to delete this record? <br>
                            <span class="fw-semibold text-dark">This action cannot be undone.</span>
                        </p>
                    </div>
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body text-center px-4 pb-4">
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="id" value="" id="deleteId">

                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <button type="button" class="btn btn-light border rounded-pill px-4 py-2"
                                data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 shadow-sm">
                                <i class="bi bi-trash3 me-1"></i> Delete
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    @push('custom_css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" />
        <style>
            .dataTables_wrapper .dataTables_filter input {
                border-radius: 20px;
                padding: 6px 12px;
            }
        </style>
    @endpush

    @push('custom_js')
        <script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();

                $(document).on('click', '.deleteModal', function() {
                    let id = $(this).data('id');
                    $('#deleteId').val(id);
                    $("#deleteModal").modal('show');
                });
            });
        </script>
    @endpush
@endsection

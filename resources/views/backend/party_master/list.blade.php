@extends('layouts.master')
@section('meta_title', 'Loan Plans')
@section('contant')

    <div class="page-content-wrapper border">
        <div class="row mb-3">
            <div class="col-12 d-sm-flex justify-content-between align-items-center">
                <h1 class="h3 mb-2 mb-sm-0 fw-bold text-dark">Party List</h1>
                <a href="{{ route('admin.party-master.create') }}" class="btn btn-primary rounded shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Add Party 
                </a>
            </div>
        </div>

        <!-- Card START -->
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle table-hover table-striped mb-0" id="myTable">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th scope="col" class="rounded-start">#</th>
                                <th scope="col">CustomerID</th>
                                <th scope="col">Party Name</th>
                                <th scope="col">Father Name</th>
                                <th scope="col">Loan Limit</th>
                                <th scope="col">Address</th>
                                <th scope="col">Number</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center rounded-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="fw-semibold text-dark">{{ $loop->iteration }}</td>
                                    <td class="fw-medium">{{ $user->party_code }}</td>
                                    <td>{{ $user->party_name }}</td>
                                    <td>{{ $user->father_name }}</td>
                                    <td>{{ $user->loan_limit }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->mobile_no }}</td>
                                    <td><span class="badge {{$user->status=='active'?'bg-success':'bg-danger'}} rounded px-3 py-2">{{ $user->status=='active'?'Active':'Inactive' }}</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.party-master.edit', $user->id) }}"
                                            class="btn btn-primary btn-sm rounded px-3 shadow-sm mx-2">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm rounded px-3 shadow-sm">
                                            <i class="bi bi-trash me-1"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
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

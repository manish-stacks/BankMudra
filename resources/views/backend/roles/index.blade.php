@extends('layouts.master')
@section('meta_title', 'Roles')
@section('contant')


    <div class="page-content-wrapper border">
        <div class="row mb-3">
            <div class="col-12 d-sm-flex justify-content-between align-items-center">
                <h1 class="h3 mb-2 mb-sm-0">Roles</h1>

                @can('create-role')
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary mb-0">+ Add Role</a>
                @endcan

            </div>

        </div>

        <!-- Card START -->
        <div class="card bg-transparent border">
            <div class="card-body">
                <div class="table-responsive border-0 rounded-3">
                    <table class="table table-dark-gray align-middle p-4 mb-0 table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 rounded-start">#</th>
                                <th scope="col" class="border-0">Role</th>
                                <th scope="col" class="border-0">status</th>
                                <th scope="col" class="border-0 rounded-end">Action</th>
                            </tr>
                        </thead>


                        <tbody>

                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $role->name }}</td>
                                    @php $isSuperAdmin = strtolower($role->name) === 'super admin'; @endphp
                                    <td>
                                        @can('status-role')
                                            <div class="form-check form-switch form-check-md">
                                                <input class="form-check-input" type="checkbox"
                                                    {{ $isSuperAdmin ? 'disabled' : 'onchange=update_status(this)' }}
                                                    value="{{ $role->id }}" id="status_enable_disable"
                                                    {{ $role->status == 1 ? 'checked' : '' }}>
                                            </div>
                                        @endcan
                                    </td>

                                    <td>
                                        @can('edit-role')
                                            <a href="{{ $isSuperAdmin ? '#' : route('admin.roles.edit', $role->id) }}"
                                                class="editLevel btn btn-success-soft btn-round me-1 mb-1 mb-md-0 {{ $isSuperAdmin ? 'disabled' : '' }}"
                                                {{ $isSuperAdmin ? 'onclick=event.preventDefault()' : '' }}>
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endcan

                                        @can('delete-role')
                                            <a href="javascript:void(0);" data-id="{{ $role->id }}"
                                                class="deleteModal btn btn-danger-soft btn-round me-1 mb-1 mb-md-0 {{ $isSuperAdmin ? 'disabled' : '' }}"
                                                {{ $isSuperAdmin ? 'onclick=event.preventDefault()' : '' }}>
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Delete Modal  --}}
    <div class="modal fade admin-query" id="deleteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="addTopicLabel">{{ __('Delete page') }}</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
                            class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.roles.delete')}}" method="post">
                        @csrf
                        <div class="text-center">
                            <h4>{{ __('Are you sure to delete ?') }} </h4>
                        </div>
                        <input type="hidden" name="id" value="" id="deleteId">
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary my-0"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>

                            <button class="btn btn-danger-soft my-0" type="submit">{{ __('Delete') }}</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>




    @push('custom_css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" />
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
        @if ($errors->any())
            <script>
                $(document).ready(function() {
                    $('#levelModal').modal('show');
                });
            </script>
        @endif

               <script>
                function update_status(el) {
                    let url = "{{ route('admin.roles.status_enable_disable') }}";
                    let status = el.checked ? 1 : 0;
                    let target = $(el).data('target');

                    $.post(url, {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: el.value,
                            status: status, // Status (1 or 0)
                            target: target
                        })
                        .done(function(data) {
                            if (data.message === 'success') {
                                toastr.success('Status updated successfully');
                            } else {
                                toastr.error(data.error);
                            }
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            toastr.error('An error occurred while updating the status');
                            console.error('Error:', errorThrown);
                        });
                }
            </script>

    @endpush
@endsection

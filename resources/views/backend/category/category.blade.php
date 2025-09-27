@extends('layouts.master')
@section('meta_title', isset($title) ? $title : (isset($cat) ? 'Sub Categories' : 'Categories'))
@section('contant')


    <div class="page-content-wrapper border">
        <div class="row mb-3">
            <div class="col-12 d-sm-flex justify-content-between align-items-center">
                <h1 class="h3 mb-2 mb-sm-0">{{ isset($cat) ? 'Sub Categories' : 'Categories' }}</h1>

                @can('create-Category')
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal"
                        data-bs-target="#categoryModal">Create a {{ isset($cat) ? 'Sub Categories' : 'Categories' }}</a>
                @endcan

            </div>
            <p>{{ @$cat->name }}</p>
        </div>

        <!-- Card START -->
        <div class="card bg-transparent border">
            <div class="card-body">
                <div class="table-responsive border-0 rounded-3">
                   
                     <table class="table table-dark-gray align-middle p-4 mb-0 table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 rounded-start">Name</th>
                                <th scope="col" class="border-0">Position Order</th>
                                <th scope="col" class="border-0">Status</th>
                                <th scope="col" class="border-0">Show Home</th>
                                <th scope="col" class="border-0 rounded-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Check if categories are available -->
                            @if (isset($categories) && $categories->isNotEmpty())
                                <!-- Loop for Main Categories -->
                                @foreach ($categories as $row)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center position-relative">
                                                <div class="w-60px">
                                                    <img src="{{ uploaded_asset($row->icon) }}" class="rounded icon"
                                                        alt="">
                                                </div>
                                                <h6 class="table-responsive-title mb-0 ms-2">
                                                    <a href="#" class="stretched-link">{{ $row->name }}</a>
                                                </h6>
                                            </div>
                                        </td>
                                        <td>{{ $row->position_order }}</td>

                                        <td>
                                                @can('status-Category')
                                                    <div class="form-check form-switch form-check-md">
                                                        <input class="form-check-input" type="checkbox"
                                                            onchange="update_status(this)" data-target="status"
                                                            value="{{ $row->id }}" id="status_enable_disable"
                                                            {{ $row->status == 1 ? 'checked' : '' }}>
                                                    </div>
                                                @endcan
                                            </td>

                                            <td>
                                                @can('show-home-Category')
                                                    <div class="form-check form-switch form-check-md">
                                                        <input class="form-check-input" type="checkbox"
                                                            onchange="update_status(this)" value="{{ $row->id }}"
                                                            data-target="show_home" id="show_home_enable_disable"
                                                            {{ $row->show_home == 1 ? 'checked' : '' }}>
                                                    </div>
                                                @endcan
                                            </td>


                                            <td>
                                                @can('edit-Category')
                                                    <a href="javascript:void(0);" data-item-id="{{ $row->id }}"
                                                        class="editStudent btn btn-success-soft btn-round me-1 mb-1 mb-md-0">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                @endcan

                                                @can('delete-Category')
                                                    <a href="javascript:void(0);" data-id="{{ $row->id }}"
                                                        class="deleteCategory btn btn-danger-soft btn-round me-1 mb-1 mb-md-0" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                    </tr>
                                @endforeach
                            @else
                                <!-- Message when no categories are available -->
                                <tr>
                                    <td colspan="5" class="text-center">No categories available.</td>
                                </tr>
                            @endif

                            <!-- Check if subcategories are available -->
                            @if (isset($subCategories) && $subCategories->isNotEmpty())
                                <!-- Loop for Subcategories -->
                                @foreach ($subCategories as $subCategory)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center position-relative">
                                                <div class="w-60px">
                                                    <img src="{{ uploaded_asset($subCategory->icon) }}"
                                                        class="rounded icon" alt="">
                                                </div>
                                                <h6 class="table-responsive-title mb-0 ms-2">
                                                    <a href="#" class="stretched-link">{{ $subCategory->name }}</a>
                                                </h6>
                                            </div>
                                        </td>
                                        <td>{{ $subCategory->position_order }}</td>

                                        <td>
                                            <div class="form-check form-switch form-check-md">
                                                <input class="form-check-input" type="checkbox"
                                                    onchange="update_status(this)" data-target="status"
                                                    value="{{ $subCategory->id }}" id="status_enable_disable"
                                                    {{ $subCategory->status == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-check form-switch form-check-md">
                                                <input class="form-check-input" type="checkbox"
                                                    onchange="update_status(this)" value="{{ $subCategory->id }}"
                                                    data-target="show_home" id="show_home_enable_disable"
                                                    {{ $subCategory->show_home == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="javascript:void(0);" data-item-id="{{ $subCategory->id }}"
                                                class="editStudent btn btn-success-soft btn-round me-1 mb-1 mb-md-0">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="javascript:void(0);" data-id="{{ $subCategory->id }}"
                                                class="deleteCategory btn btn-danger-soft btn-round me-1 mb-1 mb-md-0"
                                                title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            @isset($cat)
                                                <a href="{{ route('admin.quiz.paper.create.papper', $subCategory->id) }}"
                                                    class="btn btn-sm btn-info-soft mb-0">Papper</a>
                                            @else
                                                <a href="{{ route('admin.subcategory', $subCategory->slug) }}"
                                                    class="btn btn-sm btn-info-soft mb-0">View</a>
                                            @endisset
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                               
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Add Modal --}}
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="addTopicLabel">Add
                        {{ isset($cat) ? 'Sub Categories' : 'Categories' }}</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
                            class="bi bi-x-lg"></i></button>
                </div>
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="parent_id" value="{{ @$cat->id }}">
                    <div class="modal-body row">

                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}"
                                placeholder="Enter {{ isset($cat) ? 'Sub Categories' : 'Categories' }} name">

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Video link -->
                        <div class="col-md-6">
                            <label class="form-label">Position Order</label>
                            <select class="form-control" name="position_order">
                                @for ($i = 1; $i <= $max_id; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('position_order') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('position_order')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Description -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">icon* (size:100x100)</label>
                            <input type="file" class="form-control" name="icon" accept="image/*" id="uploadInput" />
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <img class="mt-2" id="uploadedImage" src="" alt="Uploaded Image"
                                style="width: 100px;height:100px">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Staus</label>
                            <div class="form-check form-switch form-check-md">
                                <input class="form-check-input" value="1" name="status" type="checkbox"
                                    id="checkPrivacy1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Show Home</label>
                            <div class="form-check form-switch form-check-md">
                                <input class="form-check-input" value="1" name="show_home" type="checkbox"
                                    id="checkPrivacy1">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" id="editor1" placeholder="Enter description">{{ old('description') }}</textarea>

                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success my-0">Save Categories</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- Edit Modal --}}
    <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="addTopicLabel">Edit
                        {{ isset($cat) ? 'Sub Categories' : 'Categories' }}</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                        aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <form action="{{ route('admin.category.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ @$cat->id }}">
                    <input type="hidden" name="id" value="{{ old('id') }}" id="categoryId">
                    <div class="modal-body row">

                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" id="categoryName" name="name"
                                value="{{ old('name') }}" placeholder="Enter Categories name">

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Video link -->
                        <div class="col-md-6">
                            <label class="form-label">Position Order</label>
                            <select class="form-control" name="position_order" id="positionOrder">
                                @for ($i = 1; $i <= $max_id; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('position_order') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('position_order')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Description -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">icon* (size:100x100)</label>
                            <input type="file" class="form-control" name="icon" accept="image/*"
                                id="uploadInput" />
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <img class="mt-2 preImage" id="uploadedImage" src="" alt="Uploaded Image"
                                style="width: 100px;height:100px">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Staus</label>
                            <div class="form-check form-switch form-check-md">
                                <input class="form-check-input" value="1" name="status" type="checkbox"
                                    id="editStatus">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Show Home</label>
                            <div class="form-check form-switch form-check-md">
                                <input class="form-check-input " value="1" name="show_home" type="checkbox"
                                    id="editshowHome">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description"placeholder="Enter description">{{ old('description') }}</textarea>

                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success my-0">Update Categories</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- Delete Modal  --}}
    <div class="modal fade admin-query" id="deleteCategory">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="addTopicLabel">{{ __('Delete Student') }}</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                        aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>



                <div class="modal-body">
                    <form action="{{ route('admin.category.destroy') }}" method="post">
                        @csrf
                        <div class="text-center">
                            <h4>{{ __('Are you sure to delete ?') }} </h4>
                        </div>
                        <input type="hidden" name="id" value="" id="categirytDeleteId">
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
        
         <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/vendor/choices/css/choices.min.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
        <style>
        /* Fix Summernote Modal Display */
        .note-modal {
            z-index: 1051 !important;
        }
        
        .note-modal-backdrop {
            z-index: 1050 !important;
        }

        /* Ensure Summernote Dropdowns are Visible */
        .note-editor .dropdown-menu {
            z-index: 1052 !important;
        }
        .note-modal-backdrop {
    display: none !important;
    }
    .note-link-btn {
        margin-bottom: 15px !important; /* Adjust as needed */
    }

    </style>
    @endpush
    @push('custom_js')
        <script src="{{ static_asset('assets/vendor/choices/js/choices.min.js') }}"></script>

    
           <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize Summernote for Add Modal
        $('#editor1, #description').summernote({
            height: 200,
            placeholder: 'Enter description...',
        });

        // Reinitialize Summernote for Edit Modal when it is shown
        $(document).on('shown.bs.modal', '#editCategory', function () {
            let description = $('#description').val(); // Get existing description
            $('#description').summernote('destroy'); // Destroy previous instance
            $('#description').summernote({
                height: 200,
                placeholder: 'Enter description...',
            });
            $('#description').summernote('code', description); // Load existing content
        });
    });
</script>



        <script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();

                $('#uploadInput').on('change', function() {
                    displayImage(this);
                });

                function displayImage(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('uploadedImage').src = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }


                $(document).on('click', '.editStudent', function() {
                    let student_id = $(this).data('item-id');
                    let url = $('meta[name="site-url"]').attr('content');
                    url = url + '/admin/category/edit/' + student_id
                    let token = $('meta[name="csrf-token"]').attr('content');



                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            '_token': token,
                        },
                        success: function(category) {

                            $('#categoryId').val(category.id);
                            $('#categoryName').val(category.name);
                            $('#description').val(category.description);
                            $('#positionOrder').val(category.position_order);
                            $('.preImage').attr('src', category.icon);
                            $('#editStatus').prop('checked', category.status == 1);
                            $('#editshowHome').prop('checked', category.show_home == 1);

                            $("#editCategory").modal('show');
                        },
                        error: function(data) {
                            toastr.error('Something Went Wrong', 'Error');
                        }
                    });


                });


                $(document).on('click', '.deleteCategory', function() {
                    let id = $(this).data('id');
                    $('#categirytDeleteId').val(id);
                    $("#deleteCategory").modal('show');
                });


            });





            function update_status(el) {
                let url = $('meta[name="site-url"]').attr('content');
                url = url + '/admin/category/status_enable_disable';
                var status = el.checked ? 1 : 0;
                var target = $(el).data('target');

                $.post(url, {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: el.value,
                        status: status,
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
        @if ($errors->any())
            <script>
                $(document).ready(function() {
                    $('#categoryModal').modal('show');
                });
            </script>
        @endif


    @endpush
@endsection

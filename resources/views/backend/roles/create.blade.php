@extends('layouts.master')
@section('meta_title', 'Role Create')
@section('contant')

<div class="page-content-wrapper border">
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">{{ isset($role) && $role->exists ? 'Edit Role' : 'Create Role' }}</h1>
        </div>
    </div>

    <!-- Card START -->
    <div class="card bg-transparent border">

        <form action="{{ isset($role) && $role->exists ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($role) && $role->exists)
            @method('PATCH')
            @endif

            <div class="mx-3 mt-2">
                <!-- Role Name -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mt-2 mb-2">
                            <label class="form-label text-dark fw-bold">Role Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', isset($role) ? $role->name : '') }}" placeholder="Role Name" required>
                        </div>
                    </div>
                </div>

                <!-- Status Selection -->
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group mt-2 mb-2">
                        <label class="form-label text-dark fw-bold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="" >Select Status</option>
                            <option value="1" {{ old('status', isset($role) ? $role->status : '') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', isset($role) ? $role->status : '') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                </div>
            </div>

            <!-- Permissions -->
            <div class="row mt-4 mx-1">
                <div class="col-md-12">
                    <h5 class="text-dark mb-3 fw-bold">Permissions</h5>

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Role</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="role-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="role-card-body">
                            <div class="row">
                                @php
                                $rolePermissions = [
                                'create-role' => 'Create Role',
                                'view-role' => 'View Role',
                                'edit-role' => 'Edit Role',
                                'delete-role' => 'Delete Role',
                                'status-role' => 'Change Status',
                                ];

                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($rolePermissions as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>User</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="user-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="user-card-body">
                            <div class="row">
                                @php
                                $userPermissions = [
                                'create-user' => 'Create User',
                                'view-user' => 'View User',
                                'edit-user' => 'Edit User',
                                'delete-user' => 'Delete User',
                                'status-user' => 'Change Status',
                                ];

                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($userPermissions as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Category</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="category-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="category-card-body">
                            <div class="row">
                                @php
                                $categories = [
                                'create-Category' => 'Create Category',
                                'edit-Category' => 'Edit Category',
                                'delete-Category' => 'Delete Category',
                                'view-Category' => 'View Category',
                                'status-Category' => 'Change Status',
                                'show-home-Category' => 'Show Home',
                                ];

                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($categories as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Student Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Student</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="student-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="student-card-body">
                            <div class="row">
                                @php
                                $students = [
                                'create-student' => 'Create Student',
                                'edit-student' => 'Edit Student',
                                'delete-student' => 'Delete Student',
                                'view-student' => 'View Student',
                                'view-result' => 'View Result',
                                'status-student' => 'Change Status',
                                ];

                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($students as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                    <!-- Subjects Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Subjects</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="subject-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="subject-card-body">
                            <div class="row">
                                @php
                                $Subjects = [
                                'create-subject' => 'Create Subject',
                                'edit-subject' => 'Edit Subject',
                                'delete-subject' => 'Delete Subject',
                                'view-subject' => 'View Subject',
                                'status-subject' => 'Change Status',
                                ];

                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($Subjects as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Instruction Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Instruction</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="instruction-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="instruction-card-body">
                            <div class="row">
                                @php
                                $instructions = [
                                'create-instruction' => 'Create Instruction',
                                'edit-instruction' => 'Edit Instruction',
                                'delete-instruction' => 'Delete Instruction',
                                'view-instruction' => 'View Instruction',
                                'status-instruction' => 'Change Status',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($instructions as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                    <!-- Question Papper Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Question Papper</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="QuestionPapper-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="QuestionPapper-card-body">
                            <div class="row">
                                @php
                                $QuestionPapper = [
                                'create-question-papper' => 'Create Question Papper',
                                'edit-question-papper' => 'Edit Question Papper',
                                'delete-question-papper' => 'Delete Question Papper',
                                'view-question-papper' => 'View Question Papper',
                                'status-question-papper' => 'Change Status',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($QuestionPapper as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Previous Paper Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Previous Paper</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="PreviousPaper-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="PreviousPaper-card-body">
                            <div class="row">
                                @php
                                $PreviousPaper = [
                                'create-previous-paper' => 'Create PreviousPaper',
                                'edit-previous-paper' => 'Edit PreviousPaper',
                                'delete-previous-paper' => 'Delete PreviousPaper',
                                'view-previous-paper' => 'View PreviousPaper',
                                'status-previous-paper' => 'Change Status',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($PreviousPaper as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Syllabus Paper Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Syllabus</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="Syllabus-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="Syllabus-card-body">
                            <div class="row">
                                @php
                                $Syllabus = [
                                'create-syllabus' => 'Create Syllabus',
                                'edit-syllabus' => 'Edit Syllabus',
                                'delete-syllabus' => 'Delete Syllabus',
                                'view-syllabus' => 'View Syllabus',
                                'status-syllabus' => 'Change Status',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($Syllabus as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Question Bank Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Question Bank</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="QuestionBank-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="QuestionBank-card-body">
                            <div class="row">
                                @php
                                $QuestionBank = [
                                'create-question-bank' => 'Create QuestionBank',
                                'edit-question-bank' => 'Edit QuestionBank',
                                'delete-question-bank' => 'Delete QuestionBank',
                                'view-question-bank' => 'View QuestionBank',
                                ];

                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($QuestionBank as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Question Level Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Question Level</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="QuestionLevel-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="QuestionLevel-card-body">
                            <div class="row">
                                @php
                                $QuestionLevel = [
                                'create-question-level' => 'Create QuestionLevel',
                                'edit-question-level' => 'Edit QuestionLevel',
                                'delete-question-level' => 'Delete QuestionLevel',
                                'view-question-level' => 'View QuestionLevel',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($QuestionLevel as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Product Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Products</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="Products-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="Products-card-body">
                            <div class="row">
                                @php
                                $Products = [
                                'create-product' => 'Create Products',
                                'edit-product' => 'Edit Products',
                                'delete-product' => 'Delete Products',
                                'view-product' => 'View Products',
                                'status-product' => 'Change Status',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($Products as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                      <!-- Study Material Card -->
                      <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Study Material</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="Products-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="Products-card-body">
                            <div class="row">
                                @php
                                $Products = [
                                'create-study-material' => 'Create Study Material',
                                'edit-study-material' => 'Edit Study Material',
                                'delete-study-material' => 'Delete Study Material',
                                'view-study-material' => 'View Study Material',
                                'status-study-material' => 'Change Status',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($Products as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Blogs Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Blogs</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="Blogs-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="Blogs-card-body">
                            <div class="row">
                                @php
                                $Blogs = [
                                'create-blogs' => 'Create Blogs',
                                'edit-blogs' => 'Edit Blogs',
                                'delete-blogs' => 'Delete Blogs',
                                'view-blogs' => 'View Blogs',
                                'status-blog' => 'Change Status',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($Blogs as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Reviews Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Reviews</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="Reviews-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="Reviews-card-body">
                            <div class="row">
                                @php
                                $Reviews = [
                                'view-reviews' => 'View Reviews',
                                'delete-reviews' => 'Delete Reviews',
                                'status-reviews' => 'Change Status',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($Reviews as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Orders Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Orders</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="Orders-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="Orders-card-body">
                            <div class="row">
                                @php
                                $Orders = [
                                'view-orders' => 'View Orders',
                                'delete-orders' => 'Delete Orders',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($Orders as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Notes Orders Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Notes Orders</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="NotesOrders-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="NotesOrders-card-body">
                            <div class="row">
                                @php
                                $NotesOrders = [
                                'view-notes-orders' => 'View NotesOrders',
                                'delete-notes-orders' => 'Delete NotesOrders',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($NotesOrders as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Transactions Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Transactions</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="Transactions-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="Transactions-card-body">
                            <div class="row">
                                @php
                                $Transactions = [
                                'view-transactions' => 'View Transactions',
                                'delete-transactions' => 'Delete Transactions',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($Transactions as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Coupons Level Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Coupons</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="Coupons-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="Coupons-card-body">
                            <div class="row">
                                @php
                                $Coupons = [
                                'create-coupons' => 'Create Coupons',
                                'edit-coupons' => 'Edit Coupons',
                                'delete-coupons' => 'Delete Coupons',
                                'view-coupons' => 'View Coupons',
                                'status-coupons' => 'Change Status',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($Coupons as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Shipping Rule Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Shipping Rule</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="ShippingRule-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="ShippingRule-card-body">
                            <div class="row">
                                @php
                                $ShippingRule = [
                                'create-shipping-rule' => 'Create Shipping Rule',
                                'edit-shipping-rule' => 'Edit Shipping Rule',
                                'delete-shipping-rule' => 'Delete Shipping Rule',
                                'view-shipping-rule' => 'View Shipping Rule',
                                'status-shipping-rule' => 'Change Status',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($ShippingRule as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                    <!--General Settings Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>General Settings</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="GeneralSettings-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="GeneralSettings-card-body">
                            <div class="row">
                                @php
                                $GeneralSettings = [
                                'view-general-settings' => 'View GeneralSettings',
                                'update-general-settings' => 'Update GeneralSettings',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($GeneralSettings as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                    <!--Payment Settings Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Payment Settings</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="PaymentSettings-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="PaymentSettings-card-body">
                            <div class="row">
                                @php
                                $PaymentSettings = [
                                'view-payment-settings' => 'View PaymentSettings',
                                'update-payment-settings' => 'Update PaymentSettings',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($PaymentSettings as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Pages Settings Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Pages Settings</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="PagesSettings-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="PagesSettings-card-body">
                            <div class="row">
                                @php
                                $PagesSettings = [
                                'create-pages' => 'Create Pages',
                                'edit-pages' => 'Edit Pages',
                                'delete-pages' => 'Delete Pages',
                                'view-pages' => 'View Pages',
                                'change-status' => 'Change Status',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($PagesSettings as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Sliders Settings Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Sliders Settings</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="SlidersSettings-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="SlidersSettings-card-body">
                            <div class="row">
                                @php
                                $SlidersSettings = [
                                'create-sliders' => 'Create Sliders',
                                'edit-sliders' => 'Edit Sliders',
                                'delete-sliders' => 'Delete Sliders',
                                'view-sliders' => 'View Sliders',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($SlidersSettings as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                    <!-- Pages Settings Card -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
                            <span>Current Links</span>
                            <span class="toggle-icon" style="cursor: pointer;">
                                <i class="fas fa-plus" id="CurrentLinks-toggle-icon"></i>
                            </span>
                        </div>
                        <div class="card-body" id="CurrentLinks-card-body">
                            <div class="row">
                                @php
                                $CurrentLinks = [
                                'create-current-links' => 'Create CurrentLinks',
                                'edit-current-links' => 'Edit CurrentLinks',
                                'delete-current-links' => 'Delete CurrentLinks',
                                'view-current-links' => 'View CurrentLinks',
                                ];
                                $selectedPermissions = isset($role) ? $role->permissions->pluck('name')->toArray() : [];
                                @endphp

                                @foreach($CurrentLinks as $key => $label)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-2">
                                        <span class="text-secondary fw-medium">{{ $label }}</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input fs-4" style="width: 3rem; height: 1.5rem;"
                                                type="checkbox" name="permissions[]" value="{{ $key }}"
                                                {{ in_array($key, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    <!-- Footer -->
    <div class="card-footer d-flex justify-content-start mt-4">
        <a href="{{ route('admin.roles.index') }}">
            <button type="button" class="btn btn-danger mx-3">
                <i class="fas fa-times-circle mr-1 text-white"></i> Cancel
            </button>
        </a>
        <button type="submit" class="btn btn-info">
            <i class="fas fa-check-circle mr-1 text-white"></i> {{ isset($role) && $role->exists ? 'Update' : 'Save' }}
        </button>
    </div>
</div>


</form>


</div>
</div>

@push('custom_js')
<script src="{{ static_asset('assets/vendor/choices/js/choices.min.js') }}"></script>


<script>
    $(document).ready(function() {
        // Initially hide all card bodies
        $('.card-body').hide();

        // On toggle icon click
        $('.toggle-icon').click(function() {
            var cardBody = $(this).closest('.card').find('.card-body');
            var toggleIcon = $(this).find('i');

            // Toggle the card body
            cardBody.slideToggle(200, function() {
                // Change icon based on visibility
                if (cardBody.is(':visible')) {
                    toggleIcon.removeClass('fa-plus').addClass('fa-minus');
                } else {
                    toggleIcon.removeClass('fa-minus').addClass('fa-plus');
                }
            });
        });
    });
</script>
@endpush
@endsection
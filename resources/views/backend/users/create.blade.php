@extends('layouts.master')
@section('meta_title', isset($title) ? $title : 'User Add')
@section('contant')
    <div class="page-content-wrapper border">
        <div class="row d-flex justify-content-center g-4">
            <!-- Left side START -->
            <div class="col-xl-12">
                <div class="card shadow">
                    <!-- Card header -->
                    <div class="card-header border-bottom">
                        <div class="mb-3">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h5 class="card-header-title">User Add</h5>

                                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary mb-0">Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card body START -->
                    <div class="card-body">


                        <form class="form-horizontal"
                            action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}"
                            method="POST" enctype="multipart/form-data">

                            @csrf
                            @if (isset($user))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="image" class="form-label">Profile</label>
                                    <input type="file" name="profile" id="input-file-max-fs1"
                                        class="dropify dropify-event"
                                        data-default-file="{{ isset($profileImage) ? asset($profileImage) : '' }}"
                                        data-allowed-file-extensions="png jpg jpeg" data-max-file-size="2M" />
                                </div>


                                <div class="col-md-9 mt-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name', $user->name ?? '') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email', $user->email ?? '') }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label class="control-label">Password {{ isset($user) ? '' : '*' }}</label>
                                            <input type="password" class="form-control" name="password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label class="control-label">Roles</label>
                                            <select class="form-control" name="role">
                                                <option value="">-- Select Role --</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ old('role', $user->role ?? '') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('admin.users.index') }}">
                                        <button type="button" class="btn btn-danger-soft me-3">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </button>
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> {{ isset($user) ? 'Update' : 'Create' }}
                                    </button>
                                </div>
                            </div>
                        </form>




                    </div>


                    <!-- Card body END -->

                </div>
            </div>
        </div>
    </div>


    @push('custom_css')
        <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/vendor/choices/css/choices.min.css') }}">
    @endpush

    @push('custom_js')
        <script src="{{ static_asset('assets/vendor/choices/js/choices.min.js') }}"></script>
    @endpush

@endsection

@extends('admin.layouts.main')

@section('content')
    <div class="col-10 offset-2 mt-5">
        <div class="col-md-9">
            <a href="{{ route('admin#profile') }}">
                <div class="my-3"><i class="fa-solid fa-circle-arrow-left mr-2"></i>Back</div>
            </a>
            <div class="card p-3">

                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
                </div>
                @if (session('fail'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">

                        <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="alert"
                            aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                        {{ session('fail') }}
                    </div>
                @endif
                <div class="tab-content p-4">
                    <div class="active tab-pane" id="activity">
                        <form class="form-horizontal" action="{{ route('admin#updatePassword') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Old Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control @error('old') is-invalid @enderror"
                                        name="old" placeholder="Enter old password ...">
                                    @error('old')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">New Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control @error('new') is-invalid @enderror"
                                        name="new" placeholder="Enter new password ...">
                                    @error('new')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Confirm Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control @error('confirm') is-invalid @enderror"
                                        name="confirm" placeholder="Re-enter new password ...">
                                    @error('confirm')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-4 col-sm-6">
                                    <button type="submit" class="btn w-25 bg-black text-white updateBtn">Update</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

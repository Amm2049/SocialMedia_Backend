@extends('admin.layouts.main')

@section('content')
    <div class="col-10 offset-2 mt-5">
        <div class="col-md-9">
            <div class="card p-3">
                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">

                        <button type="button" class="btn-close btn btn-success" data-bs-dismiss="alert" aria-label="Close"><i
                                class="fa-solid fa-xmark"></i></button>
                        {{ session('success') }}
                    </div>
                @endif
                <div class="tab-content p-4">
                    <div class="active tab-pane" id="activity">
                        <form class="form-horizontal" action="{{ route('admin#update') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" placeholder="Enter name ..." value="{{ old('name', $user->name) }}">
                                        @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Enter email ..."
                                        value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone"
                                        placeholder="Enter phone number ..." value="{{ old('phone', $user->phone) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea name="address" class="form-control"
                                        placeholder="Enter address ..." cols="30" rows="10">{{ old('address', $user->address) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <select name="gender" class="form-control">
                                        <option value="empty" @if ($user->gender == 'empty') selected @endif>Choose
                                            Gender ...</option>
                                        <option value="male" @if ($user->gender == 'male') selected @endif>Male
                                        </option>
                                        <option value="female" @if ($user->gender == 'female') selected @endif>Female
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn w-25 bg-black text-white updateBtn">Update</button>
                                </div>
                            </div>

                            <div class="form-group row text-right">
                                <div class="offset-sm-2 col-sm-10">
                                    <a href="{{ route('admin#updatePasswordPage') }}">Change Password</a>
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

{{-- @section('script')
    <script>
        $(document).ready(function() {
            $('.updateBtn').click(function() {
                $parentNode = $(this).parents('#parent')
                $name = $parentNode.find('#inputName').val()
                $email = $parentNode.find('#inputEmail').val()
                $phone = $parentNode.find('#inputPhone').val()
                $address = $parentNode.find('#inputAddress').val()
                $gender = $parentNode.find('#inputGender').val()

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8001/profile/update',
                    data: {
                        'name': $name,
                        'email': $email,
                        'phone': $phone,
                        'address': $address,
                        'gender': $gender
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('.message').html('<i class="fa-solid fa-xmark"></i>' + response.message).show();
                        }
                    }
                })
            })
        })
    </script>
@endsection --}}

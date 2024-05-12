@extends('admin.layouts.main')

@section('content')

    <div class="col-4">
        <a href="{{ route('admin#category') }}">
            <div class="my-3"><i class="fa-solid fa-circle-arrow-left mr-2"></i>Back</div>
        </a>
        <div class="card p-3">
            <h5>Edit Category ID : <small class="py-1 px-2 rounded"
                    style="background-color: cyan">{{ $cat->category_id }}</small></h5>
            <form action="{{ route('admin#updateCategory', $cat->category_id) }}" method="post">
                @csrf
                <label class="form-label">Name</label>
                <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $cat->title) }}"
                    name="name" type="text" placeholder="Enter category name ...">
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <label class="form-label mt-3">Deescription</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" cols="30"
                    rows="10" placeholder="Enter description ...">{{ old('description', $cat->description) }}</textarea>
                @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <button class="btn btn-dark w-50 mt-3" type="submit">Update Category</button>
            </form>
        </div>
    </div>
    <div class="col-8">
        <div class="card" style="margin-top:55px">
            @if (session('success'))
                <div class="text-white bg-success p-3" style="display: none" id="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-header">
                <h3 class="card-title">Category Table</h3>

                <div class="card-tools">
                    {{-- <div class="input-group input-group-sm" style="width: 150px;">
                        <form action="{{ route('admin#searchCategory') }}" method="post" class="d-flex">
                            @csrf
                            <input type="text" name="key" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div> --}}
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>category Title</th>
                            <th>category Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $c)
                            <tr @if ($cat->category_id == $c->category_id) style="background-color:cyan;" @endif>
                                <input type="hidden" id="ID" value="{{ $c->category_id }}">
                                <td>{{ $c->category_id }}</td>
                                <td>{{ $c->title }}</td>
                                <td>{{ Str::limit($c->description, 30, ' ...') }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Show the success message
            $("#success-message").fadeIn();

            // Set a timeout to hide the success message after 4 seconds (4000 milliseconds)
            setTimeout(function() {
                $("#success-message").fadeOut();
            }, 4000);
        });
    </script>
@endsection

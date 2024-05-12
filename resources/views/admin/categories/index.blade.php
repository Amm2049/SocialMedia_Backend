@extends('admin.layouts.main')

@section('content')
    <div class="col-4">
        <div class="card p-3">
            <form action="{{ route('admin#createCategory') }}" method="post">
                @csrf
                <label class="form-label">Name</label>
                <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name"
                    type="text" placeholder="Enter category name ...">
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <label class="form-label mt-3">Deescription</label>
                <textarea class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}"
                    name="description" cols="30" rows="10" placeholder="Enter description ..."></textarea>
                @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <button class="btn btn-dark w-50 mt-3" type="submit">Create Category</button>
            </form>
        </div>
    </div>
    <div class="col-8">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Category Table</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <form action="{{ route('admin#searchCategory') }}" method="post" class="d-flex">
                            @csrf
                            <input type="text" name="key" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $c)
                            <tr>
                                <input type="hidden" id="ID" value="{{ $c->category_id }}">
                                <td>{{ $c->category_id }}</td>
                                <td>{{ $c->title }}</td>
                                <td>{{ Str::limit($c->description, 30, ' ...') }}</td>

                                <td>
                                    <a href="{{ route('admin#editCategory',$c->category_id) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <button class="btn btn-sm bg-danger text-white del"><i
                                            class="fas fa-trash-alt"></i></button>
                                </td>
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
            $('.del').click(function() {
                $parentNode = $(this).parents('tr');
                $parentNode.remove();

                $parentNodeMessage = $(this).parents('#message');

                $id = $parentNode.find('#ID').val();

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8001/admin/category/delete',
                    data: {
                        'id': $id
                    },
                    dataType: 'json',
                })
            })
        })
    </script>
@endsection

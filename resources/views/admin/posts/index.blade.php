@extends('admin.layouts.main')

@section('content')
    <div class="col-4">
        <div class="card p-3">
            <form action="{{ route('admin#createPost') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label class="form-label">Title</label>
                <input class="form-control @error('postTitle') is-invalid @enderror" value="{{ old('postTitle') }}"
                    name="postTitle" type="text" placeholder="Enter post title ...">
                @error('postTitle')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <label class="form-label mt-3">Description</label>
                <textarea class="form-control @error('postDescription') is-invalid @enderror"
                    name="postDescription" cols="30" rows="10" placeholder="Enter post description ...">{{ old('postDescription') }}</textarea>
                @error('postDescription')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <label class="form-label mt-3">Image</label>
                <input class="form-control" value="{{ old('postImage') }}" name="postImage" type="file"
                    placeholder="Enter post image ...">

                <label class="form-label mt-3">Category</label>
                <select class="form-control @error('postCategory') is-invalid @enderror" name="postCategory">
                    <option value="">Choose category ...</option>
                    @foreach ($category as $c)
                        <option value="{{ $c->category_id }}">{{ $c->title }}</option>
                    @endforeach
                </select>
                @error('postCategory')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <button class="btn btn-dark w-50 mt-3" type="submit">Create New Post</button>
            </form>
        </div>
    </div>
    <div class="col-8 w-100">
        <div class="card">
            @if (session('success'))
                <div class="text-white bg-success p-3" style="display: none" id="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-header">
                <h3 class="card-title">Posts Table</h3>

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
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $p)
                            <tr>
                                <input type="hidden" id="postId" value="{{ $p->post_id }}">
                                <td>{{ $p->post_id }}</td>
                                <td class="text-left">{{ Str::limit($p->title, 50, ' ...') }}</td>
                                <td>
                                    @if ($p->image == null)
                                    <img class="rounded shadow" style="width:100px; height:50px;" src="{{ asset('defaultImage/default.png') }}">
                                    @else
                                    <img class="rounded shadow" style="width:100px; height:50px;" src="{{ asset('postImages/' . $p->image) }}">
                                    @endif
                                </td>
                                <td>

                                    <a href="{{ route('admin#editPost', $p->post_id ) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <button class="btn btn-sm bg-danger text-white deletePost"><i
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
            // Show the success message
            $("#success-message").fadeIn();

            // Set a timeout to hide the success message after 4 seconds (4000 milliseconds)
            setTimeout(function() {
                $("#success-message").fadeOut();
            }, 4000);



            $('.deletePost').click(function(){
                $parentNode = $(this).parents('tr');
                $postId = $parentNode.find('#postId').val();
                $parentNode.remove();

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8001/admin/post/delete',
                    data: {
                        'postId': $postId
                    },
                    dataType: 'json',
                })
            })
        });
    </script>
@endsection

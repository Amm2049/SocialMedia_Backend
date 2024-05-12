@extends('admin.layouts.main')

@section('content')
    <div class="col-4">
        <div class="card p-3">
            <div class="d-flex justify-content-between mb-3">
                @if ($post->post_id != null)
                <h4 class="">Update Post : <small class="px-2 y-1 rounded"
                    style="background-color: cyan">{{ $post->post_id }}</small></h4>
                @endif
                <div class="">
                    <a href="{{ route('admin#post') }}">
                        <div class=""><i class="fa-solid fa-circle-arrow-left mr-2"></i>Back</div>
                    </a>
                </div>
            </div>
            <form action="{{ route('admin#updatePost',$post->post_id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <label class="form-label">Title</label>
                <input class="form-control @error('postTitle') is-invalid @enderror"
                    value="{{ old('postTitle', $post->title) }}" name="postTitle" type="text"
                    placeholder="Enter post title ...">
                @error('postTitle')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <label class="form-label mt-3">Description</label>
                <textarea class="form-control @error('postDescription') is-invalid @enderror" name="postDescription" cols="30"
                    rows="5" placeholder="Enter post description ...">{{ old('postDescription', $post->description) }}</textarea>
                @error('postDescription')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <label class="form-label mt-3">Image</label>
                <div class="mb-2">
                    @if ($post->image == null)
                        <img class="rounded shadow" src="{{ asset('defaultImage/default.png') }}"
                            style="width: 100%; height: 200px;">
                    @else
                        <img class="rounded shadow" src="{{ asset('postImages/' . $post->image) }}"
                            style="width: 100%; height: 200px;">
                    @endif
                </div>
                <input class="form-control" value="{{ old('postImage') }}" name="postImage" type="file"
                    placeholder="Enter post image ...">

                <label class="form-label mt-3">Category</label>
                <select class="form-control @error('postCategory') is-invalid @enderror" name="postCategory">
                    <option value="">Choose category ...</option>
                    @foreach ($category as $c)
                        <option value="{{ $c->category_id }}" @if ($c->category_id == $post->category_id) selected @endif>
                            {{ $c->title }}</option>
                    @endforeach
                </select>
                @error('postCategory')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                    <button class="btn btn-dark w-50 mt-3" type="submit">Update Selected Post</button>

            </form>
        </div>
    </div>
    <div class="col-8">
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $p)
                            <tr style="@if ($post->post_id == $p->post_id) background-color:cyan; @endif">
                                <input type="hidden" id="postId" value="{{ $p->post_id }}">
                                <td>{{ $p->post_id }}</td>
                                <td>{{ Str::limit($p->description, 30, ' ...') }}</td>
                                <td>
                                    @if ($p->image == null)
                                        <img class="rounded shadow" style="width:100px; height:50px;"
                                            src="{{ asset('defaultImage/default.png') }}">
                                    @else
                                        <img class="rounded shadow" style="width:100px; height:50px;"
                                            src="{{ asset('postImages/' . $p->image) }}">
                                    @endif
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
            }, 3000);
        });
    </script>
@endsection

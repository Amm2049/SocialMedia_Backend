@extends('admin.layouts.main')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trending Posts Table</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Post ID</th>
                            <th>Title</th>
                            <th>Views</th>
                            <th>Image</th>
                            <th></th>
                        </tr>
                    </thead>
                    {{-- @if ($action == null) --}}
                    {{-- @else --}}
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->post_id }}</td>
                                <td class="text-left">{{ Str::limit($item->title, 80, ' ...') }}</td>
                                <td>{{ $item->post_count }} views</td>
                                <td>
                                    @if ($item->image == null)
                                        <img class="rounded shadow" style="width:100px; height:50px;"
                                            src="{{ asset('defaultImage/default.png') }}">
                                    @else
                                        <img class="rounded shadow" style="width:100px; height:50px;"
                                            src="{{ asset('postImages/' . $item->image) }}">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin#trendingPostsEdit', $item->post_id) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- @endif --}}
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection

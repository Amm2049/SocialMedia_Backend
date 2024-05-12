@extends('admin.layouts.main')

@section('content')
    <div class="col-8 card offset-2 my-5 p-4">
        <div class="my-2">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="my-3">{{ $trendingPost->title }}</h3>
                <button class="btn btn-danger" onclick="history.back()">Back</button>
            </div>
        </div>
        <div class="w-100 my-2">
            @if ($trendingPost->image == null)
                <img class="rounded shadow" style="width:100%; height:100%;" src="{{ asset('defaultImage/default.png') }}">
            @else
                <img class="rounded shadow" style="width:100%; height:100%;"
                    src="{{ asset('postImages/' . $trendingPost->image) }}">
            @endif
        </div>
        <div class="my-4">
            <p style="text-align: justify">{{ $trendingPost->description }}</p>
        </div>
    </div>
@endsection

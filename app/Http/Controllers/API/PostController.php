<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //Get Post Datas
    public function posts(){
        $post = Post::get();

        return response()->json([
            'post' => $post
        ]);
    }

    public function postsSearch(Request $request){
        $searchData = Post::where('title','like','%'. $request->searchKey .'%')->get();

        return response()->json([
            'searchData' => $searchData
        ]);
    }

    public function postDetail(Request $request){
        $postDetail = Post::where('post_id',$request->newsId)->first();

        return response()->json([
            'postDetail' => $postDetail
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendingPostsController extends Controller
{
    // Admin Trending Posts Page
    public function index(){
        $data = ActionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as post_count'))
        ->leftJoin('posts','posts.post_id','action_logs.post_id')
        ->groupBy('action_logs.post_id')
        ->get();

        $action = ActionLog::get();

        return view('admin.trend_posts.index',compact('data','action'));
    }

    public function edit($id){
        $trendingPost = Post::where('post_id',$id)->first();
        return view('admin.trend_posts.edit',compact('trendingPost'));
    }
}

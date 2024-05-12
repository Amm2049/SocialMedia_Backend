<?php

namespace App\Http\Controllers\Api;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLogController extends Controller
{
    // View Count
    public function viewCount(Request $request){

        $data = [
            'user_id' => $request->user,
            'post_id' => $request->postId
        ];

        ActionLog::create($data);

        $countData = ActionLog::where('post_id',$request->postId)->get();
        return response()->json([
            'viewData' => $countData
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    // Admins List Page
    public function index(){
        $users = User::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->get();

        return view('admin.admin_lists.index',compact('users'));
    }

    public function delete(Request $request){
        User::where('id',$request->id)->delete();
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    // Admin Posts Page
    public function index(){
        $category = Category::get();
        $post = Post::get();
        return view('admin.posts.index',compact('category','post'));
    }

    public function create(Request $request){

        $this->vali($request);

        if (!empty($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImages' , $fileName);

            $data = $this->getData($request,$fileName);
        } else {
            $data = $this->getData($request,NULL);
        }

        Post::create($data);
        return back()->with([ 'success' => 'Successfully Created ... !' ]);
    }

    public function delete(Request $request){
        $db = Post::where('post_id' , $request->postId)->first();
        $dbImageName = $db -> image;

        if (File::exists(public_path() . '/postImages/' . $dbImageName) && is_file(public_path() . '/postImages/' . $dbImageName)) {
            File::delete(public_path() . '/postImages/' . $dbImageName);
        }

        Post::where('post_id' , $request->postId)->delete();
        ActionLog::where('post_id',$request->postId)->delete();
    }

    public function edit($id){
        $category = Category::get();
        $posts = Post::get();
        $post = Post::where('post_id',$id)->first();
        return view('admin.posts.edit',compact('category','posts','post'));
    }

    public function update($id , Request $request){

        $this->vali($request);
        $update = [
            'title' => $request->postTitle ,
            'description' => $request->postDescription ,
            'category_id' => $request->postCategory ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now()
        ];

        if (isset($request->postImage)) {
            // Delete
            $db = Post::where('post_id' , $id)->first();
            $dbImageName = $db -> image;

            if (File::exists(public_path() . '/postImages/' . $dbImageName) && is_file(public_path() . '/postImages/' . $dbImageName)) {
                File::delete(public_path() . '/postImages/' . $dbImageName);
            }

            //Get
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $update['image'] = $fileName;
            $file->move(public_path() . '/postImages' , $fileName);

            Post::where('post_id' , $id)->update($update);
        } else {
            Post::where('post_id' , $id)->update($update);
        }

        return back()->with([ 'success' => ' Successfully Updated ... !' ]);
    }

    private function vali($request){
        Validator::make($request->all(),[
            'postTitle' => 'required' ,
            'postDescription' => 'required' ,
            'postCategory' => 'required'
        ])->validate();
    }

    private function getData($request,$fileName){
        return [
            'title' => $request->postTitle ,
            'description' => $request->postDescription ,
            'image' => $fileName ,
            'category_id' => $request->postCategory ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now()
        ];
    }
}

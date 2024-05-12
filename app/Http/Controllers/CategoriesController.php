<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    // Admin Categories Page
    public function index(){
        $category = Category::get();
        return view('admin.categories.index',compact('category'));
    }

    public function createCategory(Request $request){
        Validator::make($request->all(),[
            'name' => 'required' ,
            'description' => 'required'
        ])->validate();

        Category::create([
            'title' => $request->name ,
            'description' => $request->description ,
        ]);

        return back()->with([ 'success' => 'Successfully created ... !' ]);
    }

    public function deleteCategory(Request $request){
        Category::where('category_id', $request->id)->delete();
    }

    public function searchCategory(Request $request){
        $category = Category::where('title','like','%'. $request->key .'%')->get();
        return view('admin.categories.index',compact('category'));
    }

    public function editCategory($id){
        $category = Category::get();
        $cat = Category::where('category_id',$id)->first();
        return view('admin.categories.edit',compact('category','cat'));
    }

    public function updateCategory($id,Request $request){
        Validator::make($request->all(),[
            'name' => 'required' ,
            'description' => 'required'
        ])->validate();
        Category::where('category_id',$id)->update([
            'title' => $request->name ,
            'description' => $request->description
        ]);
        return back()->with([ 'success' => ' Successfully Updated ... !' ]);
    }
}

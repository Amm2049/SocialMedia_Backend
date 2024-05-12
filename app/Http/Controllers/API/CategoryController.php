<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Get Category Datas
    public function category(){
        $category = Category::get();

        return response()->json([
            'category' => $category
        ]);
    }

    public function categorySearch(Request $request){
        if ($request->searchCategoryKey == 'all') {
            $result = Post::get();
        } else {
            $result = Post::where('category_id', $request->searchCategoryKey)->get();
        }

        return response()->json([
            'result' => $result
        ]);
    }
}

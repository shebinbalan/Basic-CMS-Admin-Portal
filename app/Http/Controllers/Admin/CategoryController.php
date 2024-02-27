<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index',compact('category'));
    }
    public function add()
    {
        return view('admin.category.add');
    }
    public function insert(Request $request)
    {
       

        $category = new Category();
       
            $category->title = $request->input('title');
            $category->description = $request->input('description');
         
            $category->save();
           return redirect('/home')->with('status','Category Added Successfully');

    }
    public function edit($id)
    {
        $category =Category::find($id);
        return view('admin.category.edit',compact('category'));
    }
    public function update(Request $request ,$id)
    {
        $category =Category::find($id);
      
            $category->title = $request->input('title');
            $category->description = $request->input('description');
            $category->update();
            return redirect('/home')->with('status','Category Updated Successfully');
    }

    public function destroy($id)
          {
               $category =Category::find($id);
             
               $category->delete();
               return redirect('/categories')->with('status','Category Deleted Successfully');
            }

}

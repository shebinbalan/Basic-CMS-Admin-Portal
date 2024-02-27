<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
class TagController extends Controller
{
    public function index()
        {
         $tag = Tag::all();
         return view('admin.tag.index',compact('tag'));
      }
    public function add()
       {
           return view('admin.tag.add');
       }
    public function insert(Request $request)
      {
            $tag = new Tag();       
            $tag->tag = $request->input('tag');
            $tag->description = $request->input('description');
            $tag->save();
            return redirect('/home')->with('status','Tag Added Successfully');

      }
    public function edit($id)
        {
          $tag =Tag::find($id);
          return view('admin.tag.edit',compact('tag'));
        }
    public function update(Request $request ,$id)
         {
            $tag =Tag::find($id);      
            $tag->tag = $request->input('tag');
            $tag->description = $request->input('description');
            $tag->update();
            return redirect('/home')->with('status','Tag Updated Successfully');
          }

    public function destroy($id)
          {
               $tag =Tag::find($id);             
               $tag->delete();
               return redirect('/categories')->with('status','Tag Deleted Successfully');
          }

}

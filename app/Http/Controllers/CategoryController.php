<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories=Category::all();
        // $categories=Category::latest()->get();
        $categories=Category::latest()->paginate(3);
         return view('admin.categories.index', compact('categories')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {

        // 1 validation
        $validated=$request->validate(
            [
                'category_name'=>'required|unique:categories|max:10',

            ],
            
            [
                'category_name.required'=>'write any category',
                'category_name.max'=>'too much words',


            ]
            );
       
            //2 create category
            $category=new Category();  //model
            $category->category_name = $request->category_name; // البيانات الل جاية من فورم هنحطها في الجدول
            $category->user_id = Auth::user()->id; //import id and send to database
            $category->save();
            return redirect()->back()->with('success', 'category add sucsessful'); // back : on the same page



    }

  
    public function show(Category $category){
        //
    }

  
    public function edit($id)
    {
        $category = category::find($id);
        return view('admin.categories.edit', compact('category')); 
    }
 
    public function update(Request $request, $id)
    {
        $category = category::find($id);
        $category->update(
            [
                'category_name' => $request->category_name,
                'user_id' => Auth::user()->id,
            ] );

        return redirect()->route('categories')->with('sucess','category updted sucsseful');

    }

    
    public function hardDelete( $id)
    {
        $category=Category::withTrashed()->find($id);
        $category->forceDelete();
        return redirect()->back()->with('sucess','category Deleted sucsseful');  
    }
    public function softDelete($id)
    {
        $category = category::find($id);
        $category->delete();
        return redirect()->back()->with('sucess','category deleted sucsseful');
    }
    public function deletedcategories()
    {
        $trashedcategories=Category::onlyTrashed()->paginate(3);
        return view('admin.categories.deleted', compact('trashedcategories')) ;
    }
    public function restore($id)
    {
        $category=Category::withTrashed()->find($id);
        $category->restore();
        return redirect()->back()->with('sucess','category restored sucsseful');  
    }
}

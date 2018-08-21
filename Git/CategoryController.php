<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{




        // Constructor function
    public function __construct()
    {
        // Check if user is logged in
        $this->middleware('auth');
    }
    

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('category.index')->with('categories', $categories); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth()->user()->user_rank != 'Member' || Auth()->user()->user_rank != 'Moderator 1' || Auth::user()->user_rank != 'Moderator 2') {
            return view('category.create');        
        } else {
            return redirect('../home')->with('error', 'Unauthorized access!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
     ]);
     
     // Create category
     $category = new Category;
     $category->name = $request->input('name');
     $category->permision = $request->input('permission');
     $category->save();

     return redirect('../Posts')->with('succes', 'Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forumsController = new ForumsController;
        $forums = $forumsController->index($id);
        //var_dump($forums);  
        // var_dump($forums[0]->name); 
        return view('forum.index')->with('forums', $forums);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

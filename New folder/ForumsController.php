<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\Category;

class ForumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {   
        // Get all forums for the category
        $forums = Forum::where('category', '=', $category)->paginate(10);
        // Return forums
        return $forums;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Check if user already have a forum created
        $forum = Forum::where('creator_id', '=', auth()->user()->id)->first();
        if(is_null($forum)) {
            // Get the list of all categories
            $categories = Category::all();
            // Redirect to the create form with the categories variable
            return view('forum.create')->with('categories', $categories);
        } else {
            // Redirect to home page
            return redirect('/home')->with('error', 'You have one forum already!');
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
        // Check if the filds are not empty
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
        ]);
        // Create a new enter to forums table
        $forum = new Forum;
        $forum->name = $request->input('name');
        $forum->posts = 0;
        $forum->members = 0;
        $forum->followers = 0;
        $forum->creator_id = auth()->user()->id;
        $forum->category = $request->input('category');
        $forum->save();

        // Redirect the user to the new forum
        return redirect("/Forum"."/".$request->input('name'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postController = new PostController;
        $posts = $postController->showByForum($id);
        return view('posts.all')->with('posts', $posts);
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

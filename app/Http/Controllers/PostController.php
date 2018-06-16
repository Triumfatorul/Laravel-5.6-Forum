<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Replies;
use App\Category;

class PostController extends Controller
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


        $posts = Category::all();

        return view('posts.index')->with('posts', $posts); 
   }


    public function showCat($category)
    {

        if($category == 'create') {
            $categories = Category::all();
             return view('posts.create')->with('categories', $categories);
        } else {
        $posts = Post::where([
            ["category", "=", $category],
            ["suspended", "!=", 1],
            ])->paginate(10);

        return view('posts.indexByCat')->with('posts', $posts); 
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
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
     ]);
     
     // Create post
     $post = new Post;
     $post->title = $request->input('title');
     $post->body = $request->input('content');
     $post->user_id = auth()->user()->id;     
     $post->suspended = 0;
     $post->category = $request->input('category');
     $post->save();


     return redirect('../public/Posts')->with('succes', 'Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category, $id)
    {
        $post = Post::find($id);
        // Select all replies for this post
         $replies = Replies::where("post_id", "=", $id)->paginate(5);
        // Make an array with replies && posts
         $data = array(
                    $post,
                    $replies,
                );

        return view('posts.show')->with('data', $data);
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::find($id);
        if($posts->user_id == auth()->user()->id) {
            return view('posts.edit')->with('posts', $posts); 
        } elseif(auth()->user()->user_rank != 'Member') {
             $posts->suspended = true;
             $posts->save();
            return redirect('../public/home')->with('succes', 'Post was suspended! Wait for approvment!');  
        }
            return redirect('../public/Posts')->with('error', 'Unauthorized access!');
    
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

       $this->validate($request, [
         'title' => 'required',
         'content' => 'required',
      ]);
                 
       // Create post
       $post = Post::find($id);
       $post->title = $request->input('title');
       $post->body = $request->input('content');
       $post->save();

       return redirect('../public/Posts')->with('succes', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::find($id);
        if($posts->user_id == auth()->user()->id || auth()->user()->user_rank != 'Member' || auth()->user()->user_rank != 'Moderator 1' || auth()->user()->user_rank != 'Moderator 2') {
            
                $posts->delete();
                return redirect('../public/Posts')->with('succes', 'Post deleted');
        } 
        return redirect('../public/Posts')->with('error', 'Unauthorized access!');
    }

}

<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use Illuminate\Http\Request;
use App\Post;
use App\Replies;
use App\Category;
use App\Forum;

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
    public function index($forum)
    {
        // Get all posts from a forum
        $posts = Post::where("forum", "=", $forum)->paginate(10);
        // Return the posts
        return $posts;      
   }


    public function create($forum)
    {
        return view('posts.create')->with('forum', $forum);
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
            'forum' => 'required',
     ]);
     
     // Create post
     $post = new Post;
     $post->title = $request->input('title');
     $post->body = $request->input('content');
     $post->user_id = auth()->user()->id;     
     $post->suspended = 0;
     $post->forum = $request->input('forum');
     $post->save();
    
     // Find the forum
     $forum = Forum::where('name', '=', $request->input('forum'))->first();
     // Increase the posts count
     $forum->posts = $forum->posts+1;
     $forum->save();

     return redirect('../Forum/'.$request->input('forum'))->with('succes', 'Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
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
        $posts = Post::findOrFail($id);
        if($posts->user_id == auth()->user()->id) {
            return view('posts.edit')->with('posts', $posts); 
        } elseif(auth()->user()->user_rank != 'Member') {
             $posts->suspended = true;
             $posts->save();
            return redirect('../home')->with('succes', 'Post was suspended! Wait for approvment!');  
        }
            return redirect('../Forum/'.$posts->forum)->with('error', 'Unauthorized access!');
    
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

       return redirect('../Forum/'.$post->forum)->with('succes', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->user_id == auth()->user()->id || auth()->user()->user_rank != 'Member' || auth()->user()->user_rank != 'Moderator 1' || auth()->user()->user_rank != 'Moderator 2') {
                $post->delete();
                $forum = Forum::where('name', '=', $post->forum)->first();
                $forum->posts = $forum->posts-1;
                $forum->save();
                return redirect('../Forum/'.$post->forum)->with('succes', 'Post deleted');
        } 
        return redirect('../Forum/'.$post->forum)->with('error', 'Unauthorized access!');
    }


    
}

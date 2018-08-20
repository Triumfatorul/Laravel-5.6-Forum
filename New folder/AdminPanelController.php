<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class AdminPanelController extends Controller
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
         if(Auth()->user()->user_rank == 'Admin 1' || Auth()->user()->user_rank == 'Admin 2' || Auth()->user()->user_rank == 'Admin 3') {
              return view('AdminPanel.main');  
        } else {
           return redirect('home')->with('error', 'Unauthorized access!');        
        }

        
    }

     public function suspended_posts()
    {

        if(Auth()->user()->user_rank == 'Admin 1' || Auth()->user()->user_rank == 'Admin 2' || Auth()->user()->user_rank == 'Admin 3') {
            $posts = Post::where('suspended', '!=', 0)->paginate(10);
            return view('AdminPanel.suspended')->with('posts', $posts);
        } else {
            return redirect('../home')->with('error', 'Unauthorized access!');        
        }
    }

    // Function for approve a suspend
    public function approve($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('../AdminPanel/suspended')->with('succes', 'Post was deleted!');
    }

    // Function for reject a suspend
    public function reject($id)
    {
        $post = Post::find($id);
        $post->suspended = false;
        $post->save();
        return redirect('AdminPanel/suspended')->with('succes', 'Post was unsuspended!');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Replies;

class RepliesController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_id)
    {
        
        //Go to create reply file
        return view('replies.create')->with('post_id', $post_id);
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
            'content' => 'required',
            'post_id' => 'required',
            ]);
     
     // Create post
     $reply = new Replies;
     $reply->body = $request->input('content');
     $reply->post_id =  $request->input('post_id');
     $reply->user_id = auth()->user()->id;
     $reply->save();

     return redirect('../public/Posts')->with('succes', 'Reply created');
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
        $reply = Replies::find($id);
        if($reply->user_id == auth()->user()->id) {
            return view("replies.edit")->with('reply', $reply);
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
            'content' => 'required',
     ]);
     
     // Create reply
     $reply = Replies::find($id);
     $reply->body = $request->input('content');
     $reply->save();

     return redirect('../public/Posts')->with('succes', 'Reply updated');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $reply = Replies::find($id);
        if($reply->user_id == auth()->user()->id) {
            $reply->delete();
        return redirect('../public/Posts')->with('succes', 'Reply deleted');
        } 
        return redirect('../public/Posts')->with('error', 'Unauthorized access!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;

class FriendsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @reqvwturn voidywjvcfa
     */
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
        $friends = Friend::all();
        return view('friends.index')->with('friends', $friends);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $friend_check = Friend::select('id')->where([
                                            ['sentBy', '=', Auth()->user()->id],
                                            ['sentTo', '=', $id],
                                        ])->get();

        if(count($friend_check) > 0) {
           return redirect('../Friends')->with('succes', 'You already sent a friend request to that user!');
        } 
            $friend = new Friend;
            $friend->sentBy = Auth()->user()->id;
            $friend->sentTo = $id;
            $friend->accepted = 0;
            $friend->save();
            return redirect('../Friends')->with('succes', 'Friend request sent!');
            
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
        $friend = Friend::find($id);
        $friend->accepted = 1;
        $friend->save();
        return redirect('../Friends')->with('succes', 'Friend request accepted!');
    }

    public function destroy($id)
    {
        Friend::destroy($id);
        return redirect('../Friends')->with('succes', 'Friend request rejected!');
    }

}
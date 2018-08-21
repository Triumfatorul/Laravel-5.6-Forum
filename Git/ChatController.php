<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conversations = Chat::select("sender_id", "reciver_id")
                               ->distinct()
                               ->where('reciver_id', '=', auth()->user()->name)
                               ->orWhere('sender_id', '=', auth()->user()->name)
                               ->paginate(15);

                               

        return view('chat.index')->with('conversations', $conversations);
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
      $this->validate($request, [
            'content' => 'required',
            'sender' => 'required',
      ]);
     
     // Create chat messages
     $chat = new Chat;
     $chat->content = $request->input('content');
     $chat->sender_id = auth()->user()->name;     
     $chat->reciver_id = $request->input('sender');
     $chat->save();
     $id = $request->input('sender');

   return redirect("../Chat/$id")->with('succes', 'Message sent');   
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conversation = Chat::select("content","sender_id", "reciver_id")
                                ->where([
                                        ["sender_id", "=", $id],
                                        ["reciver_id", "=", auth()->user()->name],
                                    ])
                               ->orWhere([
                                        ["sender_id", "=", auth()->user()->name],
                                        ["reciver_id", "=", $id],
                                    ])
                               ->paginate(10); 

        $data = array(
                        $conversation,
                        $id,
                     );
        return view('chat.conversation')->with('data', $data); 
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

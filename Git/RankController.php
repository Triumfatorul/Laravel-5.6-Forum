<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rank;
use App\Ban;

class RankController extends Controller
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


    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',     ]);
     
        
        $users = User::select('id', 'name')->where([
                                            ['name', '!=', Auth()->user()->name],
                                            ['name', 'like', "%".$request->input('search')."%"],
                                            ])->paginate(10);
        return view('rank.search')->with('users', $users);
    }

     public function showBanUserForm($id)
    {
        $user = User::find($id);
        if(Auth()->user()->user_rank == 'Admin 1' || Auth()->user()->user_rank == 'Admin 2' || Auth()->user()->user_rank == 'Admin 3' &&  $user->banned == 0) {
            

            return view('rank.ban')->with('user', $user);
        } else {
            if ($user->banned) {
                return redirect('../home')->with('error', 'This user is already banned');
            }

            return redirect('../home')->with('error', 'Unauthorized access!');
        }
    }

     public function banUser(Request $request ,$id)
    {


        $user = User::find($id);
        
        if(Auth()->user()->user_rank == 'Admin 1' || Auth()->user()->user_rank == 'Admin 2' || Auth()->user()->user_rank == 'Admin 3'   &&  $user->banned == 0) {
 
            $time =  $request->input('time');
            $reason =  $request->input('reason');

            
            $user->banned = true;
            $user->save();

            $ban = new Ban;
            $ban->ban_by = Auth()->user()->id;
            $ban->user_banned = $id;
            $ban->reason = $reason;
            $ban->ban_for = $time;
            $ban->expired = 0;
            if($time > 1) {
                $ban->expire_on = date("Y-m-d H:i:s", strtotime('+'.$time.' days'));
            } else {
                $ban->expire_on = date("Y-m-d H:i:s", strtotime('+'.$time.' day'));
            }
            $ban->save(); 

            return redirect('../Rank/'.$user->id)->with('succes', 'You banned '.$user->name.' succesful for '.$time.' day(s)!');
        } else {
             if ($user->banned) {
                return redirect('../home')->with('error', 'This user is already banned');
            }

            return redirect('../home')->with('error', 'Unauthorized access!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        return view('rank.create');
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
            'description' => 'required',
     ]);
     


     // Create reply
     $rank = new Rank;
     $rank->name = $request->input('name');
     $rank->description = $request->input('description');
     if($request->input('Moderator_Panel_1') == 'true') {
        $rank->Moderator_Panel_1 = 1;
    } else {
        $rank->Moderator_Panel_1 = 0;
    }

     if($request->input('Moderator_Panel_2') == 'true') {
        $rank->Moderator_Panel_2 = 1;
    } else {
        $rank->Moderator_Panel_2 = 0;
    }

     if($request->input('Admin_Panel_1') == 'true') {
        $rank->Admin_Panel_1 = 1;
    } else {
        $rank->Admin_Panel_1 = 0;
    }

     if($request->input('Admin_Panel_2') == 'true') {
        $rank->Admin_Panel_2 = 1;
    } else {
        $rank->Admin_Panel_2 = 0;
    }

     if($request->input('Admin_Panel_3') == 'true') {
        $rank->Admin_Panel_3 = 1;
    } else {
        $rank->Admin_Panel_3 = 0;
    }
     $rank->save();


     return redirect('../home')->with('succes', 'The rank was created succesful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id != 'search') {
            $user = User::findOrFail($id);
            if($user->banned) {
                $ban = Ban::select('expire_on')->where([
                                                        ['user_banned', '=', $id],
                                                        ["expired", "=", 0],
                                                    ])->get();
                $data = array(
                        $user,
                        $ban,
                    );
            } else {
                $data = array(
                            $user,
                        );
            }

            return view('rank.show')->with('data', $data);
        
    } else {
        return redirect('home');
    }
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(auth()->user()->id);
        if($user->user_rank != 'Member' || $user->user_rank != 'Moderator 1' || $user->user_rank != 'Moderator 2' || $user->user_rank != 'Admin 1') {
                $user = User::find($id);

                $ranks = Rank::select('name')->get();

                $data = array(
                        $user,
                        $ranks,
                        );
                // Return the view of change rank with users
                return view('rank.edit')->with('data', $data);
            } else {
                return redirect('../home')->with('error', 'Unauthorized access!');

            }
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
            'rank' => 'required',
     ]);
     
     // Create reply
     $user = User::find($id);
     $user->user_rank = $request->input('rank');
     $user->save();


     return redirect('../home')->with('succes', 'The rank of '.$user->name.' was updated succesful');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\Category;
use App\Fallower;
use App\Member;

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
        //var_dump($forums);
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
        // Create a new instance of post controller and call the index method
        $postController = new PostController;
        $posts = $postController->index($id);
        // Get the forum category
        $forum = Forum::where('name', '=', $id)->first();
        $category = $forum->category;
        // Return the view
        return view('posts.all')->with('posts', $posts)->with('forum', $id)->with('category', $category);
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

    public function fallow($id)
    {
        // Check if user already fallow this forum
        $fallow = Fallower::where([
                                    ['user_id', '=', auth()->user()->id],
                                    ['forum', '=', $id],
                                    ])->first();
        if(is_null($fallow)) {
            // Make a new instance of the FallowsController
            $fallowsController = new FallowersController;
            // Call the store method
            $fallowsController->store($id);
            // Increase the followers value
            $forum = Forum::where('name', '=', $id)->first();
            $forum->followers = $forum->followers+1;
            $forum->save();
            // Redirect to the forum page with a succes message
            return redirect('../../Forum/'.$id)->with('succes', 'You successfully fallow this forum!');       
        } else {
            // Redirect to the forum page with an error message
            return redirect('../Forum/'.$id)->with('error', 'You already fallow this forum!');       
        }
    }


    public function unfallow($id) {
            // Check if user already fallow this forum
            $fallow = Fallower::where([
                                    ['user_id', '=', auth()->user()->id],
                                    ['forum', '=', $id],
                            ])->first();
            if(!is_null($fallow)) {
                // Make a new instance of the FallowsController
                $fallowsController = new FallowersController;
                // Call the destroy method
                $fallowsController->destroy($fallow);
                // Decrease the followers value
                $forum = Forum::where('name', '=', $id)->first();
                $forum->followers = $forum->followers-1;
                $forum->save();
                // Redirect to the forum page with a succes message
                return redirect('../../Forum/'.$id)->with('succes', 'You successfully unfallow this forum!');       
            } else {
                // Redirect to the forum page with an error message
                return redirect('../Forum/'.$id)->with('error', 'You don\'t fallow this forum!');       
            }
    }


    public function join($id)
    {
        // Check if user is already a member of this forum
        $member = Member::where([
                                    ['user_id', '=', auth()->user()->id],
                                    ['forum', '=', $id],
                                ])->first();
        if(is_null($member)) {
            // Make a new instance of the MembersController
            $membersController = new MembersController;
            // Call the store method
            $membersController->store($id);
            // Increase the members value
            $forum = Forum::where('name', '=', $id)->first();
            $forum->members = $forum->members+1;
            $forum->save();
            // Redirect to the forum page with a succes message
            return redirect('../../Forum/'.$id)->with('succes', 'You successfully join this forum!');       
        } else {
            // Redirect to the forum page with an error message
            return redirect('../Forum/'.$id)->with('error', 'You are already a member of this forum!');       
        }
    }

    public function leave($id)
    {
            // Check if user already fallow this forum
            $member = Member::where([
                                    ['user_id', '=', auth()->user()->id],
                                    ['forum', '=', $id],
                            ])->first();
            if(!is_null($member)) {
                // Make a new instance of the FallowsController
                $membersController = new membersController;
                // Call the destroy method
                $membersController->destroy($member);
                // Decrease the members value
                $forum = Forum::where('name', '=', $id)->first();
                $forum->members = $forum->members-1;
                $forum->save();
                // Redirect to the forum page with a succes message
                return redirect('../../Forum/'.$id)->with('succes', 'You successfully leave this forum!');       
            } else {
                // Redirect to the forum page with an error message
                return redirect('../Forum/'.$id)->with('error', 'You are not a member of this forum!');       
            }
    }
}

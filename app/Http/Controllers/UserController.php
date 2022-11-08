<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        try{
            $user = new User($request->all());
            $user->save();
            return redirect('login');
        }catch(\Exception $e){
            return back()->withInput()->withErrors(['userCreateError' => 
            'An error ocurred creating the user']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
        try{
            $user->update($request->all());
            session(['user' => $user]);
            return redirect('user/' . $user->id);
        }catch(\Exception $e){
            return back()->withInput()->withErrors(['userEditError' => 
            'An error ocurred editing the user']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    
    public function posts(User $user)
    {
        $categories = Category::all();
        $posts = Post::where('idUser', $user->id)->orderBy('created_at', 'desc')->get();
        
        return view("user.posts", ['user' => $user,
                                   'posts' => $posts,
                                   'categories' => $categories]);
    }
    
    public function comments(User $user)
    {
        $comments = Comment::where('idUser', $user->id)->orderBy('created_at', 'desc')->get();
        return view("user.comments", ['user' => $user,
                                      'comments' => $comments]);
    }
}

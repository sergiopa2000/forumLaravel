<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use Carbon\Carbon;

class PostController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        try{
            $data = $request->all();
            $data['idUser'] = User::where('name', session('user')->name)->first()->id;
            
            $post = new Post($data);
            $post->save();
            return back();
        }catch(\Exception $e){
            return back()->withInput()->withErrors(['postCreateError' => 'An error ocurred creating the post']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRequest $request, Post $post)
    {
        try{
            $post->update($request->all());
            
            return back();
        }catch(\Exception $e){
            return back()->withInput()->withErrors(['postEditError' => 
            'An error ocurred editing the post']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try{
            $mytime = Carbon::now('+1:00');
            dd($mytime);
            $limitTime = Carbon::createFromDate($post->created_at)->addMinutes(5);
            
            if($limitTime > $mytime){
                $post->delete();
                return back();
            }else{
                return back()->withErrors(['postTimeError' => 'You can only delete a post up to 5 minutes after its creation']);
            }
        }catch(\Exception $e){
            return back()->withErrors(['postDeleteError' => 'An error ocurred while deleting this post']);
        }

    }
}

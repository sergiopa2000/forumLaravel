<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommentController extends Controller
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
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $data['idUser'] = User::where('name', session('user')->name)->first()->id;
            
            $comment = new Comment($data);
            $comment->save();
            return redirect('/');
        }catch(\Exception $e){
            return back()->withInput()->withErrors(['commentCreateError' => 'An error ocurred creating the comment']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        try{
            $comment->update($request->all());
            return back();
        }catch(\Exception $e){
            return back()->withInput()->withErrors(['commentEditError' => 
            'An error ocurred editing the comment']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try{
            $mytime = Carbon::now('+1:00');
            $limitTime = Carbon::createFromDate($comment->created_at)->addMinutes(5);
            if($limitTime > $mytime){
                $comment->delete();
                return back();
            }else{
                return back()->withErrors(['commentTimeError' => 'You can only delete a comment up to 5 minutes after its creation']);
            }
        }catch(\Exception $e){
            return back()->withErrors(['commentDeleteError' => 'An error ocurred while deleting this comment']);
        }

    }
}

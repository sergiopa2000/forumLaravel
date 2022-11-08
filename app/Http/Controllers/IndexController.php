<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();

        return view('index', ['posts' => $posts,
                              'categories' => $categories]);
    }   
    
    public function loginAction()
    {
        if (User::where('name', '=', trim($_POST['username']))->exists()) {
            $user = User::where('name', '=', trim($_POST['username']))->first();
            session(['user' => $user]);
    
            return redirect('/');
        }else{
            return back()->withInput()->withErrors(['incorrectUsername' => 
            'This username does not exist']);
        }
    }
}

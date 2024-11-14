<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }


    // this will register the user
    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login')->with('success', 'You have registered successfully');
}

// this will login the user
public function loginUser(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->route('index');
    } else {
        return redirect()->back()->with('error', 'Login failed. Please check your credentials.');
    }
}

public function index()
{
    $id= Auth::id();
    $posts = Post::with('user')->where('user_id', $id)->get();
    return view('crud.index',compact('posts'));
}

// this will show the create posts page
public function createPost()
{
    return view('crud.create');
}

// this will create the post
public function storePost(Request $request)
{
  $validator = Validator::make($request->all(), [
    'title' => 'required|min:3',
    'description' => 'required|min:10',
  ]);

  if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
  }

  $post = Post::create([
    'title' => $request->title,
    'description' => $request->description,
    'user_id' => Auth::id(),
  ]);

  return redirect()->route('index')->with('success', 'Post created successfully');
}

public function logout()
{
    Auth::logout();
    return redirect()->route('login');

}
}

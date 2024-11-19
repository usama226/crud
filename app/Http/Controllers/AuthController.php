<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
// use DataTables;

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

    public function index(Request $request)
    {
        $id = Auth::id();

        if ($request->ajax()) {
            $posts = Post::with('user')->where('user_id', $id)->select('id', 'title', 'description', 'user_id', 'created_at');

            return DataTables::of($posts)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->input('search.value')) {
                        $search = $request->input('search.value');
                        $query->where(function ($q) use ($search) {
                            $q->where('title', 'like', "%{$search}%")
                                ->orWhere('description', 'like', "%{$search}%")
                                ->orWhereHas('user', function ($q) use ($search) {
                                    $q->where('name', 'like', "%{$search}%");
                                });
                        });
                    }
                })
                ->addColumn('description', function ($post) {
                    return Str::words($post->description, 5);
                })

                ->addColumn('user', function ($post) {
                    return $post->user->name ?? 'N/A';
                })
                ->addColumn('created_at', function ($post) {
                    return \Carbon\Carbon::parse($post->created_at)->format('d M, Y');
                })
                ->addColumn('action', function ($post) {
                    return '<a class="btn btn-outline-primary" href="' . route('viewPost', $post->id) . '">View</a>
                        <a class="btn btn-primary" href="' . route('editPost', $post->id) . '">Update</a>
                        <form class="d-inline-block" action="' . route('deletePost', $post->id) . '" method="POST" onsubmit="return confirmDelete()">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>';
                })
                ->make(true);
        }

        return view('crud.index');
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

    // this will show the view page of post
    public function viewPost($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->with('user')->first();
        return view('crud.view', compact('post'));
    }

    // thi will show the page of edit post
    public function editPost($id)
    {
        $post = Post::findOrFail($id);
        return view('crud.edit', compact('post'));
    }

    // this will update the post
    public function updatePost(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('index')->with('success', 'Post updated successfully');
    }

    // this will delete the post
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('index')->with('success', 'Post deleted successfully');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

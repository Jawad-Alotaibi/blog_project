<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function showCreatePostForm()
    {
        return view('createPost');
    }

    public function storeNewPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'Required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

           
        $incomingFields['user_id'] = Auth::id();
        
       $newPost =  Post::create([
            'title' => $incomingFields['title'],
            'body' => $incomingFields['body'],
            'user_id' => $incomingFields['user_id']
            
        ]);

        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created');
            
        }


        public function viewSinglePost(Post $post)
        {
            $post->body = str::markdown($post->body);
            return view('single-post', ['post' => $post]);
        }
}

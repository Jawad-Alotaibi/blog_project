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
            $post['body'] = strip_tags(Str::markdown($post->body), '<p><h1><h2><h3><h4><h5><h6><ul><li><ol><em><br>');
            return view('single-post', ['post' => $post]);
        }

        public function delete(Post $post)
        {
            if (Auth::user()->can('delete', $post))
            {
                 $post->delete();
            return redirect('/profile/' . Auth::user()->username)->with('success', 'Post deleted successfully');
            }

            return 'You cannot do that';
        }
}

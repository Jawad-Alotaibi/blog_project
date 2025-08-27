<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showCreatePostForm()
    {
        return view('createPost');
    }

    public function storeNewPost()
    {
        return 'heeey!';
    }
}

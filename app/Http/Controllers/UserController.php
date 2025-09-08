<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
// public function testRelation()
// {
//     return auth()->user()->followers()->get();

// }

public function showCorrectHomePage()
    {
        if(Auth::check())
        {
            return view('homepage-feed', ['posts'=> auth()->user()->feedPosts()->latest()->get()]);
        } else
        {
            return view('homepage');
        }
    }


    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username'=> ['required', 'min:3', 'max:20', Rule::unique('users','username')],
            'email'=> ['required', 'email', Rule::unique('users', 'email')],
            'password'=> ['required', 'min:8', 'confirmed']
        ]);
        $user = User::create([
            'username' => $incomingFields['username'],
            'email' => $incomingFields['email'],
            'password' => $incomingFields['password']
        ]);
        //logged them before redirect them to the auth home page
        Auth::login($user);
        return redirect('/')->with('success','Thank you for creating an account');
    }

    public function getRegisterPage()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if(Auth::attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) { //if the credintials are true        {
            $request->session()->regenerate(); // give the user session value, to tell the browser to store it in a cookie and then that way the browser will send this information with each request
            return redirect('/')->with('success', 'You have successfully logged in');
        } else{
            return redirect('/login')->with('failure', 'Invalid login');

        }
    }
     public function getLoginPage()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'You are now logged out');
    }

    private function getSharedData($user)
    {
         $currentlyFollowing = 0;

        if(auth()->check())
        {
            $currentlyFollowing =
             Follow::where([['user_id' , '=', auth()->user()->id],
            ['followeduser', '=', $user->id]])
            ->count();

        }

        View::Share('sharedData',['username' => $user->username, 'totalPosts' => $user->posts()->count(), 'postAuthorAvatar' => $user->avatar, 'currentlyFollowing' => $currentlyFollowing, 'followerCount' => $user->followers()->count(), 'followingCount' => $user->following()->count()]);
    }
    public function profilePosts(User $user)
    {
        $this->getSharedData($user);
        $posts = $user->posts()->latest()->get();
        return view('profile-posts', ['posts' => $posts]);
    }

    public function profileFollowers(User $user)
    {
        $this->getSharedData($user);
        $followers = $user->followers()->latest()->get();
        return view('profile-followers', ['followers' => $followers]);

    }

    public function profileFollowing(User $user)
    {

        $this->getSharedData($user);
        $following = $user->following()->latest()->get();
        return view('profile-following', ['following' => $following]);
    }

    public function showManageAvatarPage()
    {
        return view('manage-avatar');
    }

    public function uploadAvatar(Request $request)
    {
         $request->validate([
            'avatar' => 'required|image|max:3000'
        ]);

        $user = auth()->user();//get the currently authenticated user
        $fileName = $user->id . "-" . uniqid() . ".jpg"; // Create a file name starting with User_id-uniqueId.jpg

        //The Logic of image manipualtion
        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('avatar'));
        $imgData = $image->cover(120, 120)->toJpeg();

        //The file name may be '1iwjfviefiqbvin' starting with the id of the user then random unique key
        Storage::disk('public')->put("avatars/{$fileName}",$imgData);

        //override the old photo
        $oldAvatar = $user->avatar; //keep track of the old photo
        $user->avatar = $fileName;
        $user->save();

        if($oldAvatar != "/fallback-avatar.jpg")
        {
            Storage::disk('public')->delete(str_replace("/storage/","",$oldAvatar)); // /avatars/1-68b84969d75d4.jpg
        }
         return redirect('/profile/' . $user->username)->with('success', 'Congrats on The New Avatar');
    }


}

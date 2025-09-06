<x-layout>

    <div class="container py-md-5 container--narrow">
        <h2>
            <img class="avatar-small" src="{{$postAuthorAvatar}}" />
            {{$username}}

            @auth
            @if(!$currentlyFollowing AND auth()->user()->username != $username)
            <form class="ml-2 d-inline" action="/create-follow/{{$username}}" method="POST">
                @csrf
                <button class="btn btn-custom-blue btn-sm">Follow <i class="fas fa-user-plus"></i></button>
            </form>
            @endif

            @if($currentlyFollowing)
            <form class="ml-2 d-inline" action="/remove-follow/{{$username}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Unfollow <i class="fas fa-user-times"></i></button>
            </form>
            @endif
            @if(auth()->user()->username == $username)
            <a style="color: black" class="btn btn-sm" href="/profile/{{$username}}/manage-avatar">Manage Avatar <i
                    class="fas fa-user-cog"></i></a>
            @endif
            @endauth
        </h2>

        <div class="profile-nav nav nav-tabs pt-2 mb-4">
            <a href="/profile/{{$username}}" class="profile-nav-link nav-item nav-link active">Posts: {{$totalPosts}}</a>
            <a href="/profile/{{$username}}/followers" class="profile-nav-link nav-item nav-link">Followers: 3</a>
            <a href="/profile/{{$username}}/following" class="profile-nav-link nav-item nav-link">Following: 2</a>
        </div>

        <div class="class=" profile-slot-content">
            {{$slot}}
        </div>
    </div>

</x-layout>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Postify</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="main.css" /> -->
    @vite(['resources/css/main.css', 'resources/js/app.js'])
  </head>
  <body>
    <header class="header-bar mb-3">

      @auth
      <div class="container d-flex flex-column flex-md-row align-items-center p-3">
      <h4 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">Postify</a></h4>
      <div class="flex-row my-3 my-md-0">
          <a href="#" class="text-white mr-2 header-search-icon" title="Search" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-search"></i></a>
          <span class="text-white mr-2 header-chat-icon" title="Chat" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-comment"></i></span>
          <a href="/profile/{{Auth::user()->username}}" class="mr-2"><img title="My Profile" data-toggle="tooltip" data-placement="bottom" style="width: 32px; height: 32px; border-radius: 16px" src="{{auth()->user()->avatar}}" /></a>
          <a class="btn btn-sm mr-2 btn-custom-bg text-white" href="/create-post">Create Post</a>
          <form action="/logout" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-custom-bg text-white">Sign Out</button>
          </form>
        </div>


      @else
       <div class="container d-flex flex-column flex-md-row align-items-center p-3">
                <h4 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">Postify</a></h4>
                <div class="d-flex">
                  <a href="login" class="mr-2">
                    <button class="btn btn-primary btn-sm btn-custom-blue">Login</button>
                  </a>
                  <a href="/register">
                    <button class="btn btn-primary btn-sm btn-custom-blue">Register</button>
                  </a>
                </div>
      </div>
      @endauth
    </header>
    <!-- header ends here -->

        @if(session()->has('failure'))
            <div class="container container--narrow">
              <div class="alert alert-danger text-center" id="flash-failure">
                {{session('failure')}}
              </div>
            </div>
        @endif

         @if(session()->has('success'))
            <div class="container container--narrow">
              <div class="alert alert-success text-center" id="flash-success">
                {{session('success')}}
              </div>
            </div>
        @endif


        {{ $slot }}


    <!-- footer begins -->
    <footer class="border-top text-center small text-muted py-3 bg-white mt-auto w-100">
      <p class="m-0">&copy; {{ date('Y') }} <a href="/" class="text-muted">Postify</a>. All rights reserved for Jawad Alotaibi.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
      $('[data-toggle="tooltip"]').tooltip()
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find and hide the success message after 5 seconds
        const successMessage = document.getElementById('flash-success');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 5000); // Hide after 5 seconds
        }

        // Find and hide the failure message after 5 seconds
        const failureMessage = document.getElementById('flash-failure');
        if (failureMessage) {
            setTimeout(function() {
                failureMessage.style.display = 'none';
            }, 5000); // Hide after 5 seconds
        }
    });
</script>

  </body>
</html>

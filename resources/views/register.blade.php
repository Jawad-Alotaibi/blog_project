<!DOCTYPE html>
<x-layout>
    

<div class="d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-lg-5 pb-3 py-lg-5">
    <form action="/register" method="POST" id="registration-form">
      @csrf
      <div class="form-group">
        <label for="username-register" class="text-dark mb-1"><small>Username</small></label>
        <input value="{{old('username')}}" name="username" id="username-register" class="form-control text-dark" type="text" placeholder="Pick a username" autocomplete="off" />
        @error('username')
        <p class="m-0 small alert alert-danger shadow-sm">
            {{$message}}
        </p>
        @enderror
      </div>

      <div class="form-group">
        <label for="email-register" class="text-dark mb-1"><small>Email</small></label>
        <input value="{{old('email')}}" name="email" id="email-register" class="form-control text-dark" type="email" placeholder="you@example.com" autocomplete="off" />
        @error('email')
        <p class="m-0 small alert alert-danger shadow-sm">
            {{$message}}
        </p>
        @enderror
      </div>

      <div class="form-group">
        <label for="password-register" class="text-dark mb-1"><small>Password</small></label>
        <input name="password" id="password-register" class="form-control text-dark" type="password" placeholder="Create a password" />
        @error('password')
        <p class="m-0 small alert alert-danger shadow-sm">
            {{$message}}
        </p>
        @enderror
      </div>

      <div class="form-group">
        <label for="password-register-confirm" class="text-dark mb-1"><small>Confirm Password</small></label>
        <input name="password_confirmation" id="password-register-confirm" class="form-control text-dark" type="password" placeholder="Confirm password" />
        @error('password_confirmation')
        <p class="m-0 small alert alert-danger shadow-sm">
            {{$message}}
        </p>
        @enderror
      </div>

      <button type="submit" class="py-3 mt-4 btn btn-lg btn-custom-blue btn-block">Sign up for Postify</button>
    </form>
  </div>
</div>
</x-layout>

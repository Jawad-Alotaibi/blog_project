<x-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- in <head> -->
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css" />

</head>
<body>
    <section class="h-screen">
  <div class="container h-full px-6 py-24">
    <div
      class="flex h-full flex-wrap items-center justify-center lg:justify-between">
      <!-- Left column container with background-->
      <div class="mb-12 md:mb-0 md:w-8/12 lg:w-6/12">
        <img
          src="https://tecdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="w-full"
          alt="Phone image" />
      </div>
      {{-- The password for my account is Jawad511 --}}
      <!-- Right column container with form -->
      <div class="md:w-8/12 lg:ms-6 lg:w-5/12">
        <form action="/login" method="POST" id="login-form">
          @csrf
          <!-- username input -->
          <div class="mb-6">
            <label for="exampleFormControlInput3" class="block text-gray-700 mb-2">Username </label>
            <input
            name="loginusername"
              type="text"
              class="block w-full rounded border border-gray-300 px-3 py-2 leading-[2.15] outline-none transition-all duration-200 ease-linear text-black dark:border-neutral-600"
              id="exampleFormControlInput3"
              placeholder="Enter your Username.." />
            @error('loginusername')
              <p class="m-0 small alert alert-danger shadow-sm">
                  {{$message}}
              </p>
           @enderror
          </div>

          <!-- Password input -->
          <div class="mb-6">
            <label for="exampleFormControlInput33" class="block text-gray-700 mb-2">Password</label>
            <input
              value="{{old('username')}}"
              name="loginpassword"
              type="password"
              class="block w-full rounded border border-gray-300 px-3 py-2 leading-[2.15] outline-none transition-all duration-200 ease-linear text-black dark:border-neutral-600"
              id="exampleFormControlInput33"
              placeholder="Enter your Password.." />
            @error('loginpassword')
              <p class="m-0 small alert alert-danger shadow-sm">
                  {{$message}}
              </p>
            @enderror
          </div>

          <!-- Remember me checkbox -->
          <div class="mb-6 flex items-center justify-between">
            <div class="mb-[0.125rem] block min-h-[1.5rem] ps-[1.5rem]">
              <input
                class="relative float-left -ms-[1.5rem] me-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-secondary-500 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-checkbox before:shadow-transparent before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ms-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-black/60 focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-black/60 focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-checkbox checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ms-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent rtl:float-right dark:border-neutral-400 dark:checked:border-primary dark:checked:bg-primary"
                type="checkbox"
                value=""
                id="exampleCheck3"
                checked />
              <label
                class="inline-block ps-[0.15rem] hover:cursor-pointer"
                for="exampleCheck3">
                Remember me
              </label>
            </div>

            <!-- Forgot password link -->
            <a
              href="#!"
              class="text-primary focus:outline-none dark:text-primary-400"
              >Forgot password?</a
            >
          </div>

          <!-- Submit button -->
          <button
            type="submit"
            class="btn-custom-blue inline-block w-full rounded bg-primary px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
            data-twe-ripple-init
            data-twe-ripple-color="light">
            Login
          </button>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- before </body> -->
<script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
</body>
</x-layout>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <link href="{{ asset('css/all.css') }}">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <script src="{{ asset('js/all.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .opacitytext {
                opacity: 9 !important;
            }

            body {
                background-color: #ffffff;

                background-image: url('{{ asset('icons/Office_bluebackground.jpeg') }}');
                background-repeat: no-repeat;
                background-size: 100% 60%;


                /* Adjust the width as needed */
                font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
                font-weight: 500;


                /* Set the body height to the full viewport height */
            }

            main {}


            .card {
                box-shadow: 1px 20px 30px 5px rgba(0, 0, 0, 0.6) !important;
            }

            /* overflow: hidden; */
            /* z-index: -1; */
            /* position: absolute; */
            /* align-items: center;
                justify-content: center; */
            /* margin: -100px -300px; */
            .dostbrand {
                position: ;

                font-weight: bold;
                font-size: 1.5rem;
                /* margin: 0.5rem; */
            }

            /*  @keyframes float {
                0% {
                    shadow: 0 5px 15px 0px rgba(0, 0, 0, 0.6);

                }

                50% {
                    shadow: 0 25px 15px 0px rgba(0, 0, 0, 0.2);
                    transform: translatey(-20px);

                }

                100% {
                    shadow: 0 5px 15px 0px rgba(0, 0, 0, 0.6);
                    transform: translatey(0px);
                }
            } */
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <main class="d-flex w-100 h-100">
            {{--
            <span style="" class="dostbrand">DOST REGION XI
                <br>SCHOLAR MONITORING SYSTEM</span> --}}

            <div s class="container d-flex flex-column">


                <div class="row vh-100">
                    <div class="col-sm-5 col-md-12 col-lg-5 col-xl-5 mx-auto d-table ">
                        <div class="d-table-cell align-middle">


                            <div class="card">

                                <div class="container">


                                    <div style="margin: auto" class="row justify-content-center mt-5">

                                        <img class="logo lead" src="{{ asset('icons/DOST_MAIN.png') }}" alt="" width="20" height="80">

                                    </div>
                                    {{-- <div class="row justify-content-center text-center mt-1 ">
                                        <div>Welcome!</div>
                                    </div> --}}
                                </div>

                                {{-- <span class=" " style="padding-top: 0.5in; font-weight: bold; font-size: 20px">
                                    <div class="row">
                                        <div class=" col-md-12 offset-md-3 ">

                                        </div>



                                    </div>
                                </span> --}}
                                <div class="card-body">

                                    <div class="m-sm-3">


                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-2 opacitytext" style="font-size: 20px">Log in</div>
                                            <div class="mb-3">

                                                <input id="email" class="opacitytext form-control form-control-lg @error('email') is-invalid @enderror" name="email" type="email" value="{{ old('email') }}" placeholder="Enter your email" required autocomplete="email" autofocus />

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            {{--
                                        <div  class="input-group-btn">
                                            <input id="password" class="opacitytext form-control form-control-lg"
                                            type="password" name="password" placeholder="Enter your password" />
                                            <span class="input-group-btn">
                                                <button class="btn btn-default reveal" type="button"><i class="far fa-eye"></i></button>
                                              </span>
                                        </div> --}}

                                            <div class="mb-3">
                                                <div class="input-group">
                                                    <input id="password" type="password" class="form-control form-control-lg" placeholder="Enter your password" name="password" aria-label="Username" aria-describedby="addon-wrapping">
                                                    <span class="input-group-text" id="addon-wrapping" style="cursor: pointer" onclick="togglePassword()">
                                                        <i id="eye-icon" class="far fa-eye"></i>
                                                    </span>
                                                </div>
                                                {{-- @if (Route::has('password.request'))
                                                <small>
                                                    <a href="{{ route('password.request') }}">Forgot password?</a>
                                                </small>
                                            @endif --}}
                                            </div>



                                            <div>
                                                <div class="form-check align-items-center">
                                                    <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
                                                    <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="d-grid gap-2 mt-3">
                                                <button type="submit" class='btn btn-lg btn-primary' href='/'>Sign
                                                    in</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @if (Route::has('register'))
                                <div style="display:none;" class="text-center mb-3">
                                    Don't have an account? <a href='{{ route('register') }}'>Sign up</a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </main>




        <script>
            function togglePassword() {
                var passwordField = $('#password');
                var eyeIcon = $('#eye-icon');

                // Toggle password field visibility
                var passwordFieldType = passwordField.attr('type');
                passwordField.attr('type', passwordFieldType === 'password' ? 'text' : 'password');

                // Toggle eye icon
                eyeIcon.toggleClass('fa-eye fa-eye-slash');
            }
        </script>
    </body>

</html>






{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

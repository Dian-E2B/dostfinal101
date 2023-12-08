<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        {{-- <link rel="stylesheet" href="{{ asset('css/kitlight.css') }}"> --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/all.css') }}">
        <script src="{{ asset('js/all.js') }}"></script>
        <style>
            .introheader {
                color: aliceblue;
            }

            img {
                overflow: hidden;
                shadow: 0 5px 15px 0px rgba(0, 0, 0, 0.6);
                transform: translatey(0px);
                animation: float 6s ease-in-out infinite;
                z-index: -1;
                position: absolute;
                align-items: center;
                justify-content: center;
                margin: -250px -350px;

            }

            @keyframes float {
                0% {
                    shadow: 0 5px 15px 0px rgba(0, 0, 0, 0.6);

                }

                50% {
                    shadow: 0 25px 15px 0px rgba(0, 0, 0, 0.2);
                    transform: translatey(40px);

                }

                100% {
                    shadow: 0 5px 15px 0px rgba(0, 0, 0, 0.6);
                    transform: translatey(0px);
                }
            }
        </style>
    </head>

    <body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <main class="d-flex w-100 h-100">
            <div class="container d-flex flex-column">
                <div class="row vh-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">

                        <div class="d-table-cell align-middle">

                            <div style=" " class="introheader text-center mt-4">
                                <img src="{{ asset('icons/DOSTLOGOstudent.png') }}" width="700" height="700">

                            </div>

                            <div class="card" style="margin-top: 40px">
                                <div class="card-body">
                                    <div class="m-sm-100">

                                        <section style="color:black; background-color: white; padding: 0px 0px; border-radius: 15px; opacity: 0.99; text-align: center !important;">
                                            <h1 style="" class="h2">Welcome, Scholar!
                                            </h1>
                                            <p class="lead">
                                                Please enter your credentials.
                                            </p>
                                        </section>
                                        <form method="POST" action="{{ route('student.login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" type="email" value="{{ old('email') }}" placeholder="Enter your email" required autocomplete="email" autofocus />
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-1 mt-3">
                                                <div class="input-group">
                                                    <input id="password" type="password" class="form-control form-control-lg" placeholder="Enter your password" name="password" aria-label="Username" aria-describedby="addon-wrapping">
                                                    <span class="input-group-text" id="addon-wrapping" style="cursor: pointer" onclick="togglePassword()">
                                                        <i id="eye-icon" class="far fa-eye"></i>
                                                    </span>
                                                </div>
                                                {{-- <label class="form-label">Password</label>
                                                <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" /> --}}

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
                                <div style="display: none;" class="text-center mb-3">
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

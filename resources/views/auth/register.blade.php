<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('adminLTE/img/logo.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('adminLTE/img/logo.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('ColorLib/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('ColorLib/css/style.css') }}">
</head>

<body>

    <div class="container">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign Up</h2>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Your name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Your Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation"><i class="zmdi zmdi-lock-outline"
                                        value="__('Confirm Password')"></i></label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Repeat your password" required>
                            </div>
                            <div class="form-group form-button">
                                {{-- <button type="submit" class="btn btn-block btn-primary btn-lg">Register</button> --}}
                                <input type="submit" name="signup" id="signup" class="form-submit"
                                    value="Register" />
                            </div>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset('ColorLib/images/signup-image.jpg') }}" alt="sing up image"></figure>
                        <a href="{{ url('login') }}" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
        </form>
    </div>

    <!-- JS -->
    <script src="{{ asset('ColorLib/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('ColorLib/js/main.js') }}"></script>
</body>

</html>

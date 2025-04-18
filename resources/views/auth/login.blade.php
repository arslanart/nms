<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>INMS.LoginPage</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!--Favicon-->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">

    <!-- THEME CSS
 ================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="asset/frontend/plugins/bootstrap/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="asset/frontend/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="asset/frontend/plugins/slick-carousel/slick.css">
    <link rel="stylesheet" href="asset/frontend/plugins/slick-carousel/slick-theme.css">
    <!-- manin stylesheet -->
    <link rel="stylesheet" href="asset/frontend/css/style.css">
</head>

<body>


    <section class="login-signup section-padding">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="login">
                        <img src="{{ asset('asset/frontend/images/egatlogo.png') }}" alt="" class="img-fluid mx-auto d-block">



                        <h3 class="mt-4">Welcome</h3>
                        <p class="mb-5">Internal IP Party Line Network Management System</p>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ session('error') }}</li>
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="login-form row">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="loginusername">Username</label>
                                    <input type="text" id="username" class="form-control" name="username"
                                        placeholder="Enter your email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="loginPassword">Password</label>
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Enter your password" required>
                                </div>
                            </div>

                            <div class="block mt-4 mb-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-checkbox id="remember_me" name="remember" />
                                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="col-md-12.5">
                                <button class="btn btn-primary mb-4" type="submit">Login</button>

                            </div>




                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- THEME JAVASCRIPT FILES
================================================== -->
    <!-- initialize jQuery Library -->
    <script src="asset/frontend/plugins/jquery/jquery.js"></script>
    <!-- Bootstrap jQuery -->
    <script src="asset/frontend/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Slick Slider -->
    <script src="asset/frontend/plugins/slick-carousel/slick.min.js"></script>
    <!-- main js -->
    <script src="asset/frontend/js/custom.js"></script>

</body>

</html>

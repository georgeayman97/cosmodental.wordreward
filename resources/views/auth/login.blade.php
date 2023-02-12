<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Template</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/login/css/login.css') }}">
</head>
<body>
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="{{ asset('assets/login/images/login.jpg') }}" alt="login" class="login-card-img">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="brand-wrapper">
                            <img src="{{ asset('assets/login/images/logo.png') }}" alt="logo" class="logo"
                                 style="height: 110px;">
                        </div>
                        <p class="login-card-description">Sign into your account</p>
                        <x-auth-session-status class="mb-4" :status="session('status')"/>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="phone" class="sr-only">Phone</label>
                                <input type="tel" name="phone" id="phone" :value="old('phone')" class="form-control"
                                       placeholder="Phone Number" required>
                                <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="***********" required autocomplete="current-password">
                            </div>
                            <button class="btn btn-block login-btn mb-4" type="submit">{{ __('Login') }}</button>
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </form>
                        <nav class="login-card-footer-nav">
                            <a href="{{ route('policy') }}">Privacy policy</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
</body>
</html>

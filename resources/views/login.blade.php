<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fd;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .heading {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            color: #1089D3;
        }

        .form {
            margin-top: 20px;
        }

        .input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .input:focus {
            outline: none;
            border-color: #12B1D1;
        }

        .forgot-password {
            display: block;
            margin-top: 10px;
            text-align: right;
            font-size: 12px;
        }

        .forgot-password a {
            color: #0099ff;
            text-decoration: none;
        }

        .login-button {
            display: block;
            width: 100%;
            font-weight: bold;
            background: linear-gradient(45deg, #1089D3 0%, #12B1D1 100%);
            color: #fff;
            padding: 15px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .login-button:hover {
            background: linear-gradient(45deg, #12B1D1 0%, #1089D3 100%);
        }

        .social-account-container {
            margin-top: 25px;
        }

        .title {
            display: block;
            text-align: center;
            font-size: 14px;
            color: #aaa;
        }

        .social-accounts {
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .social-button {
            background: linear-gradient(45deg, #000 0%, #707070 100%);
            border: 2px solid #fff;
            padding: 8px;
            border-radius: 50%;
            width: 40px;
            aspect-ratio: 1;
            display: grid;
            place-content: center;
            box-shadow: rgba(133, 189, 215, 0.878) 0px 8px 6px -5px;
            transition: all 0.2s ease-in-out;
        }

        .social-button:hover {
            transform: scale(1.2);
        }

        .agreement {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
        }

        .agreement a {
            text-decoration: none;
            color: #0099ff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="heading">Sign In</div>
    <form action="{{ route('login.auth') }}" class="form" method="POST">
        @csrf
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        @if (Session::get('logout'))
            <div class="alert alert-primary">{{ Session::get('logout') }}</div>
        @endif
        @if (Session::get('canAccess'))
            <div class="alert alert-danger">{{ Session::get('canAccess') }}</div>
        @endif
        <input class="input" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <input class="input" type="password" name="password" id="password" placeholder="Password" value="{{ old('password') }}">
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <span class="forgot-password"><a href="#">Forgot Password?</a></span>
        <input class="login-button" type="submit" value="Sign In">
    </form>
</div>

<!-- Bootstrap JS and Popper.js (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

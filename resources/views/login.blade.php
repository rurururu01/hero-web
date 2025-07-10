<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HERO</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #FFA500;
            font-family: Arial, sans-serif;
        }        .container {
            width: 100%;
            max-width: 500px;
            padding: 40px;
            text-align: center;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }        .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f8f9fa;
            box-sizing: border-box;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #800080;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(128, 0, 128, 0.1);
        }

        input::placeholder {
            color: #999;
        }        .login-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background-color: #800080;
            color: white;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background-color: #6a0066;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(128, 0, 128, 0.3);
        }

        .register-link {
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .register-link a {
            color: #800080;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .home-link {
            margin-top: 15px;
        }

        .home-link a {
            color: #800080;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }        .home-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            background-color: #fee;
            color: #d32f2f;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #ffcdd2;
            font-size: 14px;
        }

        .success-message {
            background-color: #e8f5e8;
            color: #2e7d32;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c8e6c9;
            font-size: 14px;
        }
    </style>
</head>
<body>    <div class="container">
        <img src="{{ asset('images/logo.png') }}" alt="HERO Logo" class="logo">
        
        @if($errors->any())
            <div class="error-message">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <input type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="login-btn">Log In</button>
        </form>
        <div class="register-link">
            Belum memiliki akun? <a href="/register">Register</a>
        </div>        <div class="home-link">
            <a href="{{ route('home') }}">Kembali ke Homepage</a>
        </div>
    </div>
</body>
</html>
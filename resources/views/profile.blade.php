<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 15px;
            cursor: pointer;
        }

        .success {
            padding: 10px;
            margin-bottom: 15px;
            background: #d4edda;
        }

        .error {
            padding: 10px;
            margin-bottom: 15px;
            background: #f8d7da;
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Profile</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <h2>Informasi User</h2>

        <p>
            <strong>Nama:</strong>
            {{ auth()->user()->name }}
        </p>

        <p>
            <strong>Email:</strong>
            {{ auth()->user()->email }}
        </p>

        <p>
            <strong>Role:</strong>
            {{ auth()->user()->role }}
        </p>
    </div>

    <div class="card">
        <h2>Change Password</h2>

        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password">
                    Password Saat Ini
                </label>

                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    required
                >
            </div>

            <div>
                <label for="password">
                    Password Baru
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >
            </div>

            <div>
                <label for="password_confirmation">
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                >
            </div>

            <button type="submit">
                Ubah Password
            </button>
        </form>
    </div>

</div>

</body>
</html>
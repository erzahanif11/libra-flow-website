<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
    <div class="profile-container">
        <h1>Profile</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p>Welcome, {{ $user->username }} ({{ $user->email }})</p>

        <form method="POST" action="/profile">
            @csrf
            <input type="hidden" name="action" value="update_username">
            <h3>Update Username</h3>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" required><br>
            <button type="submit">Update Username</button>
        </form>

        <form method="POST" action="/profile">
            @csrf
            <input type="hidden" name="action" value="update_email">
            <h3>Update Email</h3>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required><br>
            <button type="submit">Update Email</button>
        </form>

        <form method="POST" action="/profile">
            @csrf
            <input type="hidden" name="action" value="update_password">
            <h3>Update Password</h3>
            <label for="password_old">Old Password</label><br>
            <input type="password" id="password_old" name="password_old" required><br>
            <label for="password_new">New Password</label><br>
            <input type="password" id="password_new" name="password_new" required><br>
            <label for="password_confirmation">Confirm New Password</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" required><br>
            <button type="submit">Update Password</button>
        </form>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>

        <form method="POST" action="/delete">
            @csrf
            <button type="submit">Delete Account</button>
        </form>
    </div>
</body>
</html>

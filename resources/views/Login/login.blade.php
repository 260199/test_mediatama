<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="body-login">
  <div class="login-container">
    <h1 class="login-title">Login</h1>
    
    <!-- Pesan sukses -->
    @if(session('success'))
      <div class="alert alert-success" style="color: green; margin-bottom: 15px;">
        {{ session('success') }}
      </div>
    @endif
    
    <!-- Pesan error -->
    @if($errors->any())
      <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
        <ul style="list-style: none; padding: 0;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form class="login-form" action="login/proses" method="POST">
        @csrf
      <div class="form-group">
        <label for="name">Username</label>
        <input type="text" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="btn-login">Login</button>
      <a href="/"> Back To Home!!!</a>
    </form>
  </div>
</body>
</html>

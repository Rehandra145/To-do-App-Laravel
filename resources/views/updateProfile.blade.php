<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profile</title>
  <style>
    body {
      background-color: #121212;
      color: #e0e0e0;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .navbar {
      background-color: #121212;
      width: 100%;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar h2 {
      color: #bb86fc;
      margin: 0;
    }

    .menu-icon {
      cursor: pointer;
      display: none;
      flex-direction: column;
    }

    .menu-icon div {
      width: 25px;
      height: 3px;
      background-color: #e0e0e0;
      margin: 4px;
    }

    .menu {
      display: flex;
      list-style: none;
      gap: 20px;
      align-items: center;
    }

    .menu li a {
      color: #e0e0e0;
      text-decoration: none;
      font-weight: bold;
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
      font-size: 1em;
    }

    .menu-responsive {
      display: none;
      flex-direction: column;
      position: absolute;
      top: 50px;
      right: 20px;
      background-color: #1f1f1f;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      padding: 10px;
    }

    .menu-responsive li {
      margin: 10px 0;
    }

    @media (max-width: 768px) {
      .menu {
        display: none;
      }

      .menu-icon {
        display: flex;
      }
    }

    h1 {
      color: #bb86fc;
      text-align: center;
    }

    form {
      background-color: #1f1f1f;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      width: 300px;
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    input[type="text"], input[type="date"], input[type="file"] {
      padding: 8px;
      border: none;
      border-radius: 4px;
      background-color: #333;
      color: #e0e0e0;
    }

    button {
      background-color: #bb86fc;
      color: #121212;
      border: none;
      padding: 10px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1em;
    }

    button:hover {
      background-color: #9f6dfd;
    }

    .error-message {
      color: #ff6b6b;
      font-size: 0.9em;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <div class="navbar">
    <h2>Profile</h2>
    <div class="menu-icon" onclick="toggleMenu()">
      <div></div>
      <div></div>
      <div></div>
    </div>
    <ul class="menu">
      @if (Auth::check())
        <li>
          <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
            @csrf
          </form>
          <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
        </li>
        <li><a href="{{ route('Show') }}">History</a></li>
      @else
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
      @endif
    </ul>
    <ul id="menu-responsive" class="menu-responsive">
      @if (Auth::check())
        <li>
          <form id="logout-form-responsive" action="{{ route('logout') }}" method="post" style="display: none;">
            @csrf
          </form>
          <a href="#" onclick="document.getElementById('logout-form-responsive').submit();">Logout</a>
        </li>
      @else
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
      @endif
    </ul>
  </div>

  <!-- Profile Form -->
  <h1>Update Your Profile</h1>
  <form action="{{ route('StoreProfile') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="username" placeholder="Siapa namamu?" required>
    <input type="text" name="bio" placeholder="Tulis sesuatu di sini">
    <input type="date" name="dateBirth" required>
    
    <label for="Gender">
      <input type="radio" name="Gender" value="M" required> Male
    </label>
    <label for="Gender">
      <input type="radio" name="Gender" value="F" required> Female
    </label>
    
    <input type="file" name="image">
    
    <button type="submit">Finish</button>
  </form>

  <!-- Display Errors -->
  @foreach ($errors->all() as $error)
    <p class="error-message">{{ $error }}</p>
  @endforeach

  <script>
    function toggleMenu() {
      const menu = document.getElementById('menu-responsive');
      menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    }
  </script>
</body>
</html>

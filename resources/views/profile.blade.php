<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>View Profile</title>
  <style>
    /* Basic Styling */
    body {
      background-color: #121212;
      color: #e0e0e0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Navbar Styling */
    .navbar {
      background-color: #121212;
      width: 100%;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
      border-bottom: 1px solid #333;
    }

    .navbar h2 {
      color: #bb86fc;
      margin: 0;
      font-weight: bold;
      font-size: 1.5em;
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
      transition: background-color 0.3s;
    }

    .menu {
      display: flex;
      list-style: none;
      gap: 20px;
      align-items: center;
      transition: all 0.3s ease-in-out;
    }

    .menu li a {
      color: #e0e0e0;
      text-decoration: none;
      font-weight: bold;
      padding: 10px 15px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .menu li a:hover {
      background-color: #333;
      color: #bb86fc;
    }

    .menu-responsive {
      display: none;
      flex-direction: column;
      position: absolute;
      top: 60px;
      right: 20px;
      background-color: #1f1f1f;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      padding: 10px;
      transition: all 0.3s ease-in-out;
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

    /* Profile Container Styling */
    .profile-container {
      background-color: #1f1f1f;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
      width: 350px;
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      transition: transform 0.3s;
    }

    .profile-container:hover {
      transform: scale(1.02);
    }

    .profile-image {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      overflow: hidden;
      margin-bottom: 15px;
      border: 4px solid #bb86fc;
    }

    .profile-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .profile-info {
      margin-bottom: 15px;
    }

    .profile-info h3 {
      color: #bb86fc;
      margin: 0;
      font-size: 1.8em;
    }

    .profile-info p {
      margin: 5px 0;
      font-size: 0.9em;
    }

    .btn-edit {
      background-color: #bb86fc;
      color: #121212;
      border: none;
      padding: 12px 20px;
      border-radius: 25px;
      cursor: pointer;
      font-size: 1em;
      text-decoration: none;
      transition: background-color 0.3s, transform 0.3s;
    }

    .btn-edit:hover {
      background-color: #9f6dfd;
      transform: translateY(-3px);
    }

    .btn-edit:active {
      transform: translateY(1px);
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

  <!-- Profile Display -->
  <div class="profile-container">
    <!-- Profile Image -->
    <div class="profile-image">
      <img src="{{ asset('storage/' . $profile->image) }}" alt="Profile Picture">
    </div>

    <!-- Profile Information -->
    <div class="profile-info">
      <h3>{{ $profile->username }}</h3>
      <p><strong>Bio:</strong> {{ $profile->bio }}</p>
      <p><strong>Date of Birth:</strong> {{ $profile->dateBirth }}</p>
      <p><strong>Gender:</strong> {{ $profile->Gender == 'M' ? 'Male' : 'Female' }}</p>
    </div>

    <!-- Edit Button -->
    <a href="" class="btn-edit">Edit Profile</a>
  </div>
  <script>
    function toggleMenu() {
      const menu = document.getElementById('menu-responsive');
      menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    }
  </script>
</body>
</html>

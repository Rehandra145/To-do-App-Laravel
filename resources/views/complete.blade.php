<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Complete Task</title>
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

    .menu li a, .menu li button {
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

    .task-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .task-header h1 {
      color: #bb86fc;
      font-size: 2.5em;
      margin-bottom: 0;
    }

    .task-header p {
      color: #888;
      font-size: 1.1em;
      margin-top: 5px;
    }

    .task-container {
      text-align: left;
      width: 100%;
      max-width: 600px;
      margin: 20px 0;
    }

    .task-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #333;
      padding: 10px 0;
    }

    .task-name {
      font-size: 1.2em;
      font-weight: bold;
      margin: 0;
    }

    .task-date {
      font-size: 0.9em;
      color: #888;
      margin: 0;
    }

    .task-info {
      flex-grow: 1;
    }

    .delete-button-fr, .complete-button-fr {
      background-color: #121212;
      padding: 0;
      border-radius: 8px;
      width: 100px;
      margin-top: 20px;
    }

    .complete-button {
      background-color: #1eff00f4;
      color: #fff;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
    }

    .complete-button:hover {
      background-color: #73ff23;
    }

    .delete-button {
      background-color: #e63946;
      color: #fff;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
    }

    .delete-button:hover {
      background-color: #d62839;
    }

    .no-tasks {
      text-align: center;
      color: #888;
      font-style: italic;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <div class="navbar">
    <h2>Complete Task</h2>
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
      @endif
    </ul>
  </div>

  <div class="task-header">
    @if (Auth::check())
      <h1>Hello, {{ $user->name }}!</h1>
    @else
      <h1>Hello There!</h1>
    @endif
    <p>Manage your tasks efficiently and stay productive.</p>
  </div>

  <div class="task-container">
    @if ($tasks->isEmpty())
      <p class="no-tasks">No tasks completed yet!</p>
    @else
    <h2>Your Completed Tasks</h2>
      @foreach ($tasks as $task)
        <div class="task-item">
          <div class="task-info">
            <p class="task-name">{{ $task->name }}</p>
            <p class="task-date">Added at: {{ $task->created_at }}</p>
            <p class="task-date">Completed at: {{ $task->updated_at }}</p>
          </div>
        </div>
      @endforeach
    @endif
  </div>

  <form action="{{route('Clear')}}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="delete-button">Delete All Tasks</button>
  </form>

  <script>
    function toggleMenu() { 
      const menu = document.getElementById('menu-responsive');
      menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    }
  </script>
</body>
</html>

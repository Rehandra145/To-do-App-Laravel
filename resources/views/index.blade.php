<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do APP</title>
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

        .menu li {
            cursor: pointer;
        }

        .menu li a,
        .menu li button {
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

        h1,
        h2 {
            color: #bb86fc;
            text-align: center;
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

        .complete-button-fr {
            background-color: #121212;
            padding: 0px;
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

        .delete-button-fr {
            background-color: #121212;
            padding: 0px;
            border-radius: 8px;
            width: 100px;
            margin-top: 20px;
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

        form {
            background-color: #1f1f1f;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            margin-top: 20px;
        }

        input[type="text"],
        input[type="date"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: none;
            border-radius: 4px;
            background-color: #333;
            color: #e0e0e0;
        }

        button {
            background-color: #bb86fc;
            color: #121212;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        button:hover {
            background-color: #9f6dfd;
        }

        .no-tasks {
            text-align: center;
            color: #888;
            font-style: italic;
            margin-top: 20px;
        }

        .level-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 8px;
            margin-bottom: 16px;
        }

        .level-container label {
            display: flex;
            align-items: center;
        }

        .level-container input[type="radio"] {
            margin-right: 5px;
        }

        #urgency-message {
            color: #888;
            /* Warna abu-abu */
            font-weight: normal;
            /* Tidak tebal */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <h2>To Do APP</h2>
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
                <li><a href="{{ route('indexProfile') }}">Profile</a></li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endif
        </ul>
        <ul id="menu-responsive" class="menu-responsive">
            @if (Auth::check())
                <li>
                    <form id="logout-form-responsive" action="{{ route('logout') }}" method="post"
                        style="display: none;">
                        @csrf
                    </form>
                    <a href="{{route('logout')}}" onclick="document.getElementById('logout-form-responsive').submit();">Logout</a>
                </li>
                <li><a href="#">Profile</a></li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{route('register')}}">Register</a></li>
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
        <h2>Your Tasks</h2>
        @if ($tasks->isEmpty())
            <p class="no-tasks">You have no tasks</p>
        @else
            @foreach ($tasks as $task)
                <div class="task-item">
                    <div class="task-info">
                        <p class="task-name">{{ $task->name }}</p>
                        <p class="task-date">{{ $task->DueTo }}</p>
                        <p class="task-date">{{ $task->level }}</p>
                    </div>
                    <!-- Form untuk tombol Delete -->
                    <form action="{{ route('Delete', $task->id) }}" method="post" class="delete-button-fr">
                        @method('delete')
                        @csrf
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                    <form action="{{ route('Update', $task->id) }}" method="post" class="complete-button-fr">
                        @method('patch')
                        @csrf
                        <button type="submit" class="complete-button">Complete</button>
                    </form>
                </div>
            @endforeach
        @endif
    </div>

    <h2>Add Tasks</h2>
    <form action="{{ route('Create') }}" method="post">
        @csrf
        <label for="name">Task</label>
        <input type="text" name="name" placeholder="Input your Task" required>

        <label for="date">Due To:</label>
        <input type="date" name="DueTo" required>

        <label for="level">Level:</label>
        <div class="level-container">
            <label><input type="radio" id="level1" name="level" value="1" onchange="showUrgency()">
                1</label>
            <label><input type="radio" id="level2" name="level" value="2" onchange="showUrgency()">
                2</label>
            <label><input type="radio" id="level3" name="level" value="3" onchange="showUrgency()">
                3</label>
            <label><input type="radio" id="level4" name="level" value="4" onchange="showUrgency()">
                4</label>
            <label><input type="radio" id="level5" name="level" value="5" onchange="showUrgency()">
                5</label>
        </div>
        <div id="urgency-container" style="display: flex; align-items: center; gap: 5px;">
          <p id="level" style="color: #bb86fc; font-weight: normal; margin: 0;"></p>
          <p id="urgency-message" style="color: #888; font-weight: normal; margin: 0;"></p>
      </div>
      <br>


        <button type="submit">ADD</button>
    </form>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu-responsive');
            if (menu.style.display === 'flex') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'flex';
            }
        }

        function toggleMenu() {
            const menu = document.getElementById('menu-responsive');
            if (menu.style.display === 'flex') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'flex';
            }
        }

        function showUrgency() {
            const levelValue = document.querySelector('input[name="level"]:checked').value;
            const messageElement = document.getElementById('urgency-message');
            const messageLevel = document.getElementById('level');
            let message = '';
            let levelText = '';

            switch (levelValue) {
                case '1':
                    levelText = 'Level 1: ';
                    message = 'Sangat Penting';
                    messageLevel.style.color = '#FF0000';
                    break;
                case '2':
                    levelText = 'Level 2: ';
                    message = 'Penting';
                    messageLevel.style.color = '#FFA500';
                    break;
                case '3':
                    levelText = 'Level 3: ';
                    message = 'Sedang';
                    messageLevel.style.color = '#FFFF00';
                    break;
                case '4':
                    levelText = 'Level 4: ';
                    message = 'Kurang Penting';
                    messageLevel.style.color = '#00FF00';
                    break;
                case '5':
                    levelText = 'Level 5: ';
                    message = 'Tidak Terlalu Penting';
                    messageLevel.style.color = '#ADD8E6';
                    break;
                default:
                    message = '';
            }
            messageLevel.textContent = levelText; ; 
            messageLevel.style.fontWeight = 'normal'; 
            messageElement.textContent = message;
        }

    </script>
</body>

</html>
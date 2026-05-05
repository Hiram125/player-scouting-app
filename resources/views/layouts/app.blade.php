<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scouting System</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

body {
    background: #0f172a;
    color: #e5e7eb;
}


        /* TOPBAR */
        .topbar {
            background: #111827;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            position: sticky;
            top: 0;
            z-index: 1001;
            box-shadow: 0 4px 15px rgba(0,0,0,0.4);
        }

        .menu-btn {
            font-size: 26px;
            cursor: pointer;
            color: white;
            transition: 0.3s;
        }

        .menu-btn:hover {
            color: #00d4ff;
        }

        .topbar h3 {
            font-weight: 500;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 0;
            background: #0b1220;
            overflow-x: hidden;
            transition: 0.3s ease;
            padding-top: 70px;
            z-index: 1002;
            box-shadow: 5px 0 20px rgba(0,0,0,0.5);
        }

        .sidebar a {
            display: block;
            padding: 15px 25px;
            text-decoration: none;
            color: #cbd5e1;
            transition: 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar a:hover {
            background: rgba(0, 212, 255, 0.1);
            border-left: 3px solid #00d4ff;
            color: white;
        }

        .sidebar.open {
            width: 260px;
        }

        /* OVERLAY */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            z-index: 1000;
        }

        .overlay.show {
            display: block;
        }

        /* MAIN CONTENT SHIFT */
        .main-wrapper {
            transition: 0.3s ease;
            margin-left: 0;
        }

        /* CONTENT AREA */
        .content {
            padding: 25px;
        }
    </style>
</head>

<body>

<!-- TOP BAR -->
<div class="topbar">
    <div class="menu-btn" onclick="toggleMenu()">☰</div>
    <h3>⚽ Scouting System</h3>
</div>

<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
    <a href="{{ route('home') }}">🏠 Home</a>
    <a href="{{ route('players.index') }}">👟 Players</a>
    <a href="{{ route('reports.index') }}">📊 Reports</a>
    <a href="{{ route('reports.create') }}">➕ Create Report</a>
    <a href="{{ route('fixtures.index') }}">📅 Fixtures</a>
    <a href="{{ route('compare.index') }}">⚖️ Compare</a>
</div>

<!-- OVERLAY -->
<div id="overlay" class="overlay" onclick="toggleMenu()"></div>

<!-- MAIN CONTENT -->
<div id="mainWrapper" class="main-wrapper">
    <div class="content">
        @yield('content')
    </div>
</div>

<script>
function toggleMenu() {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const wrapper = document.getElementById("mainWrapper");

    sidebar.classList.toggle("open");
    overlay.classList.toggle("show");

    // shift content when sidebar opens
    if (sidebar.classList.contains("open")) {
        wrapper.style.marginLeft = "260px";
    } else {
        wrapper.style.marginLeft = "0";
    }
}
</script>

</body>
</html>
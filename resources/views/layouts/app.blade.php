<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
<meta charset="UTF-8">
<title>Scouting System</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: #0f172a;
    color: white;
}

/* TOP BAR */
.topbar {
    background: #162447;
    padding: 15px;
    display: flex;
    align-items: center;
}

/* MENU BUTTON */
.menu-btn {
    font-size: 28px;
    cursor: pointer;
    margin-right: 15px;
}

/* SIDEBAR */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 0;
    background: #111827;
    overflow-x: hidden;
    transition: 0.3s;
    padding-top: 60px;
    z-index: 1000;
}

.sidebar a {
    display: block;
    padding: 15px 25px;
    text-decoration: none;
    color: white;
    transition: 0.2s;
}

.sidebar a:hover {
    background: #e43f5a;
}

/* CONTENT */
.content {
    margin-left: 0;
    padding: 20px;
    transition: 0.3s;
}

/* ACTIVE STATE */
.active {
    background: #00ff87;
    color: black !important;
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
    
</div>

<!-- PAGE CONTENT -->
<div id="content" class="content">
    @yield('content')
</div>

<script>
function toggleMenu() {
    let sidebar = document.getElementById("sidebar");

    if (sidebar.style.width === "250px") {
        sidebar.style.width = "0";
    } else {
        sidebar.style.width = "250px";
    }
}
</script>

=======
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScoutReport App</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 70px; /* space for fixed navbar */
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link.active {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">ScoutReport</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('players.index') ? 'active' : '' }}" href="{{ route('players.index') }}">Players</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('players.create') ? 'active' : '' }}" href="{{ route('players.create') }}">Add Player</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
</body>
</html>
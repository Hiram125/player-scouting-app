<!DOCTYPE html>
<html lang="en">
<head>
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

</body>
</html>
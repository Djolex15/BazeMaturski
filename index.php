<!DOCTYPE html>
<?php
session_start();
include_once 'db_conn.php';

$conn = new mysqli($host, $username, $password, $database);

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role == 'admin') {
        //header("Location: adminpage.php");
        //exit;
    }
}
?>
<html>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="F1.png" type="image/x-icon">
    <title>F1 Sezona</title>

    <link rel="stylesheet" href="styleindex.css">
</head>

<div id="navbar">
    <div id="header">
        <a href="index.php" style="text-decoration: none; color: white;">
            <label>F1 Sezona | Početna strana</label>
        </a>
    </div>
    <div id="buttons">
        <?php if (isset($_SESSION['role'])): ?>
            <button onclick="window.location.href = 'user.php';">Nalog</button>
        <?php else: ?>
            <button onclick="window.location.href = 'login.php';">Login</button>
        <?php endif; ?>
    </div>
</div>

<body>

    <div id="login-container">
        <img src="F1.png" width="100" height="100">
        <?php if (isset($_SESSION['role'])): ?>
            <h1>Dobro dosli <span style="color: green;"><?php echo $_SESSION['username'] ?></span>, ulogovani ste kao
                <span style="color: green;"><?php echo $role ?></span>
            </h1>
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <button onclick="window.location.href = 'adminpage.php';">Admin Page</button>
            <?php endif; ?>
            <h1>Upiti</h1>
            <button onclick="window.location.href = 'upiti/upit1.php';">Svi Vozaci Mercedesa</button>
            <button onclick="window.location.href = 'upiti/upit2.php';">Prvi Vozaca Mercedesa</button>
            <button onclick="window.location.href = 'upiti/upit3.php';">Vozaci Mercedesa i Red Bulla</button>
            <button onclick="window.location.href = 'upiti/upit4.php';">Suma svih poena timova</button>
            <h1>Pregledi</h1>
            <button onclick="window.location.href = 'upiti/pregled1.php';">Totalni poeni timova</button>
            <button onclick="window.location.href = 'upiti/pregled2.php';">Totalni poeni vozaca</button>
            <h1>Funkcije</h1>
            <button onclick="window.location.href = 'upiti/funkcija1.php';">Broj poena odredjenog tima</button>
            <h1>Procedure</h1>
            <button onclick="window.location.href = 'upiti/procedura1.php';">Broj poena odredjenog tima</button>

        <?php else: ?>
            <h1>Dobro dosli u F1 Sezona Menadzer, za vise sadrzaja uloguj te se</h1>
        <?php endif; ?>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <p>with<svg viewBox="0 0 460 460" class="red-heart">
                    <path
                        d="M256 448a32 32 0 01-18-5.57c-78.59-53.35-112.62-89.93-131.39-112.8-40-48.75-59.15-98.8-58.61-153C48.63 114.52 98.46 64 159.08 64c44.08 0 74.61 24.83 92.39 45.51a6 6 0 009.06 0C278.31 88.81 308.84 64 352.92 64c60.62 0 110.45 50.52 111.08 112.64.54 54.21-18.63 104.26-58.61 153-18.77 22.87-52.8 59.45-131.39 112.8a32 32 0 01-18 5.56z">
                    </path>
                </svg> by <a href="https://www.instagram.com/djolex15/" class="Djolex" target="_blank">Djolex</a>.
            </p>

            <ul class="social-media-links">
                <li><a href="https://www.linkedin.com/in/djordje-vu%C4%8Dkovi%C4%87-9b9445281/" target="_blank"><img
                            src="LinkedInLogo.png"></a></li>
            </ul>
        </div>
    </footer>

</body>

</html>
<!DOCTYPE html>
<?php
session_start();
include "../db_conn.php";

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="F1.png" type="image/x-icon">
    <title>F1 Sezona</title>

    <link rel="stylesheet" href="../styleadmin.css">
</head>

<body>
    <div id="navbar">
        <div id="header">
            <a href="../index.php" style="text-decoration: none; color: white;">
                <label>F1 Sezona | Pregled 2</label>
            </a>
        </div>
        <div id="buttons">
            <!--<button onclick="window.location.href = 'insert.php';">Poseti unos podataka</button>
            Add more buttons as needed -->
        </div>
    </div>
    <center>
        <table>
            <tr>
                <th colspan="4"><a>Totalni poeni vozaca (Driver Standings)</a></th>
            </tr>
            <th>ID Vozaca</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Broj poena vozaca</th>
            </tr>
            <?php
            $sql_query = "SELECT * FROM TotalniPoeniVozaca";
            $result_set = mysqli_query($conn, $sql_query);
            while ($row = mysqli_fetch_row($result_set)) {
                ?>
                <tr>
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </center>
    <footer class="footer">
        <div class="footer-content">
            <p>with<svg viewBox="0 0 460 460" class="red-heart">
                    <path
                        d="M256 448a32 32 0 01-18-5.57c-78.59-53.35-112.62-89.93-131.39-112.8-40-48.75-59.15-98.8-58.61-153C48.63 114.52 98.46 64 159.08 64c44.08 0 74.61 24.83 92.39 45.51a6 6 0 009.06 0C278.31 88.81 308.84 64 352.92 64c60.62 0 110.45 50.52 111.08 112.64.54 54.21-18.63 104.26-58.61 153-18.77 22.87-52.8 59.45-131.39 112.8a32 32 0 01-18 5.56z">
                    </path>
                </svg> by <a href="https://www.instagram.com/djolex15/" class="Djolex" target="_blank">Djolex</a>.
            </p>
        </div>
    </footer>
</body>

</html>
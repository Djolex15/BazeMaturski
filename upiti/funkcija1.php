<!DOCTYPE html>
<?php
session_start();
include "../db_conn.php";

$team_id = "";

if (isset($_POST['execute'])) {
    $team_id = $_POST['team_id'];

    if ($team_id != null) {

        $sql_query = "SELECT CalculateTotalPoints($team_id) AS `Svi poeni`";
        $result_set = mysqli_query($conn, $sql_query);
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="F1.png" type="image/x-icon">
    <title>F1 Sezona</title>

    <link rel="stylesheet" href="../styleinsert.css">
</head>

<body>
    <div id="navbar">
        <div id="header">
            <a href="../index.php" style="text-decoration: none; color: white;">
                <label>F1 Sezona | Funkcija 1</label>
            </a>
        </div>
        <div id="buttons">
            <!--<button onclick="window.location.href = 'insert.php';">Poseti unos podataka</button>
            Add more buttons as needed -->
        </div>
    </div>
    <center>
        <div class="">
            <form method="post" action="" id="formid">
                <input type="text" id="team_id" name="team_id" placeholder="Unesi ID tima">
                <button type="submit" name="execute">Izvrsi</button>
            </form>
            <table id="tableid">
                <tr>
                    <th colspan="1"><a>Totalni poeni tima
                            <?php if (isset($team_id) && $team_id != null):
                                echo $team_id;
                            endif;
                            ?>
                        </a></th>
                </tr>
                <tr>
                    <th>Totalni poeni</th>
                </tr>
                <?php

                if ($team_id != null) {
                    while ($row = mysqli_fetch_row($result_set)) {
                        ?>
                        <td><?php echo $row[0]; ?></td>
                        <?php
                    }
                }
                ?>
            </table>
        </div>


        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
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
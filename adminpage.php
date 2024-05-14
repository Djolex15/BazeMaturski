<!DOCTYPE html>

<?php
session_start();
include ('db_conn.php');

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role == 'user')
        header("Location: index.php");
    if (isset($_GET['deletevozaci_id'])) {

        $delete_id = mysqli_real_escape_string($conn, $_GET['deletevozaci_id']);

        $sql_query = "DELETE FROM vozaci WHERE id = '$delete_id'";

        if (mysqli_query($conn, $sql_query)) {
            header("Location: datatables/vozaci.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    if (isset($_GET['deletetrke_id'])) {

        $delete_id = mysqli_real_escape_string($conn, $_GET['deletetrke_id']);

        $sql_query = "DELETE FROM trke WHERE id = '$delete_id'";

        if (mysqli_query($conn, $sql_query)) {
            header("Location: datatables/trke.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    if (isset($_GET['deletetimovi_id'])) {

        $delete_id = mysqli_real_escape_string($conn, $_GET['deletetimovi_id']);

        $sql_query = "DELETE FROM timovi WHERE id = '$delete_id'";

        if (mysqli_query($conn, $sql_query)) {
            header("Location: datatables/timovi.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    if (isset($_GET['deleteteam_id'])) {

        $delete_id = mysqli_real_escape_string($conn, $_GET['deleteteam_id']);

        $sql_query = "DELETE FROM team_standings WHERE id = '$delete_id'";

        if (mysqli_query($conn, $sql_query)) {
            header("Location: datatables/teamstandings.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    if (isset($_GET['deletekalendar_id'])) {

        $delete_id = mysqli_real_escape_string($conn, $_GET['deletekalendar_id']);

        $sql_query = "DELETE FROM team_standings WHERE id = '$delete_id'";

        if (mysqli_query($conn, $sql_query)) {
            header("Location: datatables/kalendartrke.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    if (isset($_GET['deletedriver_id'])) {

        $delete_id = mysqli_real_escape_string($conn, $_GET['deletedriver_id']);

        $sql_query = "DELETE FROM driver_standings WHERE id = '$delete_id'";

        if (mysqli_query($conn, $sql_query)) {
            header("Location: datatables/driverstandings.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
} else {
    echo "Not logged in";
    header("Location: index.php");
}

?>


<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="F1.png" type="image/x-icon">
    <title>F1 Sezona</title>

    <link rel="stylesheet" href="styleadmin.css">

</head>

<body>
    <div id="navbar">
        <div id="header">
            <a href="index.php" style="text-decoration: none; color: white;">
                <label>F1 Sezona | Admin Strana</label>
            </a>
        </div>
        <div id="buttons">
            <button onclick="window.location.href = 'user.php';">Nalog</button>
        </div>
    </div>


    <center>
        <div class="container">
            <label for="data_table">Select Data Table:</label>
            <select name="data_table" id="data_table" required onchange="redirectToPage()">
                <option value="" disabled selected>Izaberi Data Table</option>
                <option value="datatables/vozaci.php">Vozaci</option>
                <option value="datatables/trke.php">Trke</option>
                <option value="datatables/timovi.php">Timovi</option>
                <option value="datatables/teamstandings.php">Team Standings</option>
                <option value="datatables/kalendartrke.php">Kalendar Trke</option>
                <option value="datatables/driverstandings.php">Driver Standings</option>
            </select>
        </div>

        <script>
            function redirectToPage() {
                var selectElement = document.getElementById("data_table");
                var selectedValue = selectElement.value;
                if (selectedValue) {
                    window.location.href = selectedValue;
                }
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
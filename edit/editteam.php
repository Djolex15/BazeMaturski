<!DOCTYPE html>
<?php
session_start();
include "../db_conn.php";

$conn = new mysqli($host, $username, $password, $database);

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role == 'user')
        header("Location: index.php");
} else {
    echo "Not logged in";
    header("Location: index.php");
}

if (isset($_GET['edit_id'])) {
    $sql_query = "SELECT * FROM team_standings WHERE id=" . $_GET['edit_id'];
    $result_set = mysqli_query($conn, $sql_query);
    $fetched_row = mysqli_fetch_array($result_set);
}
if (isset($_POST['btn-update'])) {
    $Tim = $_POST['Tim'];
    $Broj_poena = $_POST['Broj_poena'];

    $sql_query = "UPDATE team_standings SET Tim='$Tim',Broj_poena='$Broj_poena' WHERE id=" . $_GET['edit_id'];

    if (mysqli_query($conn, $sql_query)) {
        ?>
        <script type="text/javascript">
            alert('Promena je uspesno sacuvana!');
            window.location.href = '../datatables/teamstandings.php';
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert('error occured while updating data');
        </script>
        <?php
    }
    // sql query execution function
}
if (isset($_POST['btn-cancel'])) {
    header("Location: ../datatables/teamstandings.php");
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
            <a href="../datatables/teamstandings.php" style="text-decoration: none; color: white;">
                <label>F1 Sezona | Izmena podataka</label>
            </a>
        </div>

    </div>
    <center>
        <div class="tableinsert">
            <div id="content">
                <form method="post">
                    <table align="center">
                        <tr>
                            <td><input type="text" name="Tim" placeholder="ID Tim"
                                    value="<?php echo $fetched_row['Tim']; ?>" required /></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="Broj_poena" placeholder="Broj Poena"
                                    value="<?php echo $fetched_row['Broj_poena']; ?>" required /></td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="btn-update"><strong>PROMENI</strong></button>
                                <button type="submit" name="btn-cancel"><strong>Odustani</strong></button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
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
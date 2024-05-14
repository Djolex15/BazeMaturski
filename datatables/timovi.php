<!DOCTYPE html>
<?php
session_start();
include "../db_conn.php";

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role == 'user')
        header("Location: index.php");
} else {
    echo "Not logged in";
    header("Location: index.php");
}

if (isset($_POST['btn-save'])) {
    $naziv = $_POST['naziv'];
    $prvi_vozac = $_POST['prvi_vozac'];
    $drugi_vozac = $_POST['drugi_vozac'];

    $sql_query = "INSERT INTO timovi (Naziv, Prvi_vozac, Drugi_vozac) VALUES ('$naziv', '$prvi_vozac', '$drugi_vozac')";

    if (mysqli_query($conn, $sql_query)) {
        ?>
        <script type="text/javascript">
            alert('Podatak je sacuvan');
            window.location.href = 'timovi.php';
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert('Greska! Podatak nije dodat!');
        </script>
        <?php
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="F1.png" type="image/x-icon">
    <title>F1 Sezona</title>

    <link rel="stylesheet" href="../styleadmin.css">

    <script type="text/javascript">
        function edt_id(id) {
            if (confirm('Sigurni ste da zelite promenu podataka?')) {
                window.location.href = '../edit/edittimovi.php?edit_id=' + id;
            }
        }
        function delete_id(id) {
            if (confirm('Da li sigurno zelite da obrisete podatak?')) {
                window.location.href = '../adminpage.php?deletetimovi_id=' + id;
            }
        }
    </script>
</head>

<body>
    <div id="navbar">
        <div id="header">
            <a href="../adminpage.php" style="text-decoration: none; color: white;">
                <label>F1 Sezona | Timovi Table</label>
            </a>
        </div>
        <div id="buttons">
            <!--<button onclick="window.location.href = 'insert.php';">Poseti unos podataka</button>
            Add more buttons as needed -->
        </div>
    </div>


    <center>
        <label for="data_table">Select Data Table:</label>
        <select name="data_table" id="data_table" required onchange="redirectToPage()">
            <option value="" disabled selected>Izaberi Data Table</option>
            <option value="../adminpage.php">Admin Page</option>
            <option value="trke.php">Trke</option>
            <option value="timovi.php">Timovi</option>
            <option value="teamstandings.php">Team Standings</option>
            <option value="kalendartrke.php">Kalendar Trke</option>
            <option value="driverstandings.php">Driver Standings</option>
        </select>

        <script>
            function redirectToPage() {
                var selectElement = document.getElementById("data_table");
                var selectedValue = selectElement.value;
                if (selectedValue) {
                    window.location.href = selectedValue;
                }
            }
        </script>

        <center>
            <table>
                <tr>
                    <th colspan="3"><a>Timovi</a></th>
                </tr>
                <th>Naziv Tima</th>
                <th>Prvi Vozac</th>
                <th>Drugi Vozac</th>
                <th colspan="2">Operacija</th>
                </tr>
                <?php
                $sql_query = "SELECT * FROM timovi";
                $result_set = mysqli_query($conn, $sql_query);
                while ($row = mysqli_fetch_row($result_set)) {
                    ?>
                    <tr>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <td><a href="javascript:edt_id('<?php echo $row[0]; ?>')"><img src="../pencil.png" width="40"
                                    height="40" align="EDIT" /></a></td>
                        <td><a href="javascript:delete_id('<?php echo $row[0]; ?>')"><img src="../close.png" width="40"
                                    height="40" align="DELETE" /></a></td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <center>

                <button id="toggleButton">+</button>
                <div class="table" id="formContainer" style="display: none;">
                    <div id="content">
                        <form method="post">
                            <table>
                                <tr>
                                    <td>
                                        <select name="naziv" required>
                                            <option value="" disabled selected>Odaberi tim</option>
                                            <option value="Mercedes">Mercedes</option>
                                            <option value="Red Bull Racing">Red Bull Racing</option>
                                            <option value="McLaren">McLaren</option>
                                            <option value="Ferrari">Ferrari</option>
                                            <option value="Aston Martin">Aston Martin</option>
                                            <option value="Alpine">Alpine</option>
                                            <option value="AlphaTauri">AlphaTauri</option>
                                            <option value="Alfa Romeo Racing">Alfa Romeo Racing</option>
                                            <option value="Haas">Haas</option>
                                            <option value="Williams">Williams</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="prvi_vozac" placeholder="Prvi Vozac" required /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="drugi_vozac" placeholder="Drugi Vozac" required /></td>
                                </tr>
                                <tr>
                                    <td><button type="submit" name="btn-save"><strong>Sacuvaj</strong></button></td>
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
                        </svg> by <a href="https://www.instagram.com/djolex15/" class="Djolex"
                            target="_blank">Djolex</a>.
                    </p>
                </div>
            </footer>
            <script>
                const toggleButton = document.getElementById('toggleButton');
                const formContainer = document.getElementById('formContainer');

                toggleButton.addEventListener('click', function () {
                    if (formContainer.style.display === 'none') {
                        formContainer.style.display = 'block';
                    } else {
                        formContainer.style.display = 'none';
                    }
                });
            </script>
</body>

</html>
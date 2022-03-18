<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
$showAlert = false;
?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0' crossorigin='anonymous'>
    <title>All Students</title>
</head>

<body>
    <?php
    include 'header.php';
    if ($showAlert) {
        echo "<div class='alert $alertClass alert-dismissible fade show py-2 mb-0' role='alert'>
                <strong >$alertMsg</strong>
                <button type='button' class='btn-close pb-2' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
    ?>
    <div class="container my-3">
        <a href="home.php" class="btn btn-success mb-3">
            <- Home</a>
                <div style="margin-top: 0px; margin-inline: 1%;">
                    <center>

                        <a href="add-student.php" class="btn btn-primary">Add Student</a>
                    </center>
                    <h4 class="mb-3">All Students</h4>
                    <table id="view_cust" class="table-light table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th> Name </th>
                                <th>Class</th>
                                <th>Roll no</th>
                                <!-- <th># Books issued</th> -->
                                <th>Record</th>
                                <!-- <th style="min-width:150px">Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `all_students`";
                            include_once 'dbCon.php';
                            $result = mysqli_query($con, $sql);
                            $rowNos = mysqli_num_rows($result);
                            for ($x = 0; $x < $rowNos; $x++) {
                                $sn = $x + 1;
                                $row = mysqli_fetch_assoc($result);
                                $name = $row['name'];
                                $class = $row['class'];
                                $roll_no = $row['roll_no'];
                                $books_pending = $row['books_pending'];
                                // $remark = $row['remark'];
                                echo "<tr>
                            <td>$sn </td>
                            <td>$name </td>
                            <td>$class</td>
                            <td>$roll_no</td>
                            
                            <td>
                                <a href='books-record.php?student_class=$class&view_roll_no=$roll_no' class='btn btn-primary'>View</a>
                            </td>
                        </tr>";
                            }
                            mysqli_close($con);
                            ?>
                        </tbody>
                    </table>
                    <!-- for data table -->
                    <script src="https://code.jquery.com/jquery-3.5.1.js"> </script>
                    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"> </script>
                    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"> </script>
                    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
                    <script>
                        $(document).ready(function() {
                            $('#view_cust').DataTable({
                                "scrollX": true,
                                "pageLength": 10,
                            });
                        });
                    </script>
                </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8' crossorigin='anonymous'></script>
</body>

</html>
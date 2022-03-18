<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
$showAlert = false;
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['view_roll_no'])) {
    $student_class = $_GET['student_class'];
    $roll_no = $_GET['view_roll_no'];
    $sql = "SELECT * FROM `all_students` WHERE class='$student_class' AND roll_no='$roll_no'";
    include_once 'dbCon.php';
    $result = mysqli_query($con, $sql);
    $rowNos = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if ($rowNos == 0) {
        $showAlert = true;
        $alertClass = 'alert-danger';
        $alertMsg = "Error, No student in Class $student_class with Roll no $roll_no";
    } else {
        header("Location: books-record.php?student_class=$student_class&view_roll_no=$roll_no");
    }
}
?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0' crossorigin='anonymous'>
    <title>Issue/Return Books</title>
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
                <h5>Enter Student's</h5>
                <form action="issue-return-books.php" method="GET">
                    <div class="">
                        <label for="student_class" class="form-label float-start">Class</label>
                        <input type="text" class="form-control" name="student_class" id="student_class">
                    </div>
                    <div class="">
                        <label for="roll_no" class="form-label float-start">Roll no</label>
                        <input type="text" class="form-control" name="view_roll_no" id="view_roll_no">
                    </div>
                    <!-- <input type="text" name="cust_name" id="cust_name" placeholder="Enter customer name"><br> -->
                    <input type="submit" class="btn btn-primary mt-3">
                </form>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8' crossorigin='anonymous'></script>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
$showAlert = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['roll_no'])) {
    $roll_no = $_POST['roll_no'];
    $student_name = $_POST['student_name'];
    $student_class = $_POST['student_class'];
    $id = $student_class . '-' . $roll_no;
    include_once 'dbCon.php';
    $sql = "INSERT INTO `all_students` VALUES ('$id','$student_name','$student_class','$roll_no',0);"; //NULL for auto inrement
    $result = mysqli_query($con, $sql);
    if ($result) {
        $showAlert = true;
        $alertClass = 'alert-success';
        $alertMsg = "$student_name ($roll_no) added!";
    } else {
        $showAlert = true;
        $alertClass = 'alert-danger';
        $alertMsg = "Error, Student not added!";
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
    <title>Add Student</title>
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
                <h3>Add Student</h3>
                <form method='POST' action='add-student.php'>
                    <div class='mb-3'>
                        <label for='student_name' class='form-label float-start'>Name</label>
                        <input type='text' class='form-control' id='student_name' name='student_name' required>
                    </div>
                    <div class='mb-3'>
                        <label for='student_class' class='form-label float-start'>Class</label>
                        <input type='text' class='form-control' id='student_class' name='student_class' required>
                    </div>
                    <div class='mb-3'>
                        <label for='roll_no' class='form-label float-start'>Roll Number</label>
                        <input type='text' class='form-control' id='roll_no' name='roll_no' required>
                    </div>
                    <button type='submit' class='btn btn-primary'>Submit</button>
                </form>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8' crossorigin='anonymous'></script>
</body>

</html>
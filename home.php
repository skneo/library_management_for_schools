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
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete_roll_no'])) {
    $delete_roll_no = $_GET['delete_roll_no'];
    $student_class = $_GET['student_class'];
    $name = $_GET['name'];
    include_once 'dbCon.php';
    $sql = "DELETE FROM `all_students` WHERE `class`=$student_class AND roll_no=$delete_roll_no";
    $result1 = mysqli_query($con, $sql);
    $sql = "DELETE FROM `books_record` WHERE `class`=$student_class AND roll_no=$delete_roll_no";
    $result2 = mysqli_query($con, $sql);
    if ($result1 && $result2) {
        $showAlert = true;
        $alertClass = 'alert-success';
        $alertMsg = "$name deleted from database";
    } else {
        $showAlert = true;
        $alertClass = 'alert-danger';
        $alertMsg = "Error, $name not deleted from database";
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
    <title>Home</title>
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
    <div class="row container my-3">
        <!-- <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title ">Add Student</h5>
                    <img src="images/add-student.png" class="card-img-top" alt="...">
                    <p class="card-text text-start mt-3">Add students to database</p>
                    <a href="add-student.php" class="btn btn-primary mb-2 w-100">Add Student</a>
                </div>
            </div>
        </div> -->

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title ">Issue/Return Book</h5>
                    <img src="images/issue-return.jpg" class="card-img-top" alt="...">
                    <p class="card-text text-center mt-3">Issue/Return a book</p>
                    <button type="button" class="btn btn-primary mb-2 w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Issue/Return Book
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title ">All Issued Books</h5>
                    <img src="images/books.webp" class="card-img-top" alt="...">
                    <p class="card-text text-center mt-3">View all issued books</p>
                    <a href="all-issued-books.php" class="btn btn-primary mb-2 w-100">All Issued Books</a><br>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title ">All Students</h5>
                    <img src="images/all-students.jpg" class="card-img-top" alt="...">
                    <p class="card-text text-center mt-3">View all students in database</p>
                    <a href="all-students.php" class="btn btn-primary mb-2 w-100">All Students</a><br>
                </div>
            </div>
        </div>



        <!-- <a href="add-student.php" class="btn btn-primary mb-3">Add Student</a> <br> -->
        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Issue/Return Book
        </button><br>
        <a href="all-students.php" class="btn btn-primary mb-3">All Students</a> <br>
        <a href="all-issued-books.php" class="btn btn-primary mb-3">All Issued Books</a> <br> -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enter Student's </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="home.php" method="GET">
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
                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8' crossorigin='anonymous'></script>
</body>

</html>
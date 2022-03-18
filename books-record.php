<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
$showAlert = false;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['view_roll_no'])) {
    $roll_no = $_GET['view_roll_no'];
    $student_class = $_GET['student_class'];
    $id = $_GET['student_class'] . '-' . $_GET['view_roll_no'];
    $sql = "SELECT * FROM `all_students` WHERE id='$id'";
    include_once 'dbCon.php';
    $result = mysqli_query($con, $sql);
    $rowNos = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $student_name = $row['name'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['issue_roll_no'])) {
    $roll_no = $_POST['issue_roll_no'];
    $student_class = $_POST['student_class'];
    $student_name = $_POST['student_name'];
    $book_name = $_POST['book_name'];
    $issue_date = $_POST['issue_date'];
    $remark = $_POST['remark'];
    $id = $student_class . '-' . $roll_no;
    include_once 'dbCon.php';
    $sql = "INSERT INTO `books_record` VALUES (NULL,'$student_name','$id','$student_class','$roll_no','$book_name','$issue_date','NO','','$remark');"; //NULL for auto inrement
    $result = mysqli_query($con, $sql);
    if ($result) {
        $showAlert = true;
        $alertClass = 'alert-success';
        $alertMsg = "$book_name issued to $student_name($student_class-$roll_no)";
    } else {
        $showAlert = true;
        $alertClass = 'alert-danger';
        $alertMsg = "Error, $book_name not issued to $student_name($student_class-$roll_no)";
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];

    $sql = "SELECT * FROM `books_record` WHERE id=$edit_id";
    include_once 'dbCon.php';
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $student_name = $row['student_name'];
    $student_class = $row['class'];
    $roll_no = $row['roll_no'];

    $book_name = $_POST['book_name'];
    $issue_date = $_POST['issue_date'];
    $returned = $_POST['returned'];
    $return_date = $_POST['return_date'];
    $remark = $_POST['remark'];
    if ($returned == 'NO') {
        $return_date = '';
    }
    $sql = "UPDATE `books_record` SET `book_name`='$book_name',`issued_on`='$issue_date',`returned`='$returned',`returned_on`='$return_date',`remark`='$remark'  WHERE `id`='$edit_id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $showAlert = true;
        $alertClass = 'alert-success';
        $alertMsg = "Record no $edit_id updated";
    } else {
        $showAlert = true;
        $alertClass = 'alert-danger';
        $alertMsg = "Error, Record no $edit_id not updated";
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    include_once 'dbCon.php';

    $sql = "SELECT * FROM `books_record` WHERE id=$delete_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $roll_no = $row['roll_no'];
    $student_class = $row['class'];
    $student_name = $row['student_name'];

    $sql = "DELETE FROM `books_record` WHERE `id`=$delete_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $showAlert = true;
        $alertClass = 'alert-success';
        $alertMsg = "Record no $delete_id deleted";
    } else {
        $showAlert = true;
        $alertClass = 'alert-danger';
        $alertMsg = "Error, Record no $delete_id not deleted";
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
    <title>Books Record</title>
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
    <div class="container mt-3">
        <a href="home.php" class="btn btn-success mb-3">
            <- Home</a>
                <p class="fs-5"><b>Name: </b><?php echo $student_name ?><br><b> Class: </b><?php echo $student_class ?><br><b> Roll no: </b><?php echo $roll_no ?></p>
    </div>
    <center>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_trans">
            Issue New Book
        </button>
        <!-- Modal -->
        <div class="modal fade" id="add_trans" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Issue New Book to <?php echo "$student_name ($id)" ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="books-record.php" method="POST">
                            <div class=" ">
                                <!-- <label for="cust_name" class="form-label float-start">Customer Name: </label> -->
                                <input type="text" class="form-control d-none" name="student_class" id="student_class" value='<?php echo "$student_class" ?>'>
                                <input type="text" class="form-control d-none" name="issue_roll_no" id="issue_roll_no" value='<?php echo "$roll_no" ?>'>
                                <input type="text" class="form-control d-none" name="student_name" id="student_name" value='<?php echo "$student_name" ?>'>
                            </div>
                            <div class=" mb-1">
                                <label for="book_name" class="form-label float-start">Book Name</label>
                                <input class="form-control" type="text" name="book_name" id="book_name">
                            </div>
                            <div class=" mb-1">
                                <label for="issue_date" class="form-label float-start">Issue Date</label>
                                <input class="form-control" value="<?php echo date('Y-m-d'); ?>" type="date" name="issue_date" id="issue_date">
                            </div>
                            <div class=" mb-1">
                                <label for="remark" class="form-label float-start">Remark</label>
                                <input class="form-control " type="text-box" name="remark" id="remark" placeholder="enter remark if any">
                            </div>
                            <input type="submit" class="btn btn-primary mt-2">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <div class="mt-3 mx-3 mb-0 text-center">
        <u>
            <h4>Book Records</h4>
        </u>
    </div>
    <div class="container">
        <div style="margin-top: 0px; margin-inline: 1%;">
            <table id="view_cust" class="table-light table table-striped table-bordered " style="width:100%">
                <thead>
                    <tr>
                        <th> Record no</th>
                        <th> Name of Book</th>
                        <th style="min-width:80px">Issue Date</th>
                        <th style="min-width:80px">Returned</th>
                        <th style="min-width:80px">Return Date</th>
                        <th style="min-width:200px">Remark</th>
                        <th style="min-width:150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `books_record` WHERE `class`='$student_class' AND roll_no='$roll_no' ORDER BY returned DESC";
                    $result = mysqli_query($con, $sql);
                    $rowNos = mysqli_num_rows($result);
                    for ($x = 0; $x < $rowNos; $x++) {
                        $row = mysqli_fetch_assoc($result);
                        $id = $row['id'];
                        $book_name = $row['book_name'];
                        $issued_on = $row['issued_on'];
                        $returned = $row['returned'];
                        $returned_on = $row['returned_on'];
                        $remark = $row['remark'];
                        echo "<tr>
                            <td>$id </td>
                            <td>$book_name </td>
                            <td>$issued_on</td>
                            <td>$returned</td>
                            <td>$returned_on</td>
                            <td>$remark</td>
                            <td>
                                <a href='record-edit.php?edit_id=$id' class='btn btn-primary'>Edit</a>
                                <a href='books-record.php?delete_id=$id' class='btn btn-danger' onclick=\"return confirm('Sure to delete Record no $id?')\">Delete</a>
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
    <center>
        <a href="home.php?delete_roll_no=<?php echo $roll_no ?>&student_class=<?php echo $student_class ?>&name=<?php echo $student_name ?>" class="btn btn-danger mt-3" onclick="return confirm('Sure to delete <?php echo $student_name ?>?')">Delete Student</a>
    </center>
    <br>
    <br>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8' crossorigin='anonymous'></script>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
$showAlert = false;
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    include_once 'dbCon.php';
    $sql = "SELECT * FROM `books_record` WHERE id=$edit_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $student_name = $row['student_name'];
    $roll_no = $row['roll_no'];
    $class = $row['class'];
    $book_name = $row['book_name'];
    $issue_date = $row['issued_on'];
    $returned = $row['returned'];
    // echo $returned;
    $return_date = $row['returned_on'];
    $remark = $row['remark'];
}
?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0' crossorigin='anonymous'>
    <title>Record Edit</title>
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
        <?php
        echo "<a href='books-record.php?student_class=$class&view_roll_no=$roll_no' class='btn btn-success mb-3'>";
        ?>
        <- Back</a>
            <center>
                <h4 class="mb-5">Edit Record no <?php echo "$edit_id" ?> for <?php echo "$student_name($class-$roll_no)" ?></h4>
                <form action="books-record.php" method="POST" style="width: 300px;">
                    <div class=" ">
                        <!-- <label for="edit_trans_id" class="form-label float-start">Transaction ID</label> -->
                        <input type="number" class="form-control d-none" name="edit_id" id="edit_id" placeholder="Don't change Trans ID" value='<?php echo "$edit_id" ?>'>
                    </div>
                    <div class=" ">
                        <!-- <label for="cust_name" class="form-label float-start">Customer Name</label> -->
                        <!-- <input type="text" class="form-control d-none" name="cust_name" id="cust_name" value='<?php echo "$cust_name" ?>'> -->
                    </div>
                    <div class=" mb-1">
                        <label for="book_name" class="form-label float-start">Book Name</label>
                        <input class="form-control" type="text" name="book_name" id="book_name" value='<?php echo "$book_name" ?>'>
                    </div>
                    <div class="mb-1">
                        <label for="issue_date" class="form-label float-start">Issue Date</label>
                        <input class="form-control " type="date" name="issue_date" id="issue_date" value='<?php echo "$issue_date" ?>'>
                    </div>
                    <div class="mb-1">
                        <label for="returned" class="form-label float-start">Returned</label>
                        <select class="form-select" name="returned" id="returned_book">
                            <option value="YES">YES</option>
                            <option value="NO">NO</option>
                        </select>
                        <script>
                            <?php echo "document.getElementById('returned_book').value = '$returned'" ?>
                        </script>
                    </div>
                    <div class="mb-1">
                        <label for="return_date" class="form-label float-start">Return Date</label>
                        <input class="form-control " type="date" name="return_date" id="return_date" value='<?php echo "$return_date" ?>'>
                    </div>
                    <div class=" mb-3">
                        <label for="remark" class="form-label float-start">Remark</label>
                        <input class="form-control " type="text-box" name="remark" id="remark" value='<?php echo "$remark" ?>'>
                    </div>
                    <input type="submit" class="btn btn-primary mt-2">

                </form>
            </center>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8' crossorigin='anonymous'></script>
</body>

</html>
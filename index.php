<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location: home.php');
}
$showAlert = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
    $pwd = $_POST['password'];
    $user_name = $_POST['username'];
    // echo $password;
    include_once 'dbCon.php';
    $sql = "SELECT * FROM `enjoyers` WHERE `username`='$user_name' AND `password`='$pwd'";
    // echo $sql;
    $result = mysqli_query($con, $sql);
    $rowNos = mysqli_num_rows($result);
    if ($rowNos == 1) {
        $_SESSION['loggedin'] = true;
        header('Location: home.php');
    } else {
        $showAlert = true;
        $alertClass = 'alert-danger';
        $alertMsg = "Error, wrong credenials";
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
    <title>Login</title>
</head>

<body>
    <?php
    if ($showAlert) {
        echo "<div class='alert $alertClass alert-dismissible fade show py-2 mb-0' role='alert'>
                <strong >$alertMsg</strong>
                <button type='button' class='btn-close pb-2' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
    ?>
    <div class="text-center mt-5 w-25 container" style="min-width: 300px;">
        <h3>Login into Library</h3>
        <div class="mt-3">
            <img src="images/user.png" alt="user" width="120">
        </div>
        <form action="index.php" method="POST">
            <div class="mb-2 ">
                <label for="username" class="form-label float-start">Username</label>
                <input type="text" name="username" id="username" class="mt-3 form-control" placeholder="Enter username">
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label float-start">Password</label>
                <input type="password" name="password" id="password" class="my-3 form-control" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary px-5 ">Login</button>
        </form>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8' crossorigin='anonymous'></script>
</body>

</html>
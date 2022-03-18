<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}

if (isset($_POST['pwd1'])) {
    $pwd1 = trim($_POST['pwd1']);
    $pwd2 = trim($_POST['pwd2']);
    date_default_timezone_set('Asia/Kolkata');
    $curr_date = date('Y-m-d H:i:s');
    if (($pwd1 != $pwd2) or $pwd1 == "") {
        echo "<script> alert('Both passwords not matched') </script>";
    } else {
        $user = file_get_contents("data/user.json");
        $user = json_decode($user, true);
        $user["password"] = $pwd1;
        file_put_contents("data/user.json", json_encode($user));
        session_destroy();
        echo "<script> alert('Password changed successfully! ') </script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>Change Password</title>
</head>

<body>
    <?php include "header.php" ?>
    <center>
        <form method="POST" class="mt-5" style="width: 220px" action="change-password.php">
            <div></div>
            <div class=" mb-3">
                <input required placeholder="Enter new password" type="password" class="form-control" id="pwd1" name="pwd1">
            </div>
            <div class="mb-3">
                <input required placeholder="Enter new password again" type="password" class="form-control" id="pwd2" name="pwd2">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </center>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>
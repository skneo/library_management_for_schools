<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-danger" href="home.php">Library</a>
        <!-- <img src="images/logo.png" alt="DMRC" width="30" height="30"> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- <li class="nav-item">
                    <a id="home" class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li> -->
                <!-- <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle active' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Employee's Data</a>
                    <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                        <li><a class='dropdown-item' href='employee-biodata.php'>Biodata</a></li>
                        <li><a class='dropdown-item' href='employee-vaccine-data.php'>Vaccination Data</a></li>
                    </ul>
                </li> -->
                <!-- <li class="nav-item">
                    <a id="home" class="nav-link active" aria-current="page" href="batches.php">Training Batches</a>
                </li> -->
                <li class="nav-item">
                    <a id="feedback" class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a id="feedback" class="nav-link active" aria-current="page" href="issue-return-books.php">Issue/Return</a>
                </li>
                <li class="nav-item">
                    <a id="feedback" class="nav-link active" aria-current="page" href="all-issued-books.php">All Issued</a>
                </li>
                <li class="nav-item">
                    <a id="feedback" class="nav-link active" aria-current="page" href="all-students.php">All Students</a>
                </li>
                <!-- <li class="nav-item">
                    <a id="home" class="nav-link active" aria-current="page" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a id="home" class="nav-link active" aria-current="page" href="contact.php">Contact</a>
                </li> -->


            </ul>
            <!-- <form class="d-flex" method='GET' action='search-biodata.php'>
                <input class="form-control me-2" type="search" placeholder="Employee number" name='enumSearch' id='enumSearch' aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form> -->
            <?php
            // if (isset($_SESSION['loggedin']) && $_SESSION['profile'] == 'admin') {
            //     echo "<div class=\"btn-group ms-2\">
            //             <button  type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\" value=\"\">
            //                 Admin Control
            //             </button>
            //             <ul class=\"dropdown-menu\">
            //                 <li><a class=\"dropdown-item\" href=\"add-users.php\">Add Users</a></li>
            //                 <li><a class=\"dropdown-item\" href=\"inactive-users.php\">Approve Users</a></li>
            //                 <li><a class=\"dropdown-item\" href=\"delete.php\">Delete Form Data</a></li>
            //             </ul>
            //         </div>";
            // }
            ?>
            <div class="btn-group ms-2 me-3">
                <button id="userMenu" type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" value="">
                    User
                </button>
                <ul class="dropdown-menu ">
                    <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<style>
    /* body {
        background-color: rgb(218, 225, 233);
    } */

    @media only screen and (min-width: 960px) {
        .navbar .navbar-nav .nav-item .nav-link {
            padding: 0 0.5em;
        }

        .navbar .navbar-nav .nav-item:not(:last-child) .nav-link {
            border-right: 1px solid #f8efef;
        }
    }

    .navbar-nav li:hover>ul.dropdown-menu {
        display: block;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
    }

    /* rotate caret on hover */
    .dropdown-menu>li>a:hover:after {
        text-decoration: underline;
        transform: rotate(-90deg);
    }
</style>

<?php
// $username = $_SESSION['username'];
// echo "<script>
//     document.getElementById('userMenu').innerHTML='$username';
//   </script>";
?>
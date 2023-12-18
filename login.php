<?php
// Check if the user is logged in
include('db.php');
if (isset($_COOKIE['user_logged_in']) && $_COOKIE['user_logged_in'] == true) {
    $showLoginForm = false;
    $user_id =$_COOKIE['user_id'];
    $sql = "SELECT * FROM users WHERE id='$user_id'";
    $run_qry = mysqli_query($conn,$sql);
    $total_records = mysqli_num_rows($run_qry);
    if($total_records > 0){
        $user= mysqli_fetch_assoc($run_qry);
    }
    else{
        header('Location: logout.php');
    }
} else {
    $showLoginForm = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email='$email' AND original_password='$password'";
    $run_qry = mysqli_query($conn,$sql);
    $total_records = mysqli_num_rows($run_qry);
    $row = mysqli_fetch_assoc($run_qry);
    if($total_records > 0){
        setcookie('user_logged_in', true, time() + 3600, '/'); // Cookie expires in 1 hour
        setcookie('user_id', $row['id'], time() + 3600, '/'); // Cookie expires in 1 hour
        header('Location: login.php');
    }
    else{
         $return = "error";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./styles/styles.css" rel="stylesheet">
</head>

<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <a href="index.php">Register</a>
                        <a href="login.php" class="active">Login</a>
                        <a href="users.php">All Users</a>
                    </div>
                </div>
                <div class="col-md-9 bg-white">
                    <section class="register p-5">
                        <?php if ($showLoginForm): ?>
                        <h1 class="border-bottom pb-2">Login</h1>
                        <form method="post" action="login.php">
                            <div class="mb-3">
                                <label for="EmailInput" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="EmailInput" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="PasswordInput" class="form-label">Password</label>
                                <input type="password" class="form-control" id="PasswordInput" name="password">
                            </div>
                            <?php
                        if ($return === 'error') {
                            echo '<div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Login Failed! </strong> Incorrect email/password please check once.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                        }
                        ?>
                            <button type="submit" class="btn-submit">Submit</button>
                        </form>
                        <?php else: ?>
                        <!-- Display logout button -->
                        <h1 class="border-bottom pb-2">Welcome, <?php echo $user['name'] ?>!</h1>
                        <ul class="list-group">
                            <li class="list-group-item bg-light text-center">Your details </li>
                            <li class="list-group-item">Email:<?php echo $user['email'] ?></li>
                            <li class="list-group-item">Phone:<?php echo $user['phone'] ?></li>
                            <li class="list-group-item">Gender:<?php echo $user['gender'] ?></li>
                            <li class="list-group-item">City:<?php echo $user['city'] ?></li>
                        </ul>
                        <a href="logout.php" class="edit_button ml-auto">Logout</a>
                        <?php endif; ?>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
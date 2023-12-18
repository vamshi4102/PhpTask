<?php
include('db.php');
$id ='';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id='$id'";
        $run_qry = mysqli_query($conn,$sql);
        $total_records = mysqli_num_rows($run_qry);
        if($total_records > 0){
            $user= mysqli_fetch_assoc($run_qry);
        }
        else{
            header('Location: users.php');
        }
}

if (isset($_POST['UpdateAccount'])) {
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$phone = $_POST["phone"];
$gender = $_POST["gender"];
$city = $_POST["city"];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$sql = "UPDATE users SET name='$name',email='$email',phone='$phone',gender='$gender',city='$city',original_password='$password',password='$hashed_password' WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
$account_success = true;
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

}
else if (isset($_POST['DeleteAccount'])){
    $sql = "DELETE FROM users WHERE id = '$id'";
    $delete_qry = mysqli_query($conn,$sql);
    if($delete_qry){
        header('Location: users.php');
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
    <title>Php Test</title>
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
                        <a href="login.php">Login</a>
                        <a href="users.php">All Users</a>
                    </div>
                </div>
                <div class="col-md-9 bg-white">
                    <section class="register p-5">
                        <h1 class="border-bottom pb-2">Profile, <?php echo $user['name']?></h1>
                        <?php
                        if ($account_success === true) {
                            echo '<div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Update Success!</strong> Your account has been updated successfully
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                        }
                        ?>
                        <form method="post"
                            action="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
                            <div class="mb-3">
                                <label for="NameInput" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="NameInput"
                                    value="<?php echo $user['name']?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="EmailInput" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="EmailInput" required
                                    value="<?php echo $user['email']?>">
                            </div>
                            <div class="mb-4">
                                <label for="PhoneInput" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="PhoneInput" required
                                    value="<?php echo $user['phone']?>">
                            </div>
                            <div class="mb-4">
                                <select class="form-select" id="floatingSelectGrid" required name="gender">
                                    <option selected><?php echo $user['gender']?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <select class="form-select" id="floatingSelectGrid" required name="city">
                                    <option selected><?php echo $user['city']?></option>
                                    <?php
                                        $get_cities = "SELECT * FROM cities";
                                        $result1 =  mysqli_query($conn,$get_cities);
                                        $total_records1 = mysqli_num_rows($result1);  
                                    if ($total_records1 > 0) {
                                        while($row1 = mysqli_fetch_assoc($result1)){
                                        echo ' <option value="'.$row1['city_name'].'"> '.$row1['city_name'].'</option>';
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="PasswordInput" class="form-label" required>Password</label>
                                <input type="password" class="form-control" name="password" id="PasswordInput"
                                    value="<?php echo $user['original_password']?>">
                            </div>
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="submit" class="btn-submit" name="UpdateAccount">Update</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn-submit bg-danger"
                                            name="DeleteAccount">Delete</button>
                                    </div>
                                    <div class="col-md-5"></div>
                                </div>
                            </div>

                        </form>
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
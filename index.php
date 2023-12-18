<?php
include('db.php');
$account_success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $city = $_POST["city"];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name,email,phone,gender,city,original_password ,password) VALUES ('$name', '$email', '$phone','$gender', '$city','$password', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $account_success = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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
                        <a class="active" href="index.php">Register</a>
                        <a href="login.php">Login</a>
                        <a href="users.php">All Users</a>
                    </div>
                </div>
                <div class="col-md-9 bg-white">
                    <section class="register p-5">
                        <h1 class="border-bottom pb-2">Register now</h1>
                        <?php
                        if ($account_success === true) {
                            echo '<div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Your account has been created successfully, Please login now.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                        }
                        ?>
                        <form method="post" action="index.php">
                            <div class="mb-3">
                                <label for="NameInput" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="NameInput" required>
                            </div>
                            <div class="mb-3">
                                <label for="EmailInput" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="EmailInput" required>
                            </div>
                            <div class="mb-4">
                                <label for="PhoneInput" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="PhoneInput" required>
                            </div>
                            <div class="mb-4">
                                <select class="form-select" id="floatingSelectGrid" required name="gender">
                                    <option selected>Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <select class="form-select" id="floatingSelectGrid" required name="city">
                                    <option selected>Select your city</option>
                                    <?php
                                        $get_cities = "SELECT * FROM cities";
                                        $result1 =  mysqli_query($conn,$get_cities);
                                        $total_records1 = mysqli_num_rows($result1);  
                                    if ($total_records1 > 0) {
                                        while($row1 = mysqli_fetch_assoc($result1)){
                                        echo '<option value="'.$row1['city_name'].'"> '.$row1['city_name'].'</option>';
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="PasswordInput" class="form-label" required>Password</label>
                                <input type="password" class="form-control" name="password" id="PasswordInput">
                            </div>
                            <button type="submit" class="btn-submit">Submit</button>
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
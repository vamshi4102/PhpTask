<?php
include('db.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Users</title>
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
                        <a href="users.php" class="active" href="#contact">All Users</a>
                    </div>
                </div>
                <div class="col-md-9 bg-white">
                    <section class="register p-5">
                        <h1 class="border-bottom pb-2">Registered Users</h1>
                        <div>
                            <?php
                $list_type = 'LIVE';
                $get_rewards_11 = "SELECT * FROM users ORDER BY id DESC";
                $result1 =  mysqli_query($conn,$get_rewards_11);
                $total_records1 = mysqli_num_rows($result1);  
            if ($total_records1 > 0) {
                while($row1 = mysqli_fetch_assoc($result1)){
                echo '<div class="user_card">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img src="./assets/images/user_image.png" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0">Name: '.$row1['name'].'</li>
                            <li class="list-group-item border-0">Phone: '.$row1['phone'].'</li>
                            <li class="list-group-item border-0">Email: '.$row1['email'].'</li>
                            <li class="list-group-item border-0">City: '.$row1['city'].'</li>
                        </ul>
                    </div>
                </div>
                <a href="profile.php?id='.$row1['id'].'" class="edit_button ml-auto">View profile</a>
            </div>';
                }
            }
            else{
                echo '
                <div class="my-3">
                <img src="./assets/images/no___results.png" class="rounded mx-auto d-block" width="350px" height=="350px">
                <p class="text-center my-2">0 accounts found!</p>
                </div>
                '
;            }
                ?>
                            
                        </div>
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
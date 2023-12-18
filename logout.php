<?php

setcookie('user_logged_in', false, time() - 3600, '/');
setcookie('user_id', false, time() - 3600, '/');
header('Location: index.php');
exit();
?>

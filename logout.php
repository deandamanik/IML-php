<?php
session_start();
session_destroy();

// Hapus cookie
setcookie("user_id", "", time() - 3600, "/");

// Redirect ke halaman login
header("Location: index.php");
exit();
?>

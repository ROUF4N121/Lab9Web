<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: modules/auth/login.php");
    exit;
}

include 'config/database.php';
include 'views/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : "dashboard";

if ($page === "dashboard") {
    include "views/dashboard.php";
}
else if (file_exists("modules/" . $page . ".php")) {
    include "modules/" . $page . ".php";
}
else {
    include "modules/error/404.php";
}

include 'views/footer.php';
?>

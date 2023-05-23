<link rel="stylesheet" href="./assets/styles/home.css">
<title>Home</title>


<?php
include_once "./components/header.php";
?>

<section class="container-fluid px-2">
    <?php
    include_once "./components/sidebar.php";
    echo getSideBar($user, 1);
    ?>



</section>
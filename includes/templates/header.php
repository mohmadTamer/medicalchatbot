<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medcare</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file link  -->


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $css; ?>style.css">
    <link rel="stylesheet" href="<?php echo $css; ?>profile.css">
    <link rel="stylesheet" href="<?php echo $css; ?>chat.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>

</head>


<body id="test1">
        <!-- header section starts  -->

        <header class="header">

<a href="#" class="logo"> <img src="layout/images/Asset 1@5x.png" width="40px" alt=""> M.D Chatbot</a>

<nav class="navbar">
    <a href="index.php#home">home</a>
    <a href="index.php#services">campaign</a>
    <a href="index.php#about">about us</a>
    <a href="index.php#doctors">Doctors</a>
    <a href="index.php#blogs">blogs</a>

<?php 

if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){ ?>

<div class="dropdown">
<a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Profile</a>
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
<a class="" href="profile.php">My Profile</a>
<a class="" href="logout.php">Log out</a>
</div>
</div>

<?php } else { ?>


    
    <a href="#myModal" data-toggle="modal" data-target="#loginModal">login</a>

<?php } ?>

</nav>
<div id="menu-btn" class="fas fa-bars"></div>
</header>
<!-- header section ends -->
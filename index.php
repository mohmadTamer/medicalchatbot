<?php

include 'ini.php';
include $tmplt."header.php";
require_once ('includes/functions/controller.Class.php');
require_once('machine-learning.php');



$Controller = new Controller;
        $db = new Connect;
        $user = $db -> prepare('SELECT * FROM users where id= ?');
        $user -> execute(array($_COOKIE['id']));
        $userInfo = $user -> fetch(PDO::FETCH_ASSOC);

    $stmt = $db->prepare("SELECT h_text1 , h_text2  FROM home_page");

    // Execute The Statement
    $stmt->execute();
    // Assign To Variable 
    $home = $stmt->fetchAll();

    foreach($home as $home){

    
    
?>
    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="image" >
            <img src="layout/images/pr logo v2.png" width="150px"  alt="">
            <div class="content home_t">
            <h3><?php echo $home['h_text1'] ?></h3>
            <p class="h_text2"><?php echo $home['h_text2'] ?></p>
        </div>
        </div>



    </section>

    <!-- home section ends -->
<?php
    $stmt = $db->prepare("SELECT count(*) as total from doctors");
    // Execute The Statement
    $stmt->execute();
    // Assign To Variable 
    $doc_total_number = $stmt->fetchColumn();

    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    // Assign To Variable 
    $users = $stmt->fetchAll();
    $users_total_number = $stmt ->rowCount();

    $stmt = $db->prepare("SELECT count(*) as total from campaign");
    $stmt->execute();
    // Assign To Variable 
    $camp_total_number = $stmt ->fetchColumn();

    $stmt = $db->prepare("SELECT count(*) as total from blogs");
    $stmt->execute();
    // Assign To Variable 
    $blogs_total_number = $stmt ->fetchColumn();

?>

    <!-- icons section starts  -->

    <section class="icons-container">

        <div class="icons">
            <i class="fas fa-user-md"></i>
            <h3><?php echo $doc_total_number; ?>+</h3>
            <p>doctors at work</p>
        </div>

        <div class="icons">
            <i class="fas fa-users"></i>
            <h3><?php echo $users_total_number; ?>+</h3>
            <p>satisfied patients</p>
        </div>

        <div class="icons">
        <i class="fas fa-calendar-plus"></i>
            <h3><?php echo $camp_total_number; ?>+</h3>
            <p>future campaign</p>
        </div>

        <div class="icons">
            <i class="fab fa-blogger"></i>
            <h3><?php echo $blogs_total_number; ?>+</h3>
            <p>available blogs</p>
        </div>

    </section>

    <!-- icons section ends -->

    <?php }
            ?>

<!-- campagin section starts  -->

    <section class="services" id="services">
        <h1 class="heading">campaign</h1>
        <div class="box-container">

        <?php 
        $stmt = $db->prepare("SELECT* FROM campaign");

        // Execute The Statement
        $stmt->execute();
        // Assign To Variable 
        $camp = $stmt->fetchAll();

?>
        <div id="demo" class="carousel slide container-fluid" data-ride="carousel" >


        <!-- Indicators -->
        <ul class="carousel-indicators">
<?php    
$x=0;
foreach($camp as $camp){


    if($x==0){
    ?>
            <li data-target="#demo" data-slide-to="<?php echo $x ?>" class="active"></li>
<?php }else{ ?>
                <li data-target="#demo" data-slide-to="<?php echo $x ?>" class=""></li>
<?php 
}
$x++;
} ?>

        </ul>        

<!-- The slideshow -->
        <div class=" carousel-inner" >
            <?php
$i=0;

// Execute The Statement
$stmt->execute();
// Assign To Variable 
$campaign = $stmt->fetchAll();
foreach($campaign as $campaign){

if($i==0){
    ?>
    <div class='carousel-item active'>
<?php }
    else{

?> 
    <div class='carousel-item '>
<?php    }
    $i++;

?>

            <a href="<?php echo $campaign['c_link'] ?>"><img src="admin/design/images/<?php echo $campaign['c_pic'] ?>" 
            alt="campaign" style="width:100%;height:400px"></a>
            <div class="carousel-caption">
                <h1 style=""><?php echo $camp['c_name'] ?></h1>
                <h3><?php echo $camp['c_desc'] ?></h3>
            </div>
            </div>
            <?php } ?>
        </div>

<!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
        
        </div>



        </div>

    </section>

    <!-- campagin section ends -->

    <!-- about section starts  -->
<?php 
$stmt = $db->prepare("SELECT`about_text1`,
                            `about_text2`
                        FROM `about_the_owner`");

// Execute The Statement
$stmt->execute();
// Assign To Variable 
$about = $stmt->fetchAll();
foreach($about as $about){

?>
<section class="about" id="about">

        <h1 class="heading"> <span>about</span> us </h1>

        <div class="row">



            <div class="content">
                <h3><?php echo $about['about_text1'] ?></h3>
                <p ><?php echo $about['about_text2'] ?>
                </p>
                <a href="#" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
            </div>

            <div class="image">
                <img src="layout/images/about-img.svg" alt="">
            </div>

        </div>

    </section>

    <!-- about section ends -->

    <!-- doctors section starts  -->
    
    <section class="doctors" id="doctors">

        <h1 class="heading"> our <span>doctors</span> </h1>

        <div class="box-container">

        <?php }
    
    $stmt = $db->prepare("SELECT * FROM doctors WHERE d_status='1' ORDER BY d_id ASC limit 6");

//    Execute The Statement
    $stmt->execute();
    // Assign To Variable 
    $docs = $stmt->fetchAll();
    foreach($docs as $docs){
    
    ?>

            <div class="box">
                <img src="admin/design/images/<?php echo $docs['d_pic'] ?>" alt="">
                <h3><?php echo $docs['d_name'] ?></h3>
                <span><?php echo $docs['d_spec'] ?></span><br>
                <?php 

if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){ ?>
                <span><?php echo $docs['d_location_link'] ?></span>
                <?php } ?>
                <div class="share">
                    <a href="<?php echo $docs['d_whtsapp_link'] ?>" class="fab fa-whatsapp"></a>
                    <a href="<?php echo $docs['d_vezeeta_link'] ?>" class="fab fa-vimeo-square"></a>
                </div>
            </div>
<?php } ?>

        </div>

    </section>

    <!-- doctors section ends -->

    <!-- blogs section starts  -->

    <section class="blogs" id="blogs">

        <h1 class="heading"> our <span>blogs</span> </h1>

        <div class="box-container">
        <?php 

$stmt = $db->prepare("SELECT b_title , b_desc, b_author, b_link, b_image FROM blogs 
ORDER BY b_id ASC limit 3");
    // Execute The Statement
    $stmt->execute();
    // Assign To Variable 
    $blogs = $stmt->fetchAll();
    foreach($blogs as $blogs){

?>
            <div class="box">
                <div class="image">
                    <img src="admin/design/images/<?php echo $blogs['b_image'] ?>" alt="">
                </div>
                <div class="content">
                    <div class="icon">
                        <a href="#blogs"> <i class="fas fa-user"></i> by <?php echo $blogs['b_author'] ?> </a>
                    </div>
                    <h3><?php echo $blogs['b_title'] ?></h3>
                    <p><?php echo $blogs['b_desc'] ?></p>
                    <a href="#" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
                </div>
            </div>

            <?php }?>

        </div>
        <a href="#" class="btn"> see more <span class="fas fa-chevron-right"></span> </a>
                </div>
    </section>
    <!-- blogs section ends -->






    <!-- chat window html section start -->
    <button class="chat-btn">
        <i class="material-icons"> comment </i>
    </button>
    <section class="chatbot" style="background-color: #eee;">
        <div class="chat-popup">
            <div class="chat-area">
        <div class="card " id="chat2">
        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h1 class="mb-0">medical bot</h1>
            <div style="width:40px; height: 40px; background-color: #F5FCFF;
            border-radius: 50%; border: 2px solid #e84118;  padding: 2px">
            <img src="layout/images/Asset 1@5x.png"
                class="img-fluid rounded-circle" alt="">
            </div>
        </div>
        </div>

<!-- bot msg -->
        <div class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative; ">
            <div class="d-flex flex-row justify-content-start">
                <img src="layout/images/Asset 1@5x.png"
                alt="bot" style="width: 15%; height: 100%; border-radius: 50%; border: 0.5px solid #e84118;">
            <div>
                <h2 class=" large p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">
                <?php if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])) {?>
                <span class="msg"> Hi, <?php echo $userInfo["f_name"] ?> How can I help you?</span>
                <?php }else{  ?> <span class="msg"> Hi How can I help you?</span> <?php  }?>
            </h2>
                <p><?php date_default_timezone_set("Africa/Cairo");echo date("h:i"); ?></p>
            </div>
        </div>
        </div>
        </div>
<!-- user input part -->
        <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
            <input id="chat_msg" type="text" class="form-control form-control-lg" 
            name="user_msg" placeholder="Type message">
            <button class="btn-lg" id="emoji-btn"> &#127773;</button>
            <input onclick="sendmsg()" value="send" id="send"
            class="btn-lg btn-success chatbtn material-icons " name="">
        </div>

        </div>

</div>
</section>




    <!-- chat window section ends -->



<?php
    
include "includes/templates/footer.php";

?>

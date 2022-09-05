<?php
include 'ini.php';
include $tmplt."header.php";
require_once ('includes/functions/controller.Class.php');
$Controller = new Controller;
        $db = new Connect;
        $user = $db -> prepare('SELECT * FROM users where id= ?');
        $user -> execute(array($_COOKIE['id']));
        $userInfo = $user -> fetch(PDO::FETCH_ASSOC);

?>

    <!-- chat window html section start -->
    <section class="chatbot">
        <div class=container4>
        <button class="chat-btn">
            <i class="material-icons"> comment </i>
        </button>
        
        <form action="" method="POST">
        <div class="chat-popup">

        <div class="chat-area">

            <div class="income-msg">

                <img src="image/500-5002858_chatbot-icon-chatbot-icon-transparent-background-hd-png.png" 
                    class="avatar" alt="">
                    <span class="msg" name="bot_msg"> Hi, How can I help you?</span>
                </div>
            </div>

            <div class="input-area">
                <input type="text">
                <button id="emoji-btn"> &#127773;</button>
                <button class="submit" name="send-msg"> <i class="material-icons"> send</i></button>
            </div>
        </div>
        </form>
    </div>
    </section>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['send-msg'])){
    $dst_fname =  getcwd() . '/skin-images/' . time() . uniqid(rand()) . '.' . $extension;
    $dst_fname = str_replace('\\', '/', $dst_fname);

    // $result = classify_image($dst_fname);
} else {
    header("Location: index.php");
    exit();
}
}   
?>

    <!-- chat window section ends -->

        <!-- login section starts  -->

        <section>


<!-- i want to make fade in here -->

<div class="modal " id="loginModal" tabindex="-1">

    <div class="modal-content" style="background: #D3E7EE">


        <section class="h-auto">

            <div class="container  py-5 h-auto">

                <div class="row d-flex align-items-center  justify-content-center h-100">

                    <!-- image of login form -->
                    <div class="col-md-8 col-lg-7 col-xl-6">

                        <img src="layout/images/draw2.svg"
                            class="img-fluid" style="height: 400px;" alt="Phone image">

                    </div>


                    <!-- login form -->
                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        <h1 class="close-div heading"> <span>Login</span> </h1>


                        <form>
                            <!-- Email input -->

                            <div class="form-outline mb-4">
                                <input type="email" placeholder="your email"
                                    class="box form-control form-control-lg">
                            </div>

                            <!-- Password input -->

                            <div class="form-outline mb-4">
                                <input type="password" placeholder="*******"
                                    class=" box form-control form-control-lg">
                            </div>

                            <!-- forget password section -->
                            <div class="d-flex justify-content-around align-items-center mb-4">
                                <!-- Checkbox -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                                </div>

                                <!--create new page for password reset-->

                                <a href="#!">Forgot password?</a>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-lg btn-block">Sign in</button>

                            <div class="divider d-flex align-items-center my-4">
                                <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                            </div>

                            <!-- google button -->
                            <button onclick=" window.location = '<?php echo  $login_url ; ?> ' " 
                            type="button" class="btn btn-lg btn-block " 
                            style="background-color: #dd4b39;" >
                            <i class="fab fa-google me-2"></i> Login in with google</button>
                            
                            
                            
                        </form>

                    </div>

                </div>

            </div>

        </section>









    </div>
</div>
</section>

<!-- login section ends -->


<!-- footer section ends -->

<!-- custom js file link  -->

<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.1.1/dist/index.min.js"></script>
<script src="<?php echo $js; ?>jquery-3.5.1.min.js"></script>
<script src="<?php echo $js; ?>bootstrap.min.js"></script>
<script src="<?php echo $js; ?>script.js"></script>

</body>

</html>

    </section>

<?php

$stmt = $db->prepare("SELECT `about_text1`, `about_text2`, `phone_1`,
`phone_2`, `email`, `address`, `facebook`, `instagram` FROM `about_the_owner`");

// Execute The Statement
$stmt->execute();
// Assign To Variable 
$about = $stmt->fetchAll();
foreach($about as $about){


?>


    <!-- footer section starts  -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>quick links</h3>
                <a href="index.php#home"> <i class="fas fa-chevron-right"></i> home </a>
                <a href="index.php#services"> <i class="fas fa-chevron-right"></i> campaign </a>
                <a href="index.php#about"> <i class="fas fa-chevron-right"></i> about us </a>
                <a href="index.php#doctors"> <i class="fas fa-chevron-right"></i> doctors </a>
                <a href="index.php#blogs"> <i class="fas fa-chevron-right"></i> blogs </a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href=""> <i class="fas fa-phone"></i> <?php echo $about['phone_1'] ?> </a>
                <a href=""> <i class="fas fa-phone"></i> <?php echo $about['phone_2'] ?> </a>
                <a href=""> <i class="fas fa-envelope"></i> <?php echo $about['email'] ?> </a>
                <a href=""> <i class="fas fa-map-marker-alt"></i> <?php echo $about['address'] ?> </a>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="#<?php echo $about['facebook'] ?>"> <i class="fab fa-facebook-f"></i> facebook </a>
                <!-- <a href="#"> <i class="fab fa-twitter"></i> twitter </a> -->
                <a href="#<?php echo $about['instagram'] ?>"> <i class="fab fa-instagram"></i> instagram </a>
                <!-- <a href="#"> <i class="fab fa-pinterest"></i> pinterest </a> -->
            </div>

        </div>

        <div class="credit"> created by <span>mr.mhmd</span> | all rights reserved © 2022</div>

    </section>
    <?php }?>
    <!-- login section starts  -->

    <section>


        <!--  -->

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.1.1/dist/index.min.js"></script>
    <script src="<?php echo $js; ?>jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo $js; ?>bootstrap.min.js"></script>
    <script src="<?php echo $js; ?>script.js"></script>
    


</body>

</html>
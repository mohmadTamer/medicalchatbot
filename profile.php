<?php
include "ini.php";
require_once ('includes/functions/controller.Class.php');
include $tmplt."header.php";

// check if user logged or not by calling //// checkUserStatus function
if ( isset ( $_GET ['code'] ) ) {
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
}


elseif(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){
    $Controller = new Controller;
    if($Controller -> checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])){
        $db = new Connect;
        $user = $db -> prepare('SELECT * FROM users where id= ?');
        $user -> execute(array($_COOKIE['id']));
        

        while($userInfo = $user -> fetch(PDO::FETCH_ASSOC)){ 

            ?>
<!--  start html code for profile page from print function -->

<section class="home" id="profile">
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" 
                    src="<?php echo $userInfo["avatar"] ?>">
                    <span class="font-weight-bold" style="font-size: 25px;">
                    <?php echo $userInfo["f_name"] ?> </span>
                </div>
            </div>

<!--  -->
<!-- update user form begain -->
<!--  -->
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Info</h4>
                    </div>

                    <form action="?do=update" method="POST">
                        <div class="row mt-2">

                            <div class="col-md-6">
                                <label class="labels">First Name</label>
                                <input type="hidden" name="old_fname" 
                                value="<?php echo $userInfo["f_name"] ?>">
                                <input type="text" class="form-control" 
                                placeholder="<?php echo $userInfo["f_name"]?>" name="fname">
                            </div>

                            <div class="col-md-6">
                                <label class="labels">Family Name</label>
                                <input type="hidden" name="old_lname" 
                                value="<?php echo $userInfo["l_name"] ?>">
                                <input type="text" class="form-control" name="lname" 
                                placeholder="<?php echo $userInfo["l_name"]?> ">
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Email ID</label><br>
                                <label class="labels"><?php echo $userInfo["email"] ?></label>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                            <label class="labels">Your Location <span id="location"></span></label><br>
                            <label class="labels">Toukh, Qalubia</label>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Change password</label>
                                <input type="hidden" name="oldpassword" value="
                                <?php echo $userInfo["password"] ?>">
                                <input type="password" class="form-control" 
                                placeholder="********" name="password1">
                            </div>

                            <div class="col-md-6">
                                <label class="labels">Confirm password</label>
                                <input type="password" class="form-control" 
                                name="password2" placeholder="********">
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <input type= "submit" class="btn profile-button" 
                            value="save profile" type="button">
                        </div>
                    </form>
<!--  -->
<!-- update user form END -->
<!--  -->

<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $formErrors = array();
        $id = $userInfo['id'];
		$f_name = "";
        $l_name = "";
		$pass1 	= $_POST['password1'];
        $pass2 	= $_POST['password2'];
        $pass="";

// check if user enter the first name or not
    if( empty ( $_POST [ 'fname' ] ) ){
        $f_name =$_POST['old_fname'];
    }elseif (isset($_POST [ 'fname' ]) ) {
        $filterdfname = filter_var($_POST [ 'fname' ], FILTER_SANITIZE_STRING);
        $filterdfname=  str_replace(' ', '', $filterdfname);
        if (strlen($filterdfname) > 20 || strlen($filterdfname) < 3) {
            $formErrors[] = 'First name Must Be In Range Between 3 to 20 Charactare';
        }elseif(is_numeric($filterdfname)){
            $formErrors[] = 'Your name cant be number';
        }else{ $f_name = $_POST['fname'];}
        
    }

// check if user enter the last name or not
    if( empty ( $_POST [ 'lname' ] ) ){
        $l_name =$_POST['old_lname'];
    }elseif (isset($_POST [ 'lname' ]) ) {
        $filterdlname = filter_var($_POST [ 'lname' ], FILTER_SANITIZE_STRING);
        $filterdlname=  str_replace(' ', '', $filterdlname);
        if ( strlen($filterdlname) > 20 || strlen($filterdlname) < 3 ) {
            $formErrors[] = 'last name Must Be In Range Between 3 to 20 Charactare';
        }elseif(is_numeric($filterdlname)){
            $formErrors[] = 'You name cant be number';
        }
        else{ $l_name = $_POST['lname'];}
    }

//check if user change pass or not
        if(empty($_POST['password1'])){
            $pass=md5($_POST['oldpassword']);
        }elseif (isset($pass1) && isset($pass2)) {
            if (($pass1) !== ($pass2)) {
                $formErrors[] = "Password doesn't Match";
            }else{
                $pass=md5($_POST['password1']);
            }
        }

// print errors if it exist
    foreach($formErrors as $error) {
        echo '<div class=" mt-3 alert alert-danger">' . $error . '</div>';
        }

// Check If There's No Error Proceed The Update Operation
        if (empty($formErrors)) {
//update user data Query
        $stmt = $con->prepare("UPDATE users SET f_name = ?, l_name = ?,  Password = ? WHERE id = ?");        
        $stmt->execute(array($f_name, $l_name, $pass, $id));
        if($stmt->rowCount()>0){
            echo ' <div class= "mt-3 alert alert-success"> Yout profile Informations updated </div> ';
            // header("refresh:3; url=http://localhost/medcare/profile.php");
        }

    }

}

?>

</div>
</div>
</div>
</div>
</section>


<?php } 
include "includes/templates/footer.php";

}

// end of html code for profile page

else
header('Location: index.php');
exit();
}
// if user sign up for the first time
if(isset ($token["error"]) != "invalid_grant") {
    // get data from google
    $oAuth = new Google_Service_Oauth2($gClient);
    $userData = $oAuth->userinfo_v2_me->get();

    //insert data in the database
    $Controller = new Controller;

    echo $Controller -> insertData(
        array(
            'email' => $userData['email'],
            'avatar' => $userData['picture'],
            'picture' => $userData['picture'],
            'familyName' => $userData['familyName'],
            'givenName' => $userData['givenName']
        ));

    }else{
    header('Location: index.php');
    exit();

}

?>


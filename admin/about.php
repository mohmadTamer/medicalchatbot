<?php
session_start();

if (isset($_SESSION['Username'])) {
include 'ini.php';
?>

<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                About <small>Manage About Page</small>
                </h1>
            </div>
        </div>
    </div>
</header>

<section id="main">
    <div class="container">
    <div class="row">
    <div class="col-md-2">
    <div class="list-group">

    <a href="Users.php" class="list-group-item">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Users </a>
    <a href="home.php" class="list-group-item">
        <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home </a>
    <a href="about.php" class="list-group-item active main-color-bg">
        <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> About </a>
    <a href="doctors.php" class="list-group-item">
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Doctors </a>
    <a href="campaign.php" class="list-group-item">
        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>Campaigns </a>
    <a href="blogs.php" class="list-group-item">
        <span class="glyphicon glyphicon-book" aria-hidden="true"></span>Blogs </a>
    </div>
</div>

<div class="col-md-10">
<!-- Website Overview-->
<div class="panel panel-default">
<div class="panel-heading main-color-bg">
<h3 class="panel-title">About</h3>
</div>

<div class="panel-body">

<table class="table table-striped table-hover">
    <tr>
        <th>id</th>
        <th>text1</th>
        <th>text2</th>
        <th>phone1</th>
        <th>phone2</th>
        <th>email</th>
        <th>address</th>
        <th>update</th>
    </tr>

    <?php
$do = isset($_GET['do']) ? $_GET['do'] : '';
if ($do == '') {
    $stmt = $con->prepare("SELECT *FROM about_the_owner");
    // Execute The Statement
    $stmt->execute();
    // Assign To Variable 
    $about = $stmt->fetchAll();
    if (! empty($about)) {
    foreach($about as $about) {?>
    <tr>
    <td><?php echo $about['about_id'] ?></td>
    <td><?php echo $about['about_text1'] ?></td>
    <td><?php echo $about['about_text2'] ?></td>
    <td><?php echo $about['phone_1'] ?></td>
    <td><?php echo $about['phone_2'] ?></td>
    <td><?php echo $about['email'] ?></td>
    <td><?php echo $about['address'] ?></td>
    <td>
    <button type="button" class="btn btn-success" data-toggle="modal" 
    data-target="#exampleModalCenter">Update </button>

    </td>
</tr>
</table>

<?php
    }
} else {
    echo '<div class="container">';
    echo '<div class="nice-message">There\'s No Users To Show</div>';
    echo '</div>';
}
}  

?>
    <!--Update Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle"> Update About </h3>

            </div>

            <div class="modal-body">

            <form action="?do=update" method="POST">

        <div class="form-group">
            <input type="text" class="form-control" 
            name="headT1" placeholder="text1">
        </div>

        <div class="form-group">
            <input type="text" class="form-control" 
            name="headT2" placeholder="text2">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" 
            name="phone1" placeholder="phone1">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" 
            name="phone2" placeholder="phone2">
        </div>
        <div class="form-group">
            <input type="email" class="form-control"
            name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" 
            name="address" placeholder="Address">
        </div>
        <input type="submit" class="btn btn-primary btn-group-justified" value="Update">

    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>

</div>
</div>
</div>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $formErrors = array();
    $id = 1;
    $headT1 = '';
    $headT2 = '';
    $phone1 = '';
    $phone2 = '';
    $email = '';
    $address = '';

    if( empty ( $_POST [ 'headT1' ] ) ){
        $formErrors[] = "Head Text 1 can't be empty";
    }elseif (isset($_POST [ 'headT1' ]) ) 
    { $headT1 = $_POST['headT1'];}

    if( empty ( $_POST [ 'headT2' ] ) ){
        $formErrors[] = "Head Text 2 can't be empty";
    }elseif (isset($_POST [ 'headT2' ]) ) 
    { $headT2 = $_POST['headT2'];}

    if( empty ( $_POST [ 'phone1' ] ) ){
        $formErrors[] = "phone number can't be empty";
    }elseif (isset($_POST [ 'phone1' ]) ) 
    { $phone1 = $_POST['phone1'];}

    if( empty ( $_POST [ 'phone2' ] ) ){
        $formErrors[] = "phone number can't be empty";
    }elseif (isset($_POST [ 'phone2' ]) ) 
    { $phone2 = $_POST['phone2'];}

    if( empty ( $_POST [ 'email' ] ) ){
        $formErrors[] = "email can't be empty";
    }elseif (isset($_POST [ 'email' ]) ) 
    { $email = $_POST['email'];}

        if( empty ( $_POST [ 'address' ] ) ){
        $formErrors[] = "address can't be empty";
    }elseif (isset($_POST [ 'address' ]) ) 
    { $address = $_POST['address'];}

    foreach($formErrors as $error) {
        echo '<div class=" mt-3 alert alert-danger">' . $error . '</div>';
        }
    
        if (empty($formErrors)) {
            $stmt = $con->prepare(" UPDATE  about_the_owner 
                                    SET     about_text1 = ?, 
                                            about_text2 = ?,
                                            phone_1 = ?, 
                                            phone_2 = ?,
                                            email = ?, 
                                            address = ?
                                    WHERE about_id = ?");
            $stmt->execute(array($headT1, $headT2 ,$phone1,
            $phone2,$email,$address,$id));
            if($stmt->rowCount()>0){
                echo ' <div class= "mt-3 alert alert-success"> home page updated </div> ';}
        }
}
?>


</div>
</div>
</div>
</div>
</div>
</section>

<?php
include $dsin_folder . "footer.php";
}else{
    header('Location: login.php');
    exit();
}
?>
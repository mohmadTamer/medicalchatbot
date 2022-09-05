<?php
session_start();

if (isset($_SESSION['Username'])) {
include 'ini.php';


?>
<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1><span class="glyphicon glyphicon-wrench" aria-hidden="true">
                </span> Blogs <small>Manage Your Blogs</small>
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
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Users
                    </a>
                    <a href="home.php" class="list-group-item">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home </a>
                    <a href="about.php" class="list-group-item">
                        <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> About </a>
                    <a href="doctors.php" class="list-group-item">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Doctors </a>
                    <a href="campaign.php" class="list-group-item">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Campaigns </a>
                    <a href="blogs.php" class="list-group-item active main-color-bg">
                        <span class="glyphicon glyphicon-book" aria-hidden="true"></span> Blogs </a>
                </div>
            </div>
            <div class="col-md-10">
                <!-- blogs table-->
                <div class="panel panel-default">
                    <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Blogs</h3>
                    </div>

<!-- Add new  blog btn -->
                    <button id="addbtn" type="button" class="btn btn-primary btn-lg"
                    data-toggle="modal" data-target="#AddNewCampaign"> Add
                    </button>

<!-- Start Add blog Modal -->

                    <div class="modal fade" id="AddNewCampaign" tabindex="-1" 
                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLongTitle">Add Blog</h3>
                                </div>

                                <div class="modal-body">
<!-- Start Add form  -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" class="form-control" 
            id="formGroupExampleInput" placeholder="Title" name="b_title">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" 
            id="formGroupExampleInput" placeholder="Description" name="b_desc">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" 
            id="formGroupExampleInput" placeholder="Author" name="b_author">
        </div>
        <div class="input-group">
            <input type="file" class="form-control" 
            id="inputGroupFile02" name="bl_pic" required><br><br>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" 
            id="formGroupExampleInput" placeholder="Link" name="b_link">
        </div>
        <input type="submit" class="btn btn-primary btn-group-justified" 
        name="addBlog"value="Add">
    </form>

<!-- End Add form  -->


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-- Start Add Query code -->
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addBlog'])){
$formErrors = array();
$blog_title=""; $blog_desc=""; $blog_link=""; $blog_pic=""; $blog_author="";
$img_name = $_FILES['bl_pic']['name']; $img_type = $_FILES['bl_pic']['type'];
$img_temp = $_FILES['bl_pic']['tmp_name']; $img_size = $_FILES['bl_pic']['size'];
$blog_pic = rand(0,10000000).'_' .$img_name;
move_uploaded_file($img_temp,"design\images\\".$blog_pic);
$allowed_ext = array('jpg','gif','jpeg','phg','svg');
if( empty ( $_POST [ 'b_title' ] ) ){
    $formErrors[] = "blog Name can't be empty";
}elseif (isset($_POST [ 'b_title' ]) ) 
{ $blog_title= $_POST['b_title'];}
if( empty ( $_POST [ 'b_desc' ] ) ){
    $formErrors[] = "blog Description can't be empty";
}elseif (isset($_POST [ 'b_desc' ]) ) 
{ $blog_desc= $_POST['b_desc'];}
if( empty ( $_POST [ 'b_author' ] ) ){
    $formErrors[] = "blog must have Author";
}elseif (isset($_POST [ 'b_author' ]) ) 
{ $blog_author= $_POST['b_author'];}
if( empty ( $_POST [ 'b_link' ] ) ){
    $formErrors[] = "blog must have link";
}elseif (isset($_POST [ 'b_link' ]) ) 
{ $blog_link= $_POST['b_link'];}
foreach($formErrors as $error) {
    echo '<div class=" mt-3 alert alert-danger">' . $error . '</div>';
    }
    if (empty($formErrors)) {
        $stmt = $con->prepare (" INSERT INTO `blogs` ( `b_title`,
        `b_desc`, `b_author`, `b_link`, `b_image`) VALUES (?,?,?,?,?)");
$stmt->execute(array($blog_title , $blog_desc , $blog_author ,
$blog_link , $blog_pic ));

if($stmt->rowCount()>0){

echo ' <div class= "mt-3 alert alert-success"> Campaign Added Successfully </div> ';}

    }


}

?>


    <div class="panel-body">
        <table class="table table-striped table-hover">
            <tr>
                <th>id</th>
                <th>title</th>
                <th>description</th>
                <th>author</th>
                <th>link</th>
                <th>img</th>
                <th>Delete</th>
            </tr>

<?php
$blog_data = $con->prepare('SELECT * FROM blogs');
$blog_data->execute();
$blogs = $blog_data->fetchAll();

$i=0;
foreach($blogs as $blogs){
    $i++;


?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $blogs['b_title'] ?></td>
                <td><?php echo $blogs['b_desc'] ?></td>
                <td> <?php echo $blogs['b_author'] ?> </td>
                <td><a target="_blank" href="<?php echo $blogs['b_link'] ?>">link</a></td>
                <?php
                echo "<td> 
                <img width='100px;' src='design/images/" . $blogs['b_image'] . "' alt=''></td>
                <td>";
                ?>

                <button type="button" id="delbtn" class="btn btn-danger" 
                onclick = " get_blog_data(`<?php echo $blogs['b_id']; ?>`)"
                data-toggle="modal" data-target="#exampleModalCenter3">
                    Delete
                </button>

<!--Start Delete Modal -->
    <div class="modal fade" id="exampleModalCenter3" tabindex="-3" 
    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <form  action="" method="POST">

                <div class="modal-body">
                <input type="text" class="form-control" id="get_delete_blogId" name="b_id">
                    <h3>Are You Sure ?</h3>
                </div>
                <div class="modal-footer">
                <input type="submit" name="delete_blog" value="Yes" class="btn btn-danger" />
                <button type="button" class="btn btn-success" data-dismiss="modal"> No</button>
                </div>
                </form>

            </div>
            </div>
        </div>
    </div>
</td>
</tr>
<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_blog']) ){
    $id = $_POST [ 'b_id'];

$stmt = $con->prepare("DELETE FROM `blogs` WHERE `b_id` = ?");
$stmt->execute(array($id));

if($stmt->rowCount()>0){
    echo ' <div class= "mt-3 alert alert-danger"> blog Deleted Successfully </div> ';
}else{
    echo "failed";
    }

}



} 
?>

                        </table>
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

<script>

function get_blog_data(delete_id)
{
let get_delete_id = document.getElementById('get_delete_blogId');

get_delete_id.value = delete_id;
    

}


</script>
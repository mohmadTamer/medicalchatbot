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
                </span> Campaign <small>Manage Your Campaign</small>
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
                    <a href="campaign.php" class="list-group-item active main-color-bg">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Campaign </a>
                    <a href="blogs.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book" aria-hidden="true"></span> Blogs </a>
                </div>
            </div>
            <div class="col-md-10">
                <!-- Campaigns table -->
                <div class="panel panel-default">
                    <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Campaigns</h3>
                    </div>


<!-- Add new  Campaign btn -->
                    <button id="addbtn" type="button" class="btn btn-primary btn-lg" 
                    data-toggle="modal" data-target="#AddNewCampaign"> Add
                    </button>

<!-- Start Add new  Campaign Modal -->
                    <div class="modal fade" id="AddNewCampaign" tabindex="-1" role="dialog" 
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLongTitle">Add Campaign</h3>
                                </div>
                                <div class="modal-body">

<!-- Start Add form  -->

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Campagin Name</label>
            <input type="text" class="form-control" 
            id="formGroupExampleInput" placeholder="Name" name="camp_name">
        </div>
        <div class="form-group">
            <label>Campagin Description</label>
            <input type="text" class="form-control" 
            id="formGroupExampleInput" placeholder="Description" name="camp_desc">
        </div>
        <div class="form-group">
            <label>Campagin Link</label>
            <input type="text" class="form-control" 
            id="formGroupExampleInput" placeholder="Campaign Link" name="camp_link">
        </div>
        <div class="input-group">
            <label>Campagin Image </label>
            <input type="file" class="form-control"
            id="inputGroupFile02" name="campaign_pic" required><br><br>
        </div>
        <div class="form-group">
            <label>Start date</label>
            <input type="date" class="form-control" 
            id="formGroupExampleInput" placeholder="Start Date" name="camp_s_date">
        </div>
        <div class="form-group">
            <label>End date</label>
            <input type="date" class="form-control" 
            id="formGroupExampleInput" placeholder="End Date" name="camp_e_date">
        </div>
        <input type="submit" name="add_camp" class="btn btn-primary btn-group-justified" value="Add">
    </form>

    <!-- End Add form  -->

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<!-- Start Add New Campaign Query code -->
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_camp'])){
$formErrors = array();
$camp_name="";
$camp_desc="";
$camp_link="";
$camp_pic="";
$camp_strt_date="";
$camp_end_date="";
$img_name = $_FILES['campaign_pic']['name'];
$img_type = $_FILES['campaign_pic']['type'];
$img_temp = $_FILES['campaign_pic']['tmp_name'];
$img_size = $_FILES['campaign_pic']['size'];


$camp_pic = rand(0,10000000).'_' .$img_name;
move_uploaded_file($img_temp,"design\images\\".$camp_pic);

$allowed_ext = array('jpg','gif','jpeg','phg','svg');


if( empty ( $_POST ['camp_name'] ) ){
    $formErrors[] = "Campgain Name can't be empty";
}elseif (isset($_POST [ 'camp_name' ]) ) { 
    $camp_name= $_POST['camp_name'];
}
if( empty ( $_POST [ 'camp_desc' ] ) ){
    $formErrors[] = "Campgain Description can't be empty";
}elseif (isset($_POST [ 'camp_desc' ]) ) 
{ $camp_desc= $_POST['camp_desc'];}

if( empty ( $_POST [ 'camp_link' ] ) ){
    $formErrors[] = "Campgain link can't be empty";
}elseif (isset($_POST [ 'camp_link' ]) ) 
{ $camp_link= $_POST['camp_link'];}

if (isset($_POST [ 'campaign_pic' ]) )
{
    if( ! in_array($avatarExtension, $allowed_ext) ){
        $formErrors[] = "File isn't valid";

    }elseif($img_size > 4194304){
        $formErrors[] = " File is too large (Max 4MB)";

    }else{
    }
}

if( empty ( $_POST [ 'camp_s_date' ] ) ){
    $formErrors[] = "Campgain must have start date ";
}elseif (isset($_POST [ 'camp_s_date' ]) ){ 
    $todayDate = date('Y-m-d');
    $todayDate=date('Y-m-d', strtotime($todayDate));
    $sdate=$_POST['camp_s_date'];
    $sdate = date('Y-m-d', strtotime($sdate));
    if($sdate<$todayDate){
        $formErrors[] = "Campaign must have start date at least begain from today ";
    }else{
    $camp_strt_date= $_POST['camp_s_date'];}
    }
if( empty ( $_POST [ 'camp_e_date' ] ) ){
    $formErrors[] = "Campgain Must have End Date";
}elseif (isset($_POST [ 'camp_e_date' ]) ) 
{
    $edate=$_POST['camp_e_date'];
    $edate = date('Y-m-d', strtotime($edate));
    $sdate=$_POST['camp_s_date'];
    $sdate = date('Y-m-d', strtotime($sdate));
    if($edate<$sdate){
        $formErrors[] = "Campaign must have End date after Start date ";
    }
    else{
    $camp_end_date= $_POST['camp_e_date'];}
    }
foreach($formErrors as $error) {
    echo '<div class=" mt-3 alert alert-danger">' . $error . '</div>';
    }

    if (empty($formErrors)) {
    $stmt = $con->prepare (" INSERT INTO `campaign`(`c_name`, `c_desc`, `c_link` , `c_pic`, 
                                                    `c_start_date`, `c_end_date`)
                                VALUES (?,?,?,?,?,?)");

        $stmt->execute(array($camp_name , $camp_desc , $camp_link ,
        $camp_pic , $camp_strt_date , $camp_end_date ));

    if($stmt->rowCount()>0){

    echo ' <div class= "mt-3 alert alert-success"> Campaign Added Successfully </div> ';

}
    else{
        echo "failed";
    }
}
}
//select campaign data to view 
$camp_data = $con->prepare('SELECT * FROM campaign');
$camp_data->execute();
$campaign = $camp_data->fetchAll();

?>

<div class="panel-body">
    <table class="table table-striped table-hover">
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>description</th>
            <th>link</th>
            <th>img</th>
            <th>start date</th>
            <th>end date</th>
            <th>Delete</th>
        </tr>

        <?php
$i=0;
foreach($campaign as $campaign){
    $i++
?>

        <tr>
        <td><?php echo $i ?></td>
            <td><?php echo $campaign['c_name'] ?></td>
            <td><?php echo $campaign['c_desc'] ?></td>
            <td><a target="_blank" href="<?php echo $campaign['c_link'] ?>">link</a></td>
            <td><img class="rounded-circle mt-5" width="70px"src="design/images/<?php echo $campaign['c_pic'] ?>" alt=""></td>
            <td><?php $e_date=$campaign['c_start_date'];
            $newDate = date("d/M/y", strtotime($e_date));
            echo $newDate  ?></td>
            <td><?php $s_date=$campaign['c_end_date'];
            $newDate = date("d/M/y", strtotime($s_date));
            echo $newDate ?></td>
<!-- End view campaign data -->

        <td>
            <button type="button" class="btn btn-danger" data-toggle="modal" 
            onclick = " get_camp_data(`<?php echo $campaign['c_id']; ?>`)"
            data-target="#exampleModalCenter3"> Delete
        </button>
        

<!--Start Delete Modal -->
<div class="modal fade" id="exampleModalCenter3" tabindex="-3" 
role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

        <form  action="" method="POST">

            <div class="modal-body">
            <input type="hidden" class="form-control" id="get_delete_id" name="camp_id">
                <h3>Are You Sure ?</h3>
            </div>
            <div class="modal-footer">
                <input type="submit" name="delete_campaign" value="Yes" class="btn btn-danger" />
                <button type="button" class="btn btn-success" data-dismiss="modal"> No</button>
            </div>
            </form>

        </div>
    </div>
</div>
</td>
</tr>
<?php 
// // start Delete campaign data query code
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_campaign']) ){
    $id = $_POST [ 'camp_id'];
    $stmt = $con->prepare("DELETE FROM `campaign` WHERE `c_id` = ?");
    $stmt->execute(array($id));
    if($stmt->rowCount()>0){
        echo ' <div class= "mt-3 alert alert-danger"> campaign Data Deleted </div> ';
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
function get_camp_data(delete_id)
{
let get_delete_id = document.getElementById('get_delete_id');

get_delete_id.value = delete_id;



}
</script>
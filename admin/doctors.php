<?php
session_start();

if (isset($_SESSION['Username'])) {
include 'ini.php';


?>
<header id="header">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1><span class="glyphicon glyphicon-user" aria-hidden="true">
        </span> Doctors <small>Manage Your Doctors</small>
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
          <a href="doctors.php" class="list-group-item active main-color-bg">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Doctors </a>
          <a href="campaign.php" class="list-group-item">
            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Campaigns 
            <span class="badge"></span></a>
          <a href="blogs.php" class="list-group-item">
            <span class="glyphicon glyphicon-book" aria-hidden="true"></span> Blogs 
            <span class="badge"></span></a>
        </div>
      </div>
      <div class="col-md-10">
        <!-- Website Overview-->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Doctors</h3>
          </div>
<!-- add new doc button -->

<button id="addbtn" type="button" class="btn btn-primary btn-lg" 
  data-toggle="modal" data-target="#exampleModalCenter">
    Add
</button>

  <!-- add new doctor Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" 
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myform">Add Doctor</h3>
        </div>
        <div class="modal-body">

<!-- Start Add form  -->

          <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">

            <input type="text" class="form-control" name="d_name"
              id="formGroupExampleInput" placeholder="Name">
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="d_spec"
              id="formGroupExampleInput" placeholder="specialtization">
            </div>

            <div class="input-group">
              <input type="file" class="form-control" name="d_pic"
              id="inputGroupFile02" placeholder="Uplaod picture">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="whts_link"
              id="formGroupExampleInput" placeholder="whatsApp Link">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="vez_link"
              id="formGroupExampleInput" placeholder="Vezeeta Link">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="location_link"
              id="formGroupExampleInput" placeholder="location Link">
            </div>

            <input type="submit" name="add" class="btn btn-primary btn-group-justified" value="add">
          </form>

<!-- End Add Form -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<!-- Start Add Query code -->
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])){
  $formErrors = array();
  $docName = '';
  $docSpec = '';
  $docImg = '';
  $whts_link = '';
  $veze_link = '';
  $location_link = '';


$img_name = $_FILES['d_pic']['name'];
$img_type = $_FILES['d_pic']['type'];
$img_temp = $_FILES['d_pic']['tmp_name'];
$img_size = $_FILES['d_pic']['size'];

$docImg = rand(0,10000000).'_' .$img_name;
move_uploaded_file($img_temp,"design\images\\".$docImg);

$allowed_ext = array('jpg','gif','jpeg','phg','svg');

  if( empty ( $_POST [ 'd_name' ] ) ){
      $formErrors[] = "Doctor Name can't be empty";
  }elseif (isset($_POST [ 'd_name' ]) ) 
  { $docName = $_POST['d_name'];}

  if( empty ( $_POST [ 'd_spec' ] ) ){
      $formErrors[] = "Doctor specialization can't be empty";
  }elseif (isset($_POST [ 'd_spec' ]) ) 
  { $docSpec = $_POST['d_spec'];}

  if( empty ( $_POST [ 'whts_link' ] ) ){
      $formErrors[] = "Please Add Doctor WhatsApp Number";
  }elseif (isset($_POST [ 'whts_link' ]) )
  { $whts_link = $_POST['whts_link'];}

  if( empty ( $_POST [ 'vez_link' ] ) ){
      $formErrors[] = "Please Add Doctor Profile link on Vezeeta";
  }elseif (isset($_POST [ 'vez_link' ]) )
  { $veze_link = $_POST['vez_link'];}

  if( empty ( $_POST [ 'location_link' ] ) ){
      $formErrors[] = "Please Add The Doctor Location";
  }elseif (isset($_POST [ 'location_link' ]) )
  { $location_link = $_POST['location_link'];}

  foreach($formErrors as $error) {
      echo '<div class=" mt-3 alert alert-danger">' . $error . '</div>';
      }

      if (empty($formErrors)) {
        $stmt = $con->prepare (" INSERT INTO `doctors` ( `d_name`, `d_spec`, `d_pic` , `d_whtsapp_link`, 
                                                        `d_vezeeta_link`, `d_location_link`)
                                  VALUES (?,?,?,?,?,?)");

          $stmt->execute(array($docName , $docSpec , $docImg ,
          $whts_link , $veze_link , $location_link  ));

    if($stmt->rowCount()>0){
      echo ' <div class= "mt-3 alert alert-success"> Doctor Added Successfully </div> ';}
    }
  }
// end Add Query code
//select doctor data to view 
$doctors = $con->prepare('SELECT * FROM doctors');
$doctors->execute();
$doctors_data = $doctors->fetchAll();
?>
<!-- start view doctor data -->
<div class="panel-body">
  <table class="table table-striped table-hover">
    <tr>
      <th>id</th>
      <th>Name</th>
      <th>Specification</th>
      <th>Img</th>
      <th>WhatsApp</th>
      <th>Vezeeta</th>
      <th>Location</th>
      <th>Status</th>
      <th>Update</th>
      <th>Delete</th>
    </tr>

<?php
$i=0;
  foreach($doctors_data as $doctor_data){
    $i++
?>
<tr>
  <td><?php echo $i ?></td>
  <td><?php echo $doctor_data['d_name'] ?></td>
  <td><?php echo $doctor_data['d_spec'] ?></td>
  <td><img class="rounded-circle mt-5" width="70px"src="design/images/<?php echo $doctor_data['d_pic'] ?>" alt=""></td>
  <td><a target="_blank" href="<?php echo $doctor_data['d_whtsapp_link'] ?>">WhatsApp</a></td>
  <td><a target="_blank" href="<?php echo $doctor_data['d_vezeeta_link'] ?>">Vezeeta</a></td>
  <td><?php echo $doctor_data['d_location_link'] ?></td>

<!-- start check if doctor is active or not -->
<?php
  if($doctor_data['d_status']==1){?>
  <td>  
    <div class="form-check">
      <input class="form-check-input" type="radio" 
      name="<?php echo $doctor_data['d_id'] ?>" 
      id="<?php echo $doctor_data['d_id'] ?>" checked>
      <label class="form-check-label" for="flexRadioDefault1">Active</label>
    </div>
    <!-- deactive -->
    <div class="form-check">
      <input class="form-check-input" type="radio" 
      name="<?php echo $doctor_data['d_id'] ?>" 
      id="<?php echo $doctor_data['d_id'] ?>">
      <label class="form-check-label" for="flexRadioDefault2">Not Active</label>
    </div>
  </td>
<?php
  }elseif($doctor_data['d_status']==0){ ?>
  <td>  
  <div class="form-check">
    <input class="form-check-input" type="radio" 
    name="<?php echo $doctor_data['d_id'] ?>" 
    id="<?php echo $doctor_data['d_id'] ?>" >
    <label class="form-check-label" for="flexRadioDefault1">Active</label>
  </div>
  <!-- deactive -->
  <div class="form-check">
    <input class="form-check-input" type="radio" 
    name="<?php echo $doctor_data['d_id'] ?>" 
    id="<?php echo $doctor_data['d_id'] ?>" checked>
    <label class="form-check-label" for="flexRadioDefault2">Not Active</label>
  </div>
</td>
<?php } ?>
<!-- End check if doctor is active or not -->
<!-- End view doctor data -->

<!-- Start Get doctor data to be updated   -->
  <td>
  <button id="updbtn" type="button" class="btn btn-success" onclick="get_data(
    `<?php echo $doctor_data['d_id'] ?>`,
    `<?php echo $doctor_data['d_name']?>`,
    `<?php echo $doctor_data['d_spec']?>`,
    `<?php echo base64_encode( $doctor_data['d_pic']) ?>`,
    `<?php echo $doctor_data['d_whtsapp_link'] ?>`,
    `<?php echo $doctor_data['d_vezeeta_link'] ?>`,
    `<?php echo $doctor_data['d_location_link'] ?>`,
    `<?php echo $doctor_data['d_status'] ?>`,)" 
    data-toggle="modal" data-target="#exampleModalCenter2">Update
  </button>
  </td>

  <?php  ?>
<!-- End Get doctor data to be updated   -->

<!-- Start update Modal for doctor -->
  <div class="modal fade" id="exampleModalCenter2" tabindex="-2" 
  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLongTitle2">Update Doctors</h3>
        </div>
        <div class="modal-body">
<!-- Start UPDATE Form -->

        <form  action="" method="POST">
          <div class="form-group">
            <!-- <input type="hidden" name="form2submission" value="yes" > -->
            <input type="hidden" class="form-control"
            id="get_id" name="doc_id">
            <label>Doctor Name </label>
            <input type="text" class="form-control" 
            id="doctor_name" name="doc_name" >
            </div>
            <div class="form-group">
            <label>Doctor Specialty </label>
              <input type="text" class="form-control"
              id="specify" name="doc_spec">
            </div>
            <div class="input-group">
            <label>Doctor Image </label>
              <input type="file" class="form-control"
              id="doctor_img" name="doc_pic"><br><br>
            </div>
            <div class="form-group">
            <label>WhatsApp Number </label>
              <input type="text" class="form-control" 
              id="whatsapp_link" name="doc_whts_link">
            </div>
            <div class="form-group">
            <label>Vezeeta Link</label>
              <input type="text" class="form-control" 
              id="vezeeta_link" name="doc_vez_link">
            </div>
            <div class="form-group">
            <label>Doctor Location</label>
              <input type="text" class="form-control"
              id="location" name="doc_loca_link">
            </div>
            <div class="form-group">
            <label>Status</label>
              <input type="number" max=1 min=0 class="form-control"
              id="doctor_status" name="doc_status">
            </div>
            <input type="submit" name="update" class="btn btn-success btn-group-justified" />
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" 
          data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

<?php


// start update doctor data query code
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update']) ){
    $id = $_POST [ 'doc_id'];
    $docName =  $_POST ['doc_name'];
    $docSpec = $_POST ['doc_spec'];
    $docImg = $_POST ['doc_pic'];
    $whts_link = $_POST ['doc_whts_link'];
    $veze_link = $_POST ['doc_vez_link'];
    $location_link = $_POST ['doc_loca_link'];
    $doc_status=$_POST ["doc_status"];
    $stmt = $con->prepare(" UPDATE  doctors 
                            SET     d_name = ?,
                                    d_spec = ?,
                                    d_pic = ?, 
                                    d_whtsapp_link = ?,
                                    d_vezeeta_link = ?, 
                                    d_location_link = ?,
                                    d_status = ? 
                            WHERE d_id  = ?");
    $stmt->execute(array($docName, $docSpec ,$docImg,
    $whts_link,$veze_link,$location_link,$doc_status,$id));


if($stmt->rowCount()>0){
  echo ' <div class= "mt-3 alert alert-success"> Doctor Info updated </div> ';
}else{
  echo "failed";
  }
}

?>

  <!-- End update model -->

  <td>
    <!-- start Delete Doctor data from database -->
    <button type="button" class="btn btn-danger" data-toggle="modal" onclick= "get_data(`<?php echo $doctor_data['d_id'] ?>`)" 
      data-target="#exampleModalCenter3"> Delete </button>
    
    </td>
<!-- Delete Modal -->
  <div class="modal fade" id="exampleModalCenter3" tabindex="-3" 
  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

      <form  action="" method="POST">
          <div class="modal-body">
            <input type="text" class="form-control" id="get_d_id" name="doctor_id">
            <h3>Are you sure you want to delete doctor ?</h3>
          </div>
        <div class="modal-footer">
          <input type="submit" name="Delete" value="Yes" class="btn btn-danger" />
          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
        </div>
        </form>

      </div>
    </div>
  </div>








<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Delete']) ){
  $id = $_POST [ 'doctor_id'];

  $stmt = $con->prepare("DELETE FROM `doctors` WHERE `d_id` = ?");
  $stmt->execute(array($id));

  if($stmt->rowCount()>0){
    echo ' <div class= "mt-3 alert alert-danger"> Doctor Data Deleted </div> ';
  }else{
    echo "failed";
    }

}
}
?>
</td>
</tr>
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
  function get_data( update_id , name , specity_data , img , whts_link , 
  vez_link , locat , doc_status, delete_id)
  {
    let get_update_id = document.getElementById('get_id');
    let get_delete_id = document.getElementById('get_d_id');
    let doctor_name = document.getElementById('doctor_name');
    let specify = document.getElementById('specify');
    // let doctor_img = document.getElementById('doctor_img');
    let whatsapp_link = document.getElementById('whatsapp_link');
    let vezeeta_link = document.getElementById('vezeeta_link');
    let location = document.getElementById('location');
    let doctor_status = document.getElementById('doctor_status');

    get_update_id.value=update_id;
    get_delete_id.value = delete_id;
    doctor_name.value = name;
    specify.value = specity_data;
    // doctor_img.value = img;
    whatsapp_link.value = whts_link;
    vezeeta_link.value = vez_link;
    location.value = locat;
    doctor_status.value = doc_status;
  }

</script>
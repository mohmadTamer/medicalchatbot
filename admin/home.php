<?php
session_start();

if (isset($_SESSION['Username'])) {
include 'ini.php';



?>
<header id="header">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1><span class="glyphicon glyphicon-home" aria-hidden="true">
        </span> Home <small>Manage Your Home</small>
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
          <a href="home.php " class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home </a>
          <a href="about.php" class="list-group-item"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> About </a>
          <a href="doctors.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Doctors </a>
          <a href="campaign.php" class="list-group-item"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
            Campaigns </a>
          <a href="blogs.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>
            Blogs </a>
        </div>
      </div>
      <div class="col-md-10">
        <!-- Website Overview-->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Home</h3>
          </div>
          <div class="panel-body">
            <!-- Button trigger modal -->

      <table class="table table-striped table-hover">
        <tr>
          <th>head_id</th>
          <th>head_text1</th>
          <th>head_text2</th>
          <th>Update</th>
        </tr>
<?php
$do = isset($_GET['do']) ? $_GET['do'] : '';

if ($do == '') {


    $stmt = $con->prepare("SELECT *FROM home_page");

    // Execute The Statement

    $stmt->execute();


    // Assign To Variable 

    $home_page = $stmt->fetchAll();

    if (! empty($home_page)) {
      foreach($home_page as $home_page) {
        echo "<tr>";  
        echo "<td>" . $home_page['h_id'] . "</td>";      
        echo "<td>" . $home_page['h_text1'] . "</td>";
        echo "<td>" . $home_page['h_text2'] ."</td>";
        echo "<td>
        <a href='' id='updbtn' type='button' class='btn btn-success' 
        data-toggle='modal' data-target='#exampleModalCenter'>Update
        </a>
        </td>
        </tr>
      </table>";

    }
    } else {
      echo '<div class="container">';
      echo '<div class="nice-message">There\'s No Users To Show</div>';
      echo '</div>';
    
    }
  }  

?>

      <!-- update dialog -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="1" role="dialog" 
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="modal-header">

      <h3 class="modal-title" id="exampleModalLongTitle">Update Home</h3>



  </div>

  <div class="modal-body">
  <form action="?do=update" method="POST">

    <div class="form-group">
      <input type="text" class="form-control" 
        id="formGroupExampleInput" placeholder="add head_text1" name="headT1">
        <input type="hidden" name="old_headT1"
        value="<?php echo $home_page['h_text1'] ?>">
    </div>

    <div class="form-group">
      <input type="text" class="form-control"
      id="formGroupExampleInput" placeholder="add head_text2" name="headT2">
      <input type="hidden" name="old_headT2"
        value="<?php echo $home_page['h_text2'] ?>">
    </div>

    <input type="submit" class="btn btn-primary btn-group-justified" value="Update">
    
    
  </form>
  
</div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close
      </button>
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

  if( empty ( $_POST [ 'headT1' ] ) ){
    $formErrors[] = "Head Text 1 can't be empty";
  }elseif (isset($_POST [ 'headT1' ]) ) 
  { $headT1 = $_POST['headT1'];}
    

  if( empty ( $_POST [ 'headT2' ] ) ){
    $formErrors[] = "Head Text 2 can't be empty";
  }elseif (isset($_POST [ 'headT2' ]) ) 
  { $headT2 = $_POST['headT2'];}

  foreach($formErrors as $error) {
    echo '<div class=" mt-3 alert alert-danger">' . $error . '</div>';
    }

    if (empty($formErrors)) {
  $stmt = $con->prepare("UPDATE home_page SET h_text1 = ?, h_text2 = ? WHERE h_id = ?");
  $stmt->execute(array($headT1, $headT2,$id));
  if($stmt->rowCount()>0){
      echo ' <div class= "mt-3 alert alert-success"> home page updated </div> ';
      

      
}
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
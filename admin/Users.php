<?php
session_start();

if (isset($_SESSION['Username'])) {


include 'ini.php';


?>
<header id="header">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Users <small>Manage your site</small></h1>
      </div>
    </div>
  </div>
</header>


<section id="main">
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <div class="list-group">
          <a href="Users.php" class="list-group-item active main-color-bg">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Users
          </a>
          <a href="home.php" class="list-group-item"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home </a>
          <a href="about.php" class="list-group-item"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> About </a>
          <a href="doctors.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Doctors </a>
          <a href="campaign.php" class="list-group-item"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Campaigns </a>
          <a href="blogs.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Blogs </a>
        </div>
      </div>
      <div class="col-md-10">
        <!-- Latest Users -->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Users</h3>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-hover">
              <tr>
                <th>id</th>
                <th>first name</th>
                <th>last name</th>
                <th>avatar</th>
                <th>Email</th>
                <th>.</th>
              </tr>
<?php

// view user data to admin
$stmt = $con->prepare(" SELECT *
                        FROM 
                            users
                        Where GroupID = 0
                        ORDER BY 
                            iD;");
    // Execute The Statement
$stmt->execute();
    // Assign To Variable 
$users = $stmt->fetchAll();

if (! empty($users)) {
  $i=0;
  foreach($users as $user) {
    $i++;
    echo "<tr>";  
    echo "<td>" . $i . "</td>";      
    echo "<td>" . $user['f_name'] . "</td>";
    echo "<td>" . $user['l_name'] ."</td>";
    echo "<td> <img class=' rounded-circle mt-5' width='50px' src=". $user["avatar"] ."> </td>";
    echo "<td>" . $user['email'] ."</td>";
  // //////////// if condition check the status column in db if 0 or 1

  if($user['status']==1){
    echo "<td class='form-check'> 
    <input class='form-check-input' type='radio' name=". $user['id'] ." id = " . $user['id'] ." checked>
    <label class='form-check-label' for='flexRadioDefault1'>Active </label>
    <div class='form-check'>
    <input class='form-check-input' type='radio' name=". $user['id'] ." id= " . $user['id'] .">
    <label class='form-check-label' for='flexRadioDefault2'>Deactive
    </label>";
    echo "</td>";
    echo "</tr>";
  }elseif($user['status']==0){
    echo "<td class='form-check'> 
    <input class='form-check-input' type='radio' name=". $user['id'] ." id = " . $user['id'] ." >
    <label class='form-check-label' for='flexRadioDefault1'>Active </label>
    <div class='form-check'>
    <input class='form-check-input' type='radio' name=". $user['id'] ." id= " . $user['id'] ." checked>
    <label class='form-check-label' for='flexRadioDefault2'>Deactive
    </label>";
    echo "</td>";
    echo "</tr>";
}}
    } else {
      echo '<div class="container">';
      echo '<div class="nice-message">There\'s No Users To Show</div>';
      echo '</div>';
    }

    
    // $userID = $_GET['id'] ;
    // $stmt = $con->prepare("UPDATE `users` SET `status` = 0 WHERE id =:id");
    // $stmt->bindParam(":id", $id);
    // $stmt->execute();
    // $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' User Deactivated</div>';
    
    echo '</div>';
  
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

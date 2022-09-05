<?php
session_start();

if (isset($_SESSION['Username'])) {
  header('Location: users.php'); // Redirect To Dashboard Page
}

include "connect.php";
$dsin_folder = "includes/templates/";
include $dsin_folder . "header.php";


	// Check If User Coming From HTTP Post Request

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$E_mail = $_POST['email'];
		$password = $_POST['pass'];
		$hashedPass = md5($password);

		// Check If The User Exist In Database

		$stmt = $con->prepare("SELECT 
									id, email, password 
								FROM 
									users
								WHERE 
									email = ? 
								AND 
									Password = ? 
								AND 
									GroupID = 1
								LIMIT 1");

		$stmt->execute(array($E_mail, $hashedPass));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();

		// If Count > 0 This Mean The Database Contain Record About This Username

		if ($count > 0) {
			$_SESSION['Username'] = $E_mail; // Register Session Name
			$_SESSION['ID'] = $row['id']; // Register Session ID
			header('Location: Users.php'); // Redirect To Dashboard Page
			exit();
		}

	}

?>
<header id="header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center"> Admin Area <small>Account Login</small></h1>
      </div>
    </div>
  </div>
</header>

<section id="main">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">

        <form id="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="email" class="form-control" placeholder="E-mail">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass" class="form-control" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-success btn-block">Login</button>
          <a href="reset-password.php">Forget Your Password ?</a>
        </form>
      </div>
    </div>
  </div>
</section>

<?php
include $dsin_folder . "footer.php";
?>
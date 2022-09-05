<?php
include 'ini.php';

// connect to database
class Connect extends PDO{

    public function __construct(){
        parent::__construct("mysql:host=localhost;dbname=medcare", 'root', '',
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}

class Controller {

// checkUserStatus function ////// check if user is logged in 
    function checkUserStatus($id, $sess){
        $db = new Connect;
        $user = $db -> prepare("SELECT id FROM users WHERE id=:id AND session=:session");
        $user -> execute([
            ':id'       => intval($id),
            ':session'  => $sess
        ]);
        $userInfo = $user -> fetch(PDO::FETCH_ASSOC);
        if(!$userInfo["id"]){
            return FALSE;
        }else{
            return TRUE;
        }
    }



    // start function for generating password and login session for only new user
    function generateCode($length){
		$chars = "vwxyzABCD02789";
		$code = ""; 
		$clen = strlen($chars) - 1;
		while (strlen($code) < $length){ 
			$code .= $chars[mt_rand(0,$clen)];
		}
		return $code;
    }
    // end function for generating password and login session
    

// insert new user in database
    function insertData($data){
        
        $db = new Connect;
        $checkUser = $db -> prepare("SELECT * FROM users WHERE email=:email");
        $checkUser -> execute ( array ( 'email' => $data [ 'email' ] ));
        $info = $checkUser -> fetch(PDO::FETCH_ASSOC);

        if(!$info){
            
            $session  = $this -> generateCode(10);
            $password = $this -> generateCode(8);
            $insertNewUser = $db -> prepare("INSERT INTO 
            users (f_name, l_name, avatar, email, password, session) 
            VALUES (:f_name, :l_name, :avatar, :email, :password, :session)");
            $insertNewUser -> execute([
                ':f_name'   => $data["givenName"],
                ':l_name'   => $data["familyName"],
                ':avatar'   => $data["avatar"],
                ':email'    => $data["email"],
                ':password' => md5($password),
                ':session'  => $session
            ]);

// insert new user session in cookies
            if($insertNewUser){
                setcookie("id", $db->lastInsertId(), time()+60*60*24*30, "/", NULL);
                setcookie("sess", $session, time()+60*60*24*30, "/", NULL);
            
                header('Location: profile.php');
                exit();
            }
            else{
                return "Error inserting user!";
            }

// insert session in cookies for old user logging in
        }else{
            setcookie("id", $info['id'], time()+60*60*24*30, "/", NULL);
            setcookie("sess", $info["session"], time()+60*60*24*30, "/", NULL);
            header('Location: index.php');
            exit();

        }
    }
}    


?>
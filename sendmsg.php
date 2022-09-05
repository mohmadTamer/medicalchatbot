<?php
    
    require_once('machine-learning.php');
    $result = bot_msg(($_POST['user_msg']));
    echo $result;


?>
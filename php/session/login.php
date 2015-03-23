<?php

require_once('../db.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$username = $request['username'];
$password = $request['password'];

$user_exp = '/^[a-z]{4,10}$/';
//any combination of lowercase letters, from 4 up to 10 characters

if (!empty($request['username']) && !empty($request['password']) && preg_match($user_exp, $username)) {
    
    function check_user($username, $password, $DBH){
        $limit = 3;
        $lockout_time = 60;
        $time = time();
        $hashpwd = hash('md5', $password);
        $pass_exp = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{7,15}$/';
        //from 7 up to 15 characters, at least 1 uppercase and lowercase letters, 1 number and 1 special character
        //password is 'Abc123!'
        
        $sql = "SELECT * FROM users WHERE username='$username'";
        $STH = $DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_ASSOC);       
        $row = $STH->fetch();
        $fail_time = $row['fail_time'];
        $attempts = $row['attempts'];
         
        if(($attempts >= $limit) && ($time - $fail_time < $lockout_time)){     
            echo "sdf6s8d7f9";
            exit;     
        } else {       
            if(($row['password'] == $hashpwd) && preg_match($pass_exp, $password)){              
                return true;              
            } else {	
                if($time - $fail_time > $lockout_time){
                    $fail_time = time();  
                    $attempts = 1;
                } else {
                    $attempts++;
                }
                 
                $STH2 = $DBH->prepare("UPDATE users SET fail_time = '" . $fail_time . "', attempts = '" . $attempts . "' WHERE username = '$username';");
                $STH2->execute($data);                
                return false;
            }
        }
    }
    
    if(check_user($username, $password, $DBH)){
        session_start();
        $_SESSION['id'] = uniqid(rand(), true);
        echo $_SESSION['id'];
    }
    
 }

?>
<?php
            ##############################################
            ##  END OF SESSION HIJACKING PREVENTION     ##
            ##############################################


            $sessionID =session_id();
            if(! empty($_SESSION['email']) ) {
                //select table datas for user with this email
				$sql=("SELECT * FROM sessions WHERE session_email='{$_SESSION['email']}' && session_status=1 && session_expires >=".time());
				// $sql=("SELECT * FROM sessions WHERE session_email='{$_SESSION['email']}'");
				$session_row= $beloved->dbrow($sql);
				////if session Id is not equal to last session id
				if($session_row['session_id']!=$sessionID){ $beloved->loggedIn=false;  }
				else if($session_row['session_status']!=1) { $beloved->loggedIn=false;   }
				else $beloved->loggedIn=true;
				
				if($beloved->loggedIn==true)
                {
                    //reset the session timeout time in the db
                    $query = "UPDATE sessions SET session_expires = ".(time()+config::sessionTime)." WHERE session_email = '".addslashes($_SESSION['email'])."' AND session_id = '".addslashes($sessionID)."' AND session_status LIKE 1";
                    $beloved->dbquery($query);    
              		$query = "SELECT * FROM users_admin WHERE user_email = '".addslashes($_SESSION['email'])."' AND user_status = 1 ORDER BY id DESC                               LIMIT 0,1";
					$beloved->user =$beloved->dbrow($query);
   				    $_SESSION['email'] = $beloved->user['user_email'];
                             
			
                }
                else
                {
					//$beloved->makeAlert('Your login Session has expired pls login to continue!');	
			   $_SESSION['end']='Your login Session has expired pls login to continue!';			
			   $beloved->user = array();
		           $beloved->loggedIn = false;
                    unset($_SESSION['email']);              
				 
		         $beloved->clientRedirect('index.php?p=login');
                }
            }
			
			
if(!empty($_POST['txt_email']) && !empty($_POST['txt_password']) && empty($_SESSION['email'])){
	$query = "SELECT * FROM users_admin WHERE user_email LIKE '".addslashes($_POST['txt_email'])."' AND user_status = 1 ORDER BY id DESC LIMIT 0,1";
    $beloved->user = $beloved->dbrow($query);
	foreach($beloved->user as $key=>$value)
		{
			$_SESSION["'{$key}'"]=$value;
			
		}

	if(md5($_POST['txt_password']) == $beloved->user['user_password'])
                {
                    $_SESSION['email'] = $beloved->user['user_email'];
                    //clear old sessions
					$query = "UPDATE sessions SET session_status=0 where session_email='{$_SESSION['email']}' or session_expires <= '".time()."'";
                    $beloved->dbquery($query);
                    //start session
					$query = "INSERT INTO sessions(session_id,session_user_id,session_expires,session_email,session_start_time,session_status)
                    VALUES('$sessionID','{$beloved->user['id']}',".(time()+config::sessionTime).",'{$_SESSION['email']}',NOW(),1)";
					$beloved->dbquery($query);  
					//update user table
					$query = "UPDATE users_admin SET user_last_login = NOW(), user_login_count = user_login_count+1 WHERE user_email = '{$beloved->                              user['user_email']}' AND id = {$beloved->user['id']}";
                    $beloved->dbquery($query);                   
                    $beloved->loggedIn = true;
					//$cmd=com_create_guid();
	             	$beloved->clientRedirect('index.php?p=config');
				    
                } else {
				 $_SESSION['error']='error';
                    $beloved->makeAlert('Invalid Email/Password combination');
                    $beloved->loggedIn = false;
		            $beloved->user = array();
                }
            }//end if(!empty($_POST['email'])
			
		
?>

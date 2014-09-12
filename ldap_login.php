<?php
	session_start();
	
	require("./template/data_access.php");
	
	$bindrdn = "cn=cs-trs-proxy,ou=proxy-users,dc=fsu,dc=edu";
	$bindpw = "PeJh6#kj";
	
	$returnLocation = './ldap_login.php';
	
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	
	if ($username == "")
	{
		$_SESSION['message'] = "Invalid username or password.";
		header( 'Location: '.$returnLocation );
		exit;
	}
	//Connect to the LDAP server(primary is mds.fsu.edu. If an error occurs with this server,
	//Change to mdsacns2.fsu.edu) . Resource link/ connection bound to $ds
	
	//Start SSL on the link
	$ds = ldap_connect("mdsacns2.fsu.edu");
	ldap_start_tls($ds);
	if(!$ds)
	{
		//Could not connect to the LDAP server
		$_SESSION['message'] = "Could not communicate with the log in server. Please contact your instructor for assistance.";
		header( 'Location: '.$returnLocation );
		exit;
	}
	$bind = ldap_bind($ds, $bindrdn, $bindpw);
	if(!$bind)
	{
		// Could not bind. This is generally a problem with the LDAP server or the bind information.
		$_SESSION['message'] = "Could not communicate with the log in server. Please contact your instructor for assistance.";
		header( 'Location: '.$returnLocation );
		exit;	
	}
	$search = ldap_search($ds, "ou=People, dc=fsu, dc=edu", "uid=$username");
	if( ldap_count_entries($ds, $search) < 1)
	{
		//Search and make sure that there is an entry. If there is not, The username is invalid.
		$_SESSION['message'] = "Invalid username or password.";
		header( 'Location: '.$returnLocation);
		exit;
	}
	$info = ldap_get_entries($ds, $search);
	$bind = ldap_bind($ds, $info[0][dn], $password);		//Here we attempt to bind with their username and their given password.
	
	$search = ldap_search($ds, "ou=People, dc=fsu dc=edu", "uid=$username");
	if( !$bind || !isset($bind))
	{
		//If bind failed, their password is most likely incorrect.
		$_SESSION['message'] = "Invalid username or password.";
		header( 'Location: '.$returnLocation);
		exit;
	}
	
	$info = ldap_get_entries($ds, $search);
	if($username == $info[0][uid][0])
	{
		//Verify that the username they provided us is the same username we bound to.
		//Proceed to verify login and then redirect.
		$result=findLoginLDAP($username);
		if(count($result) > 0)
		{
			$row = $result[0];
			$_SESSION['fsuid'] = $row['fsuid'];
			$_SESSION['role'] = $row['role'];
			
			if ($row['role'] == 1)
			{
				header( 'Location: ./StudentSide/index.html');
			}
			elseif($row['role'] == 2)
			{
				header( 'Location: ./AdminSide/index.html');
			}
		}			
		else
		{
			$_SESSION['message'] = "You do not have access to use this system.";
			header( 'Location: '.$returnLocation);
			
		}
	}
}
else
{
			$_SESSION['message'] = "Invalid username or password.";
			header( 'Location: '.$returnLocation);
}

?>	
	
	
	
	
	
	
	
	
	
	
	
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	}



		
	
	
	
	
	
	}
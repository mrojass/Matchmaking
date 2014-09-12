<?php
	  //open session
	  session_start();

	  //server-side include of all data access management layers and utility funcs
	  require("./template/data_access.php");

	  //server-side include of all standard HTML structures that will be used in the file
	  require("./template/template_structs.php");

	  //check for session. If user is already logged in, redirect to appropriate menu
		  if(array_key_exists('role', $_SESSION) && $_SESSION['role'] == 1)
		  {
		  		header('Location:./StudentSide/');
		  			exit();
		  }
		  else if(array_key_exists('role', $_SESSION) && $_SESSION['role'] == 2)
		  {
		  		header('Location: ./AdminSide/');
		  			exit();
		  }

	  //get message to display if there is one
	  if( array_key_exists('message', $_SESSION) )
	  {
	  		$message = $_SESSION['message'];
	  		unset($_SESSION['message'])
	  }  	
	  else
	  {
	  		$message = "<br>";
	  }
?>
<?php
	  //html info, header, etc.
	  html_header();
?>

<?php
	  //Put any applicable data access functions here
?>

<?php
	  //top header
	  html_topBar();
?>
<p>&nbsp;</p>

<!-- main box starts here -->

	<table class="main_box_background" align="center" border="1" cellspacing="0" >
		<tr>
			<td class="headerbox">
					   Exam Reservation System
			</td>
		</tr>
		<tr>
			<td class="main_box_td" valign="top">
				<p class="cornercaption" >
					<!-- Caption -->
					Log In:
				</p>
				<!-- inner box starts here -->
				<table class="inner_box_background" align="center" cellspacing="0" cellpadding="6" >
					<tr valign="top" >
						<td>
							<!-- Content -->
							<p class="loginbold">
								Important Policies
							</p>
							<ul class="mainfont">
						<li> 
							Exam reservations made or changed 
			after the deadlines posted on the class Agenda will be penalized in
			accordance with the course syllabus unless you can provide written
			proof why you missed your original exam.
						</li>
						<li>
							Bring your FSU ID card to your
			exam and arrive on time. Failure to do either will result in you not
			being able to take the exam.
						</li>
						<li>
						 	Do not take any electronic devices
			into the testing center.
						</li>
							</ul>
							<p class="loginbold">
								Log In Information
							</p>
							<ul class="mainfont">
								<li> Your FSUID and password
			is the same that you use to Log In to Blackboard. </li>

							</ul>
							<p class="loginitalic">
								See the Class Syllabus for
			more details on these and all class policies.
							</p>
							<hr>
							<p class="loginitalic">
								Please enter the below
			information then click the Log In button.
							</p>
							<form name="login" method="post"
			action="ldap_login.php">
								<table class="logintable">
									<tr>
										<td class="logintd1">
											<span class="mainfont">
												Your FSUID:&nbsp;
											</span>
										</td>
										<td class="logintd2">
											<span class="mainfont">
												<input type="text" 
			name="username" size="8">@fsu.edu
											</span>
										</td>
									</tr>
									<tr>
										<td class="logintd1">
											<span class="mainfont">
												Your Password:&nbsp;
											</span>
										</td>
										<td class="logintd2">
											<span class="mainfont">
												<input type="password" 
			name="password" maxlength="50">
											</span>
										</td>
									</tr>
								</table>
								<div class="message" align="center">
									<?php echo $message;
									unset($_SESSION['message']);?>
									<br>
									<input type="submit" name="Submit"
			value="Log In &gt;">
								</div>
							</form>
							<br>
							<div align="center">
								<form method="post"
			action="forgotpassword.php">
									<input type="submit" 
			name="forgotpass" value="Forgot Your Password?">
								</form>
							</div>

							<!-- End Content -->
						</td>
					</tr>
				</table>
	<!-- main box ends here -->
	<?php
		//whatever needs to go at the bottom of the page.
		html_footer();
	?>




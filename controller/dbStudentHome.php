<?php

/* Inserts the user registration information into the database and sends an email to the user for confirmation */

	require_once('../generated/include_dao.php');
	$userDAO = DAOFactory::getUserDAO();

	
if (isset ( $_POST ) && ! empty ( $_POST )) {
	echo "Post is value";
	if (isset ( $_POST ['commit'] ) && ($_POST ['commit'] == 'Sign up')) {
		$email = $_POST ['email'];
		$username = $_POST ['username'];
		$password = $_POST ['password'];
		echo "username " .$username . "<br/>";
		// check those optional choices
		$fname = (! empty ( $_POST ['fname'] )) ? $_POST ['fname'] : "";
		$lname = (! empty ( $_POST ['lname'] )) ? $_POST ['lname'] : "";
		$phone = (! empty ( $_POST ['phone'] )) ? $_POST ['phone'] : "";
		$major = (! empty ( $_POST ['major'] )) ? $_POST ['major'] : "";
		$school = (! empty ( $_POST ['school'] )) ? $_POST ['school'] : "";
		$status = 'no';
		$role = $_POST ['role'];
		
		$query1 = $userDAO->queryByEmail($username);
		echo "query1 size" . count($query1);
		if (count($query1) > 0) {
			?>
<script type="text/javascript">
  				alert("Username already exists. Please select another username.");
				document.location.href = '../register.php';
				</script>
<?php
		}
		
		$query2 = $userDAO->queryByEmail($email);
		if (count($query2) > 0) {
			?>
<script type="text/javascript">
  				alert("Email already registered. Please proceed to login.");
				document.location.href = '../index.php';
				</script>
<?php
		exit();
		}
		$user = new User();
		$user->username = $username;
		$user->firstName = $fname;
		$user->lastName = $lname;
		$user->email = $email;
		$user->phone = $phone;
		$user->major = $major;
		$user->school = $school;
		$user->password = $password;
		$user->status = "no";
		
		if ($userDAO->insert($user)) {
			if ($role == 'tutor') {
				$tutorDAO = DAOFactory::getTutorDAO();
				$tutor->username = $username;
				$tutorDAO->insert($tutor);
			}
			
			require 'mailInitRegistration.php';
			
			$to = $email;
			$name = $username; // Recipient's name
			$actLink = 'http://www.cs.indiana.edu/cgi-pub/jiguan/tutor/controller/dbRequestProcessor.php?userid=' . $username;
			
			$mail->AddAddress ( $to, $name );
			$mail->Subject = "Registration Confirmation";
			
			$body = "";
			$body .= "Hello " . $username . ":<br />";
			$body .= "Please click on the link below to confirm your registration with Tutor Me!!<br />";
			$body .= '<a href="' . $actLink . '">' . $actLink . "</a><br />";
			$body .= "<br />Thank you <br /> Tutor me!<br />";
			
			$mail->Body = $body; // HTML Body
			$mail->AltBody = $body; // Text Body
			if (! $mail->Send ()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
				?>
<script type="text/javascript">
  				alert("An email has been sent to you at the address provided. Please follow the link in the email to complete registration.");
  				document.location.href = '../index.php';
				</script>
<?php
			}
		} 
	}
} else {
	echo "Page error";
}

?>

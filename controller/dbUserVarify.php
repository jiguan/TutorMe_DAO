<?php

/* This page tests the validity of the login credentials. If OK, redirects to the home page of student/tutor. If not, redirects back to index page */

require_once '../generated/include_dao.php';

$username = $_POST ["username"];
$password = $_POST ["password"];

$userDAO = DAOFactory::getUserDAO();
$result = $userDAO->queryByUsernameAndPassword($username, $password);


if (count($result)==1) {
	session_start ();
	$_SESSION ['username'] = $username;
	
	$result2 = $userDAO->load($username);
	$status = $result2->status;
	if ($status == "no") {
		?>
<script type="text/javascript">
  				alert("Your registration has not been confirmed yet. Please check your email for the confirmation link.");
  				document.location.href = '../index.php';
				</script>
<?php
	} else {
		$row = DAOFactory::getTutorDAO()->load($username);
		if (count($row) == 1)
			header ( 'Location: ../tutorHome.php' );
		else
			header ( 'Location: ../studentHome.php' );
	}
} else {
	?>
<script type="text/javascript">
  		alert("Username/Password incorrect. Please try again.");
  		document.location.href = '../index.php';
		</script>
<?php
}
?>
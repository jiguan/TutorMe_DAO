<?php
require_once '../generated/include_dao.php';
require_once '../util/util.php';

session_start ();
if (! isset ( $_SESSION ['username'] )) {
	header ( "Location: index.php" );
} else {
if($_POST['type']=='Student') {
	$user = new User();
	
	$user->username = $_SESSION ['username'];
	$user->firstName = $_POST ['firstName'];
	$user->lastName = $_POST ['lastName'];
	$user->email = $_POST ['email'];
	$user->phone = $_POST ['phone'];
	$user->major = $_POST ['major'];
	$user->school = $_POST ['school'];
	
	$userDAO = DAOFactory::getUserDAO();
	$userDAO->updateProfile($user);
	return populateViewInfoForm ($user->username);
}

}
?>
<?php

/* Inserts rating of the tutor, rated by a student, into the database. Redirects to studentHome.php */

	require_once('../generated/include_dao.php');
	$ratingDAO = DAOFactory::getRatingDAO();
	
session_start ();

$username = $_SESSION ['username'];
$tutorID = $_SESSION ['tutorid_rate'];
$courseID = $_SESSION ['courseid_rate'];
if (!isset ( $_POST ['rating'] )) {
	echo "no post";
} else {
$rating = $_POST ['rating'];

$ratingDTO = new Rating();
$ratingDTO->username = $username;
$ratingDTO->tutorID = $tutorID;
$ratingDTO->courseID = $courseID;
$ratingDTO->rating = $rating;
if ($ratingDAO->insert($ratingDTO)) {
	header ( 'Location: ../studentHome.php' );
} else {
	die ( "Database query failed" );
}
}
?>
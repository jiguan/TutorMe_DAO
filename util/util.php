<?php


function getTimeTable($tutorID, $parseDate) {

	$TimeTableDAO = DAOFactory::getTimeTableDAO();
	$result = $TimeTableDAO->queryByUsernameAndDate($tutorID, $parseDate);
	
	$timetable = array ();
	
	for($i=0;$i<count($result);$i++) {
		$row = $result[$i];
		$begin_time = DateTime::createFromFormat ( 'Y-m-d H:i:s', $parseDate . " " . $row->beginTime);
		$end_time = DateTime::createFromFormat ( 'Y-m-d H:i:s', $parseDate . " " . $row->endTime);
		
		while ( $begin_time <= $end_time ) {
			$fdate = date_format ( $begin_time, 'H:i' );
			array_push ( $timetable, $fdate );
			$begin_time->add ( new DateInterval ( 'PT30M' ) );
		}
	}
	return $timetable;
}



function getScheduleTime($tutorID, $parseDate) {
	$scheduleDAO = DAOFactory::getScheduleDAO();
	$result = $scheduleDAO->queryByUsernameAndDate($tutorID, $parseDate);
	$scheduledTime = array ();
	if (count($result)>0) {
		for($i=0;$i<count($result);$i++) {
			$row = $result[$i];
			$begin_time = DateTime::createFromFormat ( 'Y-m-d H:i:s', $parseDate . " " . $row->beginTime );
			$end_time = DateTime::createFromFormat ( 'Y-m-d H:i:s', $parseDate . " " . $row->endTime );
				
			while ( $begin_time <= $end_time ) {
				$fdate = date_format ( $begin_time, 'H:i' );
				array_push ( $scheduledTime, $fdate );
				$begin_time->add ( new DateInterval ( 'PT30M' ) );
			}
		}
	}
	return $scheduledTime;
}
function getAvailableTime($tutorID, $date) {
	$parseDate = $date;
	$timetable = getTimeTable ( $tutorID, $parseDate );
	$schedule_time = getScheduleTime ( $tutorID, $parseDate );

	return flip_isset_diff ( $timetable, $schedule_time );
}

function flip_isset_diff($b, $a) {
	$at = array_flip ( $a );
	$d = array ();
	foreach ( $b as $i )
		if (! isset ( $at [$i] ))
		$d [] = $i;
	return $d;
}

function getUserInfo($userID) {
	$userDAO = DAOFactory::getUserDAO();
	$row = $userDAO->load($userID);
	if (count($row)>0) {
		return $row;
	} else {
		echo "Cannot find UserID: $userID";
	}
}


function isEditable($userID) {
	return $userID == $_SESSION ['username'] ? true : false;
}
function isTutor($userID) {
	$tutorDAO = DAOFactory::getTutorDAO();
	$result = $tutorDAO->load($username);
	return (count($result)>0) ? TRUE : FALSE;
}

function populateViewInfoForm($userID) {
	$userInfo = getUserInfo ( $userID );
	$firstName = $userInfo->firstName;
	$lastName = $userInfo->lastName;
	$name = $firstName . " " . $lastName;
	$email = $userInfo->email;
	$phone = $userInfo->phone;
	$school = $userInfo->school;
	$major = $userInfo->major;

	echo "<form id='viewInfoForm'>

	<table cellpadding='0' cellspacing='0' border='0'>
	<tr>
	<td width=160px;><label>First Name:</label></td>
	<td id='tdFirstName'>$firstName</td>
	</tr>
	<tr>
	<td><label>Last Name:</label></td>
	<td id='tdLastName'>$lastName</td>
	</tr>
	<tr>
	<td><label>Email:</label></td>
	<td id='tdEmail'>$email</td>
	</tr>
	<tr>
	<td><labe>Phone:</label></td>
	<td id='tdPhone'>$phone</td>
	</tr>
	<tr>
	<td><label>School:</label></td>
	<td id='tdSchool'>$school</td>
	</tr>
	<tr>
	<td><label>Major:</label></td>
	<td id='tdMajor'>$major</td>
	</tr>";

	if (isEditable ( $userID )) {
	echo "<tr><td colspan='3' align='right'><input id='editInfoButton' type='button' value='Edit' onclick='onEditInfo()' /></td></tr>";
	}

	echo "</table>
	</form>
	</div>";
}
function populateCourseAndRatings($tutorID) {
	$coursesAndRatings = getCoursesAndRatings ( $tutorID );
	echo "<table>";
	foreach ( $coursesAndRatings as $data ) {
		$courseId = $data->courseID;
		$courseName = $data->courseName;
		$rating = $data->rating;
		echo "<tr>";
		echo "<td>$courseId</td>";
		echo "<td>$courseName</td>";
		if (! empty ( $rating )) {
			echo "<td><span class='stars'>$rating</span></td>";
		}
		echo "</tr>";
	}

	if (isEditable ( $tutorID ) == true) {
		echo "<tr>
		<td colspan='3' align='right'><input id='editCourseButton' type='button' value='Edit' onclick='onEditCourse()' /></td>
		</tr>";
	}

	echo "</table>";
}

function populateEditCourseView($userID) {
	if (isEditable ( $userID ) == true) {
		$coursesAndRatings = getCoursesAndRatings ( $userID );
		echo "<table id='editCoursesTable'>";
		foreach ( $coursesAndRatings as $data ) {
		$courseId = $data->courseID;
		$courseName = $data->courseName;
		echo "<tr id=$courseId>";
		echo "<td>$courseId</td>";
		echo "<td>$courseName</td>";
			
		$tmp = '"' . $courseId . '"';
		echo "<td><a onclick='onRemoveCourse($tmp)'>Remove</a></td>";
		echo "</tr>";
		}

		echo "</table>";

		echo "<table>";
		$courseList = getCourses ();
		echo "<tr>";
		echo "<td colspan='2'><a>Add new course:</a><select id='newCourse' style='margin-left:5px;'>";

		foreach ( $courseList as $key => $value ) {
		// $tmp_result = $key . " " . $value;
		echo "<option value=" . $key . ">$value</option>";
		}

			echo "</select></td>";
			echo "<td align='right'><a onclick='onAddNewCourse()'>Go</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td align='right'><input id='doneUpdateButton' type='button' value='Done' onclick='onDoneUpdate()' /></td>";
			echo "<td align='right'><input id='cancleUpdateButton' type='button' value='Cancel' onclick='onCancleEditCourse()' /></td>";
			echo "</tr>";
			echo "</table>";
		}
		}
function getCourses() {
	$courseDAO = DAOFactory::getCourseDAO();
	$result = $courseDAO->queryAll();
	$courseList = array ();
	for($i=0;$i<count($result);$i++) {
		$row = $result[$i];
		$courseList [$row->courseID] = $row->courseName;
	}
	return $courseList;
}
	
function getCoursesAndRatings($tutorID) {
	$courseOfferDAO = DAOFactory::getCourseOfferDAO();
	$result = $courseOfferDAO->queryAvgRatingByTutor($tutorID);
	$coursesAndRatings = array ();

	if (count($result) > 0) {
		
		for($i=0;$i<count($result);$i++) {
			$row = $result[$i];
			array_push ( $coursesAndRatings, $row );
		}
	}

	return $coursesAndRatings;
}


?>
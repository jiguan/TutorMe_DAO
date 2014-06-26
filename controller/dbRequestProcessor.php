<?php

require_once('../generated/include_dao.php');
require_once '../util/util.php';

$type = $_GET['type'];

if($type=='register') {
	$username = $_GET ['userid'];
	DAOFactory::getUserDAO()->updateStatus('yes',$username);
	?>
	<script type="text/javascript">
	  				alert("Your registration has been confirmed. You can now login into Tutor Me!!.");
	  				document.location.href = '../index.php'
					</script>
	<?php
	

} else if($type='getLocation') {
	$date = $_GET ['date'];
	$beginTime = $_GET ['beginTime'];
	$endTime = $_GET ['endTime'];
	$parseDate = $date;
	$locationDAO = DAOFactory::getLocationDAO();
	$result = $locationDAO->queryAvailableLocation();

	if (count($result) > 0) {
		echo "<option selected disabled value=''>Select location</option>";
		for($i=0;$i<count($result);$i++) {
			$row = $result[$i];
			$loc_id = $row->locationID;
			$loc = $row->building . " " . $row->floor . " Floor." . " Room " . $row->room;
			echo "<option value='$loc_id'>$loc</option>";
		}
	} else {
		// populate option with value no available location
		echo "<option selected disabled value=''>Not available</option>";
	}
} else if($type='getAvailableTime') {
	$tutorID = $_GET ['tutorID'];
	$date = $_GET ['date'];
	if (! empty ( $tutorID ) && ! empty ( $date )) {
		$availableTime = getAvailableTime ( $tutorID, $date );
		if (sizeof ( $availableTime ) > 0) {
			echo "<option selected disabled value=''>Select time</option>";
			foreach ( $availableTime as $time ) {
				echo "<option value='$time'>$time</option>";
			}
			
		} else {
			echo "<option selected disabled value=''>Not available</option>";
		}
	} else {
		// Populate error
		 echo "<option selected disabled value=''>Not available</option>";
	}
}



?>
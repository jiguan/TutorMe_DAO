<!doctype html>
<html>

<!-- Home page of the tutor. Displays Confirmed and Pending appointments -->

<head>
<meta charset="utf-8">
<title>Tutor Me!!</title>
<link rel="stylesheet" href="js/slick/slick.grid.css" type="text/css" />
<link rel="stylesheet" href="js/slick/controls/slick.pager.css"
	type="text/css" />
<link rel="stylesheet"
	href="js/slick/css/smoothness/jquery-ui-1.8.16.custom.css"
	type="text/css" />
<link rel="stylesheet" href="js/slick/examples/examples.css"
	type="text/css" />
<link rel="stylesheet" href="js/slick/controls/slick.columnpicker.css"
	type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<!--<link href='http://fonts.googleapis.com/css?family=Raleway:400,900,800,700,600,500,300,200,100' rel='stylesheet' type='text/css'>-->

<script src="js/jquery-1.8.0.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script src="js/jquery.carouFredSel-5.5.0-packed.js"
	type="text/javascript"></script>
<script src="js/functions.js" type="text/javascript"></script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  function openLanding()
	{
	window.open("index.php","_self")
	}
  </script>
</head>
<body>
<?php
session_start ();
require_once 'generated/include_dao.php';
if (! isset ( $_SESSION ['username'] )) {
	header ( "Location: index.php" );
} else {
	
	$username = $_SESSION ['username'];
	$scheduleDAO = DAOFactory::getScheduleDAO();
	$status = "Approved";
	$result = $scheduleDAO->queryByTutorIDANDStatus($username, $status);
	
	if (count($result)>0) {
		$data = '';
		for($i=0;$i<count($result);$i++) {
			$row = $result[$i];
			$data .= '
        data[' . $i . '] = {
			ScheduleID: "' . $row->scheduleID . '",
			UserID: "' . $row->username . '",
            TutorID: "' . $row->tutorID. '",
			CourseID: "' . $row->courseID . '",
			LocationID: "' . $row->locationID . '",
			Date: "' . $row->date . '",
            StartTime: "' . $row->beginTime . '",
			EndTime: "' . $row->endTime . '",
			Status: "' . $row->status . '"
        };
    	';
		}
	}
	$status = "Pending";
	$result1 = $scheduleDAO->queryByTutorIDANDStatus($username, $status);
	if (count($result1)>0) {
		$data1 = '';
		for($i=0;$i<count($result1);$i++) {
					$row = $result1[$i];
					$data1 .= '
        data1[' . $i . '] = {
			ScheduleID: "' . $row->scheduleID . '",
			UserID: "' . $row->username . '",
            TutorID: "' . $row->tutorID. '",
			CourseID: "' . $row->courseID . '",
			LocationID: "' . $row->locationID . '",
			Date: "' . $row->date . '",
            StartTime: "' . $row->beginTime . '",
			EndTime: "' . $row->endTime . '",
			Status: "' . $row->status . '"
        };
    	';
		}
	}
}
?>
<div class="shell">
		<div class="container">
			<header id="header">
				<img id="logo" src="css/images/logo.png" onClick="openLanding()" />
				<label style="float: right; margin-right: 50px;">Welcome <?php echo $username ?></label>
				<div class="cl">&nbsp;</div>
			</header>
			<div id="leftNavigation">
				<ul class="nav">
					<li><a href="#">Home</a></li>
					<li><a href="profile.php">My Profile</a></li>
					<li><a href="logoff.php">Log off</a></li>
				</ul>
			</div>
			<div id="userProfileDiv">
				<table width="100%">
					<tr>
						<td valign="top" width="50%"><div class="grid-header"
								style="width: 640px;">
								<label>Confirmed Appointments</label>
							</div>
							<div id="myGrid" style="width: 640px; height: 125px;"></div></td>
					</tr>
				</table>

				<table width="100%">
					<tr>
						<td valign="top" width="50%"><div class="grid-header"
								style="width: 640px;">
								<label>Pending Appointments</label>
							</div>
							<div id="myGrid1" style="width: 640px; height: 125px;"></div></td>
					</tr>
				</table>
			</div>
			<div id="footerContainer">
				<div id="footer">
					<div class="footer-nav">
						<ul>
						</ul>
						<div class="cl">&nbsp;</div>
					</div>
					<p class="copy">
						&copy; Copyright 2013<span>|</span>Tutor Search - Designed by <a
							href="http://www.cs.indiana.edu/~yuqwu/courses/B561-fall13/webpage/"
							target="_blank">Advanced Database Concepts - Group_14</a>
					</p>
					<div class="cl">&nbsp;</div>
					<!-- end of footer -->
				</div>
			</div>
		</div>
	</div>
	<script src="js/slick/lib/jquery.event.drag-2.2.js"></script>
	<script src="js/slick/slick.core.js"></script>
	<script src="js/slick/slick.dataview.js"></script>
	<script src="js/slick/slick.formatters.js"></script>
	<script src="js/slick/slick.grid.js"></script>
	<script>
function formatter(row, cell, value, columnDef, dataContext) {
        return value;
    }
	
  var grid;
  var columns = [
    {id: "ScheduleID", name: "Schedule ID", field: "ScheduleID"},
	{id: "TutorID", name: "Student Name", field: "UserID"},
	{id: "CourseID", name: "Course ID", field: "CourseID"},
	{id: "LocationID", name: "Location", field: "LocationID"},
    {id: "Date", name: "Date", field: "Date"},
    {id: "StartTime", name: "From", field: "StartTime"},
    {id: "EndTime", name: "To", field: "EndTime"},
	{id: "Status", name: "Status", field: "Status"}
  ];

  var options = {
    enableCellNavigation: true,
    enableColumnReorder: false
  };

  $(function () {
     var data = [];
        <?=$data?> 
        grid = new Slick.Grid($("#myGrid"), data, columns, options);
  });
</script>
	<script>
function formatter(row, cell, value, columnDef, dataContext) {
        return value;
    }
	
  var grid1;
  var columns1 = [
    {id: "ScheduleID", name: "Schedule ID", field: "ScheduleID"},
	{id: "UserID", name: "Student Name", field: "UserID"},
	{id: "CourseID", name: "Course ID", field: "CourseID"},
	{id: "LocationID", name: "Location", field: "LocationID"},
    {id: "Date", name: "Date", field: "Date"},
    {id: "StartTime", name: "From", field: "StartTime"},
    {id: "EndTime", name: "To", field: "EndTime"},
	{id: "Status", name: "Status", field: "Status"}
  ];

  var options = {
    enableCellNavigation: true,
    enableColumnReorder: false
  };

  $(function () {
     var data1 = [];
        <?=$data1?> 
        grid1 = new Slick.Grid($("#myGrid1"), data1, columns1, options);
  });
</script>
</body>
</html>

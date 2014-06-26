<!doctype html>
<html>
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
  $("#datepicker").datepicker({
    minDate: 0,
	maxDate: '+2w',
    dateFormat: 'yy-mm-dd'
});
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

$username = "visitor";
$showInfo = "";
if (isset ( $_POST ['searchBox'] ) and $_POST ['searchBox'] == "Search") {

		$course = $_POST ["course"];
		$showInfo .= $_POST ['course'] . " ";
		$date;
		
	if ($_POST ["datepicker"] === "Enter Date here") {
		$date = "Enter Date here";
	} else {
		$date_raw = $_POST ["datepicker"];
		$date_trans = date ( 'Y-m-d', strtotime ( str_replace ( '-', '/', $date_raw ) ) );
		$date = $date_trans;
		$showInfo .= $_POST ['datepicker'];
	}
	
	$_SESSION ['courseid'] = $course;
	$_SESSION ['date'] = $date;
	
			$courseofferDAO = DAOFactory::getCourseofferDAO();
		$result = $courseofferDAO->queryTutorTime($course, $date);
		if (count($result)===0) {
		?>
		<script type="text/javascript">
			//alert("Oops!! No Tutors found for the specified search criteria");
			//document.location.href = 'index.html';
		</script>
	<?php
	} else {
		$data = '';
		for($i=0;$i<count($result);$i++) {
			$row = $result[$i];
			$data .= '
			data[' . $i . '] = {
				TutorID: "' . $row->tutorID . '",
				Date: "' . $row->date . '",
				StartTime: "' . $row->beginTime . '",
				EndTime: "' . $row->endTime . '"
			};
		';
		}
	}
} else {
	echo "Illegal access";
}
?>
<div class="shell">
		<div class="container">
			<header id="header">
				<img id="logo" src="css/images/logo.png" onClick="openLanding()" />
				<label style="float: right; margin-right: 50px;">Hello visitor,
					please log in</label>
				<div class="cl">&nbsp;</div>
			</header>
			<div id="userProfileDiv" style="position: relative"
				style="width:100%;">
				<table width="50%">
					<tr>
						<td valign="top" width="50%"><div class="grid-header"
								style="width: 560px;">
								<label>Search Results for <?php echo $showInfo ?></label>
							</div>
							<div id="myGrid" style="width: 560px; height: 175px;"></div></td>
					</tr>
				</table>
				<p>* You need to log in to make a appointment with tutor</p>
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
    {id: "TutorID", name: "Tutor Name", field: "TutorID"},
    {id: "Date", name: "Date", field: "Date"},
    {id: "StartTime", name: "From", field: "StartTime"},
    {id: "EndTime", name: "To", field: "EndTime"}
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
  
  function scheduleAppointment(id)
  {
	  window.alert(id);
  }
 
</script>
</body>
</html>

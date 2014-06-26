<?php
/**
 * Class that operate on table 'courseoffer'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
class CourseofferMySqlExtDAO extends CourseofferMySqlDAO{
	
	public function queryAvgRatingByTutor($tutorID){
		$sql = 'SELECT CO.CourseID, C.CourseName, AVG(R.Rating) as Rating
		FROM CourseOffer CO
		INNER JOIN Course C
		ON CO.CourseID = C.CourseID
		LEFT JOIN (SELECT * FROM Rating WHERE TutorID = ?) as R
		ON CO.CourseID = R.CourseID
		WHERE CO.TutorID = ?
		GROUP BY CO.CourseID';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($tutorID);
		$sqlQuery->set($tutorID);
		$tab = $this->execute($sqlQuery);
			$ret = array();
			for($i=0;$i<count($tab);$i++) {
				$courseofferCourse = new CourseofferCourse();
				$courseofferCourse->courseID = $tab[$i]["CourseID"];
				$courseofferCourse->courseName = $tab[$i]["CourseName"];
				$courseofferCourse->tutorID = $tutorID;
				$courseofferCourse->rating = $tab[$i]["Rating"];
				$ret[$i] = $courseofferCourse;
			}
			return $ret;
	}
	
	public function queryTutorTime($course, $date) {
		if($date=="Enter Date here") {
			$sql = 'select c.CourseID, c.TutorID, t.Date, t.BeginTime, t.EndTime
			from CourseOffer c join TimeTable t on c.TutorID = t.TutorID
			where c.CourseID = ? ';
			$sqlQuery = new SqlQuery($sql);
			$sqlQuery->set($course);
			$tab = $this->execute($sqlQuery);
			$ret = array();
			for($i=0;$i<count($tab);$i++) {
				$courseofferTimetable = new CourseofferTimetable();
				$courseofferTimetable->courseID = $tab[$i]["CourseID"];
				$courseofferTimetable->date = $tab[$i]["Date"];
				$courseofferTimetable->beginTime = $tab[$i]["BeginTime"];
				$courseofferTimetable->endTime = $tab[$i]["EndTime"];
				$courseofferTimetable->tutorID = $tab[$i]["TutorID"];
				$ret[$i] = $courseofferTimetable;
			}
			return $ret;
		} else {
			$sql = 'select c.CourseID, c.TutorID, t.Date, t.BeginTime, t.EndTime
			from CourseOffer c join TimeTable t on c.TutorID = t.TutorID
			where c.CourseID = ? and t.Date = ? ';
			$sqlQuery = new SqlQuery($sql);
			$sqlQuery->set($course);
			$sqlQuery->set($date);
			$tab = $this->execute($sqlQuery);
			$ret = array();
			for($i=0;$i<count($tab);$i++) {
				$courseofferTimetable = new CourseofferTimetable();
				$courseofferTimetable->courseID = $tab[$i]["CourseID"];
				$courseofferTimetable->date = $tab[$i]["Date"];
				$courseofferTimetable->beginTime = $tab[$i]["BeginTime"];
				$courseofferTimetable->endTime = $tab[$i]["EndTime"];
				$courseofferTimetable->tutorID = $tab[$i]["TutorID"];
				$ret[$i] = $courseofferTimetable;
			}
			return $ret;
		}
	}
}
?>
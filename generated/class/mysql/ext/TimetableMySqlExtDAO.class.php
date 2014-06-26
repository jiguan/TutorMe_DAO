<?php
/**
 * Class that operate on table 'timetable'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
class TimetableMySqlExtDAO extends TimetableMySqlDAO{
	public function queryByUsernameAndDate($username, $date){
		$sql = 'SELECT * FROM TimeTable WHERE TutorID = ? AND Date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($username);
		$sqlQuery->set($date);
		return $this->getList($sqlQuery);
	}
	
	public function queryByUsername($username){
		$sql = 'SELECT * FROM TimeTable WHERE TutorID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($username);
		return $this->getList($sqlQuery);
	}
}
?>
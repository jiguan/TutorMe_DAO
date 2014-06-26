<?php
/**
 * Class that operate on table 'schedule'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
class ScheduleMySqlExtDAO extends ScheduleMySqlDAO{
	
	public function queryByTutorIDANDStatus($tutorID, $status){
		$sql = 'SELECT * FROM Schedule WHERE TutorID = ? AND Status = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($tutorID);
		$sqlQuery->set($status);
		return $this->getList($sqlQuery);
	}

	public function queryFutureByStatus($username, $status){
		$today = date ( "Y-m-d" );
		$sql = 'SELECT * FROM Schedule WHERE Username = ? AND Date >= ? AND Status = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($username);
		$sqlQuery->set($today);
		$sqlQuery->set($status);
		return $this->getList($sqlQuery);
	}
	
	public function queryPastByStatus($username, $status){
		$today = date ( "Y-m-d" );
		$sql = 'SELECT * FROM Schedule WHERE Username = ? AND Date < ? AND Status = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($username);
		$sqlQuery->set($today);
		$sqlQuery->set($status);
		return $this->getList($sqlQuery);
	}
	
	public function queryByUsernameAndDate($username, $date){
		$sql = 'SELECT * FROM schedule WHERE Username = ? AND Date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($username);
		$sqlQuery->set($date);
		return $this->getList($sqlQuery);
	}
	
}
?>
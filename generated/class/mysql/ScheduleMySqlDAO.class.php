<?php
/**
 * Class that operate on table 'schedule'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
class ScheduleMySqlDAO implements ScheduleDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ScheduleMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM schedule WHERE ScheduleID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM schedule';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM schedule ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param schedule primary key
 	 */
	public function delete($ScheduleID){
		$sql = 'DELETE FROM schedule WHERE ScheduleID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($ScheduleID);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ScheduleMySql schedule
 	 */
	public function insert($schedule){
		$sql = 'INSERT INTO schedule (Username, TutorID, CourseID, LocationID, Date, BeginTime, EndTime, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($schedule->username);
		$sqlQuery->set($schedule->tutorID);
		$sqlQuery->set($schedule->courseID);
		$sqlQuery->setNumber($schedule->locationID);
		$sqlQuery->set($schedule->date);
		$sqlQuery->set($schedule->beginTime);
		$sqlQuery->set($schedule->endTime);
		$sqlQuery->set($schedule->status);

		$id = $this->executeInsert($sqlQuery);	
		$schedule->scheduleID = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ScheduleMySql schedule
 	 */
	public function update($schedule){
		$sql = 'UPDATE schedule SET Username = ?, TutorID = ?, CourseID = ?, LocationID = ?, Date = ?, BeginTime = ?, EndTime = ?, Status = ? WHERE ScheduleID = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($schedule->username);
		$sqlQuery->set($schedule->tutorID);
		$sqlQuery->set($schedule->courseID);
		$sqlQuery->setNumber($schedule->locationID);
		$sqlQuery->set($schedule->date);
		$sqlQuery->set($schedule->beginTime);
		$sqlQuery->set($schedule->endTime);
		$sqlQuery->set($schedule->status);

		$sqlQuery->setNumber($schedule->scheduleID);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM schedule';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByUsername($value){
		$sql = 'SELECT * FROM schedule WHERE Username = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTutorID($value){
		$sql = 'SELECT * FROM schedule WHERE TutorID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCourseID($value){
		$sql = 'SELECT * FROM schedule WHERE CourseID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLocationID($value){
		$sql = 'SELECT * FROM schedule WHERE LocationID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDate($value){
		$sql = 'SELECT * FROM schedule WHERE Date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByBeginTime($value){
		$sql = 'SELECT * FROM schedule WHERE BeginTime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEndTime($value){
		$sql = 'SELECT * FROM schedule WHERE EndTime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByStatus($value){
		$sql = 'SELECT * FROM schedule WHERE Status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByUsername($value){
		$sql = 'DELETE FROM schedule WHERE Username = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTutorID($value){
		$sql = 'DELETE FROM schedule WHERE TutorID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCourseID($value){
		$sql = 'DELETE FROM schedule WHERE CourseID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLocationID($value){
		$sql = 'DELETE FROM schedule WHERE LocationID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDate($value){
		$sql = 'DELETE FROM schedule WHERE Date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByBeginTime($value){
		$sql = 'DELETE FROM schedule WHERE BeginTime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEndTime($value){
		$sql = 'DELETE FROM schedule WHERE EndTime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByStatus($value){
		$sql = 'DELETE FROM schedule WHERE Status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ScheduleMySql 
	 */
	protected function readRow($row){
		$schedule = new Schedule();
		
		$schedule->scheduleID = $row['ScheduleID'];
		$schedule->username = $row['Username'];
		$schedule->tutorID = $row['TutorID'];
		$schedule->courseID = $row['CourseID'];
		$schedule->locationID = $row['LocationID'];
		$schedule->date = $row['Date'];
		$schedule->beginTime = $row['BeginTime'];
		$schedule->endTime = $row['EndTime'];
		$schedule->status = $row['Status'];

		return $schedule;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return ScheduleMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>
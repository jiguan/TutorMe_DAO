<?php
/**
 * Class that operate on table 'timetable'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
class TimetableMySqlDAO implements TimetableDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return TimetableMySql 
	 */
	public function load($tutorID, $date, $beginTime, $endTime){
		$sql = 'SELECT * FROM timetable WHERE TutorID = ?  AND Date = ?  AND BeginTime = ?  AND EndTime = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($tutorID);
		$sqlQuery->setNumber($date);
		$sqlQuery->setNumber($beginTime);
		$sqlQuery->setNumber($endTime);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM timetable';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM timetable ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param timetable primary key
 	 */
	public function delete($tutorID, $date, $beginTime, $endTime){
		$sql = 'DELETE FROM timetable WHERE TutorID = ?  AND Date = ?  AND BeginTime = ?  AND EndTime = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($tutorID);
		$sqlQuery->setNumber($date);
		$sqlQuery->setNumber($beginTime);
		$sqlQuery->setNumber($endTime);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TimetableMySql timetable
 	 */
	public function insert($timetable){
		$sql = 'INSERT INTO timetable ( TutorID, Date, BeginTime, EndTime) VALUES ( ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($timetable->tutorID);

		$sqlQuery->setNumber($timetable->date);

		$sqlQuery->setNumber($timetable->beginTime);

		$sqlQuery->setNumber($timetable->endTime);

		$this->executeInsert($sqlQuery);	
		//$timetable->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param TimetableMySql timetable
 	 */
	public function update($timetable){
		$sql = 'UPDATE timetable SET  WHERE TutorID = ?  AND Date = ?  AND BeginTime = ?  AND EndTime = ? ';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($timetable->tutorID);

		$sqlQuery->setNumber($timetable->date);

		$sqlQuery->setNumber($timetable->beginTime);

		$sqlQuery->setNumber($timetable->endTime);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM timetable';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return TimetableMySql 
	 */
	protected function readRow($row){
		$timetable = new Timetable();
		
		$timetable->tutorID = $row['TutorID'];
		$timetable->date = $row['Date'];
		$timetable->beginTime = $row['BeginTime'];
		$timetable->endTime = $row['EndTime'];

		return $timetable;
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
	 * @return TimetableMySql 
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
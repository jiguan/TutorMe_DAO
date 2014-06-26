<?php
/**
 * Class that operate on table 'courseoffer'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
class CourseofferMySqlDAO implements CourseofferDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return CourseofferMySql 
	 */
	public function load($courseID, $tutorID){
		$sql = 'SELECT * FROM courseoffer WHERE CourseID = ?  AND TutorID = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($courseID);
		$sqlQuery->setNumber($tutorID);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM courseoffer';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM courseoffer ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param courseoffer primary key
 	 */
	public function delete($courseID, $tutorID){
		$sql = 'DELETE FROM courseoffer WHERE CourseID = ?  AND TutorID = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($courseID);
		$sqlQuery->setNumber($tutorID);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CourseofferMySql courseoffer
 	 */
	public function insert($courseoffer){
		$sql = 'INSERT INTO courseoffer ( CourseID, TutorID) VALUES ( ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($courseoffer->courseID);

		$sqlQuery->setNumber($courseoffer->tutorID);

		$this->executeInsert($sqlQuery);	
		//$courseoffer->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param CourseofferMySql courseoffer
 	 */
	public function update($courseoffer){
		$sql = 'UPDATE courseoffer SET  WHERE CourseID = ?  AND TutorID = ? ';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($courseoffer->courseID);

		$sqlQuery->setNumber($courseoffer->tutorID);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM courseoffer';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return CourseofferMySql 
	 */
	protected function readRow($row){
		$courseoffer = new Courseoffer();
		
		$courseoffer->courseID = $row['CourseID'];
		$courseoffer->tutorID = $row['TutorID'];

		return $courseoffer;
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
	 * @return CourseofferMySql 
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
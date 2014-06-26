<?php
/**
 * Class that operate on table 'course'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
class CourseMySqlDAO implements CourseDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return CourseMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM course WHERE CourseID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM course';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM course ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param course primary key
 	 */
	public function delete($CourseID){
		$sql = 'DELETE FROM course WHERE CourseID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($CourseID);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CourseMySql course
 	 */
	public function insert($course){
		$sql = 'INSERT INTO course (CourseName, Description) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($course->courseName);
		$sqlQuery->set($course->description);

		$id = $this->executeInsert($sqlQuery);	
		$course->courseID = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param CourseMySql course
 	 */
	public function update($course){
		$sql = 'UPDATE course SET CourseName = ?, Description = ? WHERE CourseID = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($course->courseName);
		$sqlQuery->set($course->description);

		$sqlQuery->set($course->courseID);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM course';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByCourseName($value){
		$sql = 'SELECT * FROM course WHERE CourseName = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDescription($value){
		$sql = 'SELECT * FROM course WHERE Description = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByCourseName($value){
		$sql = 'DELETE FROM course WHERE CourseName = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDescription($value){
		$sql = 'DELETE FROM course WHERE Description = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return CourseMySql 
	 */
	protected function readRow($row){
		$course = new Course();
		
		$course->courseID = $row['CourseID'];
		$course->courseName = $row['CourseName'];
		$course->description = $row['Description'];

		return $course;
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
	 * @return CourseMySql 
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
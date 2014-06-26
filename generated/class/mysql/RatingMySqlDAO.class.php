<?php
/**
 * Class that operate on table 'rating'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
class RatingMySqlDAO implements RatingDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return RatingMySql 
	 */
	public function load($username, $tutorID, $courseID){
		$sql = 'SELECT * FROM rating WHERE Username = ?  AND TutorID = ?  AND CourseID = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($username);
		$sqlQuery->set($tutorID);
		$sqlQuery->set($courseID);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM rating';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM rating ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param rating primary key
 	 */
	public function delete($username, $tutorID, $courseID){
		$sql = 'DELETE FROM rating WHERE Username = ?  AND TutorID = ?  AND CourseID = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($username);
		$sqlQuery->set($tutorID);
		$sqlQuery->set($courseID);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param RatingMySql rating
 	 */
	public function insert($rating){
		$sql = 'INSERT INTO rating (Rating, Username, TutorID, CourseID) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($rating->rating);

		
		$sqlQuery->set($rating->username);

		$sqlQuery->set($rating->tutorID);

		$sqlQuery->set($rating->courseID);

		$this->executeInsert($sqlQuery);	
		return $rating->rating;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param RatingMySql rating
 	 */
	public function update($rating){
		$sql = 'UPDATE rating SET Rating = ? WHERE Username = ?  AND TutorID = ?  AND CourseID = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($rating->rating);

		
		$sqlQuery->set($rating->username);

		$sqlQuery->set($rating->tutorID);

		$sqlQuery->set($rating->courseID);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM rating';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByRating($value){
		$sql = 'SELECT * FROM rating WHERE Rating = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByRating($value){
		$sql = 'DELETE FROM rating WHERE Rating = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return RatingMySql 
	 */
	protected function readRow($row){
		$rating = new Rating();
		
		$rating->username = $row['Username'];
		$rating->tutorID = $row['TutorID'];
		$rating->courseID = $row['CourseID'];
		$rating->rating = $row['Rating'];

		return $rating;
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
	 * @return RatingMySql 
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
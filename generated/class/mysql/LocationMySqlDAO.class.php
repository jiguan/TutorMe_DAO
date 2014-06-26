<?php
/**
 * Class that operate on table 'location'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
class LocationMySqlDAO implements LocationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return LocationMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM location WHERE LocationID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM location';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM location ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param location primary key
 	 */
	public function delete($LocationID){
		$sql = 'DELETE FROM location WHERE LocationID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($LocationID);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param LocationMySql location
 	 */
	public function insert($location){
		$sql = 'INSERT INTO location (Building, Floor, Room, Capacity) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($location->building);
		$sqlQuery->set($location->floor);
		$sqlQuery->set($location->room);
		$sqlQuery->setNumber($location->capacity);

		$id = $this->executeInsert($sqlQuery);	
		$location->locationID = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param LocationMySql location
 	 */
	public function update($location){
		$sql = 'UPDATE location SET Building = ?, Floor = ?, Room = ?, Capacity = ? WHERE LocationID = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($location->building);
		$sqlQuery->set($location->floor);
		$sqlQuery->set($location->room);
		$sqlQuery->setNumber($location->capacity);

		$sqlQuery->setNumber($location->locationID);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM location';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByBuilding($value){
		$sql = 'SELECT * FROM location WHERE Building = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFloor($value){
		$sql = 'SELECT * FROM location WHERE Floor = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByRoom($value){
		$sql = 'SELECT * FROM location WHERE Room = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCapacity($value){
		$sql = 'SELECT * FROM location WHERE Capacity = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByBuilding($value){
		$sql = 'DELETE FROM location WHERE Building = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFloor($value){
		$sql = 'DELETE FROM location WHERE Floor = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByRoom($value){
		$sql = 'DELETE FROM location WHERE Room = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCapacity($value){
		$sql = 'DELETE FROM location WHERE Capacity = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return LocationMySql 
	 */
	protected function readRow($row){
		$location = new Location();
		
		$location->locationID = $row['LocationID'];
		$location->building = $row['Building'];
		$location->floor = $row['Floor'];
		$location->room = $row['Room'];
		$location->capacity = $row['Capacity'];

		return $location;
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
	 * @return LocationMySql 
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
<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
interface LocationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Location 
	 */
	public function load($id);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param location primary key
 	 */
	public function delete($LocationID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Location location
 	 */
	public function insert($location);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Location location
 	 */
	public function update($location);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByBuilding($value);

	public function queryByFloor($value);

	public function queryByRoom($value);

	public function queryByCapacity($value);


	public function deleteByBuilding($value);

	public function deleteByFloor($value);

	public function deleteByRoom($value);

	public function deleteByCapacity($value);


}
?>
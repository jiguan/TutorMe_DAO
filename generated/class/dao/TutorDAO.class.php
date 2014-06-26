<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
interface TutorDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Tutor 
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
 	 * @param tutor primary key
 	 */
	public function delete($TutorID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Tutor tutor
 	 */
	public function insert($tutor);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Tutor tutor
 	 */
	public function update($tutor);	

	/**
	 * Delete all rows
	 */
	public function clean();



}
?>
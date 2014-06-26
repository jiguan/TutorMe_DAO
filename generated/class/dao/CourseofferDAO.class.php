<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
interface CourseofferDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Courseoffer 
	 */
	public function load($courseID, $tutorID);

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
 	 * @param courseoffer primary key
 	 */
	public function delete($courseID, $tutorID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Courseoffer courseoffer
 	 */
	public function insert($courseoffer);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Courseoffer courseoffer
 	 */
	public function update($courseoffer);	

	/**
	 * Delete all rows
	 */
	public function clean();



}
?>
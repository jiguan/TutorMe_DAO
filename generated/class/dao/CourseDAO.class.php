<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
interface CourseDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Course 
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
 	 * @param course primary key
 	 */
	public function delete($CourseID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Course course
 	 */
	public function insert($course);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Course course
 	 */
	public function update($course);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByCourseName($value);

	public function queryByDescription($value);


	public function deleteByCourseName($value);

	public function deleteByDescription($value);


}
?>
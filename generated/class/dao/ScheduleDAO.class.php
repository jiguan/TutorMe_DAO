<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
interface ScheduleDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Schedule 
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
 	 * @param schedule primary key
 	 */
	public function delete($ScheduleID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Schedule schedule
 	 */
	public function insert($schedule);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Schedule schedule
 	 */
	public function update($schedule);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByUsername($value);

	public function queryByTutorID($value);

	public function queryByCourseID($value);

	public function queryByLocationID($value);

	public function queryByDate($value);

	public function queryByBeginTime($value);

	public function queryByEndTime($value);

	public function queryByStatus($value);


	public function deleteByUsername($value);

	public function deleteByTutorID($value);

	public function deleteByCourseID($value);

	public function deleteByLocationID($value);

	public function deleteByDate($value);

	public function deleteByBeginTime($value);

	public function deleteByEndTime($value);

	public function deleteByStatus($value);


}
?>
<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
interface TimetableDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Timetable 
	 */
	public function load($tutorID, $date, $beginTime, $endTime);

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
 	 * @param timetable primary key
 	 */
	public function delete($tutorID, $date, $beginTime, $endTime);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Timetable timetable
 	 */
	public function insert($timetable);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Timetable timetable
 	 */
	public function update($timetable);	

	/**
	 * Delete all rows
	 */
	public function clean();



}
?>
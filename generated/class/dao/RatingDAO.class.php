<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
interface RatingDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Rating 
	 */
	public function load($username, $tutorID, $courseID);

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
 	 * @param rating primary key
 	 */
	public function delete($username, $tutorID, $courseID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Rating rating
 	 */
	public function insert($rating);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Rating rating
 	 */
	public function update($rating);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByRating($value);


	public function deleteByRating($value);


}
?>
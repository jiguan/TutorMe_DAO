<?php
/**
 * Class that operate on table 'location'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
class LocationMySqlExtDAO extends LocationMySqlDAO{
	public function queryAvailableLocation($date, $beginTime, $endTime){
		$sql = 'SELECT * FROM Location WHERE LocationID NOT IN 
		( SELECT LocationID FROM Schedule S WHERE S.Date = ? 
		AND ( (S.BeginTime <= ? AND S.EndTime > ?) 
		OR (S.BeginTime < ? AND S.EndTime >= ? ) ) )';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($date);
		$sqlQuery->set($beginTime);
		$sqlQuery->set($beginTime);
		$sqlQuery->set($endTime);
		$sqlQuery->set($endtim);
		return $this->getList($sqlQuery);
	}
	
}
?>
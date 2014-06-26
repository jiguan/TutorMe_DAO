<?php
/**
 * Class that operate on table 'user'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-06-25 19:25
 */
class UserMySqlExtDAO extends UserMySqlDAO{
	
	public function queryByUsernameAndPassword($username, $password){
		$sql = 'SELECT * FROM user WHERE Username = ? AND Password = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($username);
		$sqlQuery->set($password);
		return $this->getList($sqlQuery);
	}
}
?>
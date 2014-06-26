<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return CourseDAO
	 */
	public static function getCourseDAO(){
		return new CourseMySqlExtDAO();
	}

	/**
	 * @return CourseofferDAO
	 */
	public static function getCourseofferDAO(){
		return new CourseofferMySqlExtDAO();
	}

	/**
	 * @return LocationDAO
	 */
	public static function getLocationDAO(){
		return new LocationMySqlExtDAO();
	}

	/**
	 * @return RatingDAO
	 */
	public static function getRatingDAO(){
		return new RatingMySqlExtDAO();
	}

	/**
	 * @return ScheduleDAO
	 */
	public static function getScheduleDAO(){
		return new ScheduleMySqlExtDAO();
	}

	/**
	 * @return TimetableDAO
	 */
	public static function getTimetableDAO(){
		return new TimetableMySqlExtDAO();
	}

	/**
	 * @return TutorDAO
	 */
	public static function getTutorDAO(){
		return new TutorMySqlExtDAO();
	}

	/**
	 * @return UserDAO
	 */
	public static function getUserDAO(){
		return new UserMySqlExtDAO();
	}


}
?>
<?php
require_once 'BaseDao.php';

class CourseDao extends BaseDao
{
  public function __construct()
  {
    parent::__construct("courses");
  }

  public function get_courses_by_category($category_id)
  {
    return $this->query("SELECT * FROM courses WHERE category_id = :category_id", ['category_id' => $category_id]);
  }

  public function get_courses_by_instructor($instructor_id)
  {
    return $this->query("SELECT * FROM courses WHERE instructor_id = :instructor_id", ['instructor_id' => $instructor_id]);
  }
}

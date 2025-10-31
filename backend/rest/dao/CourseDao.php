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

  public function delete_course($course_id)
  {
    return $this->delete($course_id);
  }

  public function delete_course_by_instructor($course_id, $instructor_id)
  {
    $stmt = $this->connection->prepare("DELETE FROM courses WHERE id = :id AND instructor_id = :instructor_id");
    $stmt->execute(['id' => $course_id, 'instructor_id' => $instructor_id]);
    return $stmt->rowCount() > 0;
  }
}

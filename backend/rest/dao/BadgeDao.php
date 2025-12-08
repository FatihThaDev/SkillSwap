<?php
require_once 'BaseDao.php';

class BadgeDao extends BaseDao
{
  public function __construct()
  {
    parent::__construct("badges");
  }

  public function getAll()
  {
    $query = "SELECT b.*, c.title as course_name 
              FROM badges b 
              LEFT JOIN courses c ON b.course_id = c.id";
    return $this->query($query, []);
  }

  public function get_badges_by_course_id($course_id)
  {
    return $this->query("SELECT * FROM badges WHERE course_id = :course_id", ['course_id' => $course_id]);
  }
}

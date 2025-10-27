<?php
require_once 'BaseDao.php';

class BadgeDao extends BaseDao
{
  public function __construct()
  {
    parent::__construct("badges");
  }

  public function get_badges_by_course_id($course_id)
  {
    return $this->query("SELECT * FROM badges WHERE course_id = :course_id", ['course_id' => $course_id]);
  }
}

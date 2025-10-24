<?php
require_once 'BaseDao.php';

class UserCoursesDao extends BaseDao
{
  public function __construct()
  {
    parent::__construct("user_courses");
  }

  public function get_courses_by_user($user_id)
  {
    return $this->query("SELECT c.*, uc.id as enrollment_id FROM courses c 
                        JOIN user_courses uc ON c.id = uc.course_id 
                        WHERE uc.user_id = :user_id", ['user_id' => $user_id]);
  }

  public function get_users_by_course($course_id)
  {
    return $this->query("SELECT u.*, uc.id as enrollment_id FROM users u 
                        JOIN user_courses uc ON u.id = uc.user_id 
                        WHERE uc.course_id = :course_id", ['course_id' => $course_id]);
  }

  public function enroll_user_in_course($user_id, $course_id)
  {
    $enrollment = [
      'user_id' => $user_id,
      'course_id' => $course_id
    ];
    return $this->add($enrollment);
  }

  public function unenroll_user_from_course($user_id, $course_id)
  {
    return $this->query("DELETE FROM user_courses WHERE user_id = :user_id AND course_id = :course_id", 
                       ['user_id' => $user_id, 'course_id' => $course_id]);
  }

  public function is_user_enrolled($user_id, $course_id)
  {
    $result = $this->query_unique("SELECT * FROM user_courses WHERE user_id = :user_id AND course_id = :course_id", 
                                 ['user_id' => $user_id, 'course_id' => $course_id]);
    return $result !== false;
  }
}

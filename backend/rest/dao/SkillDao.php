<?php
require_once 'BaseDao.php';

class SkillDao extends BaseDao
{
  public function __construct()
  {
    parent::__construct("skills");
  }

  public function get_skills_by_user_id($user_id)
  {
    return $this->query("SELECT * FROM skills WHERE user_id = :user_id", ['user_id' => $user_id]);
  }
}

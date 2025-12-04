<?php
require_once 'BaseDao.php';

class SkillDao extends BaseDao
{
  public function __construct()
  {
    parent::__construct("skills");
  }

  public function getAll()
  {
    $query = "SELECT s.*, s.experience_level as level, u.name as user_name 
              FROM skills s 
              LEFT JOIN users u ON s.user_id = u.id";
    return $this->query($query, []);
  }

  public function get_skills_by_user_id($user_id)
  {
    return $this->query("SELECT * FROM skills WHERE user_id = :user_id", ['user_id' => $user_id]);
  }
}

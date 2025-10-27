<?php
require_once 'BaseDao.php';

class CategoryDao extends BaseDao
{
  public function __construct()
  {
    parent::__construct("categories");
  }

  public function create_category($category)
  {
    return $this->add($category);
  }
}

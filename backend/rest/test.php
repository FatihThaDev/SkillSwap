<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/dao/UserDao.php';
require_once __DIR__ . '/dao/CourseDao.php';
require_once __DIR__ . '/dao/SkillDao.php';
require_once __DIR__ . '/dao/CategoryDao.php';
require_once __DIR__ . '/dao/BadgeDao.php';

$userDao = new UserDao();
$courseDao = new CourseDao();
$skillDao = new SkillDao();
$categoryDao = new CategoryDao();
$badgeDao = new BadgeDao();

echo "<h1>SkillSwap DAO Test</h1>";

// Test 1: Add a new user
echo "<h2>Testing User DAO...</h2>";
$newUser = [
  'name' => 'John Smith',
  'username' => 'johnsmith' . time(),
  'email' => 'john' . time() . '@example.com',
  'password' => password_hash('password456', PASSWORD_DEFAULT),
  'role' => 'User'
];
$addedUser = $userDao->add($newUser);
echo "<pre>";
print_r($addedUser);
echo "</pre>";
echo "User added successfully.<hr>";

// Test 2: Add a new category
echo "<h2>Testing Category DAO...</h2>";
$newCategory = [
  'name' => 'Technology ' . time(),
  'description' => 'Learn about programming, software, and more.'
];
$addedCategory = $categoryDao->add($newCategory);
echo "<pre>";
print_r($addedCategory);
echo "</pre>";
echo "Category added successfully.<hr>";

// Test 3: Add a new course
echo "<h2>Testing Course DAO...</h2>";
$newCourse = [
  'instructor_id' => $addedUser['id'],
  'category_id' => $addedCategory['id'],
  'title' => 'Introduction to PHP ' . time(),
  'description' => 'A beginner-friendly course on PHP.'
  ];
$addedCourse = $courseDao->add($newCourse);
echo "<pre>";
print_r($addedCourse);
echo "</pre>";
echo "Course added successfully.<hr>";


// Test 4: Fetch all users
echo "<h2>Fetching all users...</h2>";
$allUsers = $userDao->getAll();
echo "<pre>";
print_r($allUsers);
echo "</pre>";
echo "All users fetched.<hr>";

echo "<h2>Test Complete!</h2>";

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/dao/UserDao.php';
require_once __DIR__ . '/dao/CourseDao.php';
require_once __DIR__ . '/dao/SkillDao.php';
require_once __DIR__ . '/dao/CategoryDao.php';
require_once __DIR__ . '/dao/BadgeDao.php';
require_once __DIR__ . '/dao/UserCoursesDao.php';
require_once __DIR__ . '/services/CourseService.php';

$userDao = new UserDao();
$courseDao = new CourseDao();
$skillDao = new SkillDao();
$categoryDao = new CategoryDao();
$badgeDao = new BadgeDao();
$userCoursesDao = new UserCoursesDao();
$courseService = new CourseService();

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

// Test 5: Add a new skill for the user
echo "<h2>Testing Skill DAO (insert)...</h2>";
$newSkill = [
  'user_id' => $addedUser['id'],
  'name' => 'PHP',
  'description' => 'Basic PHP knowledge',
  'experience_level' => 'beginner'
];
$addedSkill = $skillDao->add($newSkill);
echo "<pre>";
print_r($addedSkill);
echo "</pre>";
echo "Skill added successfully.<hr>";

// Test 6: Add a badge for the course
echo "<h2>Testing Badge DAO (insert)...</h2>";
$newBadge = [
  'course_id' => $addedCourse['id'],
  'name' => 'PHP Starter',
  'description' => 'Completed intro course'
];
$addedBadge = $badgeDao->add($newBadge);
echo "<pre>";
print_r($addedBadge);
echo "</pre>";
echo "Badge added successfully.<hr>";

// Test 7: Enroll user into course
echo "<h2>Testing UserCourses DAO (enroll)...</h2>";
$enrollment = $userCoursesDao->enroll_user_in_course($addedUser['id'], $addedCourse['id']);
echo "<pre>";
print_r($enrollment);
echo "</pre>";
echo "User enrolled successfully.<hr>";

// Test 8: Unenroll user from course
echo "<h2>Testing UserCourses DAO (unenroll)...</h2>";
$unenrollResult = $userCoursesDao->unenroll_user_from_course($addedUser['id'], $addedCourse['id']);
echo "Unenroll result: ";
var_dump($unenrollResult);
echo "<hr>";

// Test 9: Delete badge
echo "<h2>Testing Badge DAO (delete)...</h2>";
$badgeDelete = $badgeDao->delete($addedBadge['id']);
echo "Badge delete result: ";
var_dump($badgeDelete);
echo "<hr>";

// Test 10: Delete skill
echo "<h2>Testing Skill DAO (delete)...</h2>";
$skillDelete = $skillDao->delete($addedSkill['id']);
echo "Skill delete result: ";
var_dump($skillDelete);
echo "<hr>";

// Test 11: User-scoped course deletion (only instructor can delete)
echo "<h2>Testing CourseService (user-scoped delete)...</h2>";
$userDeleteCourse = $courseService->delete_course_as_user($addedCourse['id'], $addedUser['id']);
echo "<pre>";
print_r($userDeleteCourse);
echo "</pre>";
echo "User-scoped course deletion attempted.<hr>";

// Final cleanup: delete category and user
echo "<h2>Final Cleanup...</h2>";
$categoryDelete = $categoryDao->delete($addedCategory['id']);
echo "Category delete result: ";
var_dump($categoryDelete);
echo "<br>";
$userDelete = $userDao->delete($addedUser['id']);
echo "User delete result: ";
var_dump($userDelete);
echo "<hr>";

echo "<h2>Test Complete!</h2>";

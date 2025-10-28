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
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/UserCoursesService.php';

$userDao = new UserDao();
$courseDao = new CourseDao();
$skillDao = new SkillDao();
$categoryDao = new CategoryDao();
$badgeDao = new BadgeDao();
$userCoursesDao = new UserCoursesDao();
$userService = new UserService();
$userCoursesService = new UserCoursesService();

echo "<h1>SkillSwap DAO Test</h1>";

// Test 1: Add a new user
echo "<h2>Testing User DAO...</h2>";
$newUser = [
  'name' => 'John Smith',
  'username' => 'johnsmith',
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
  'name' => 'Technology ',
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
  'title' => 'Introduction to PHP ',
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

// Test 5: Update user information
echo "<h2>Testing User Update...</h2>";
$updateData = [
  'name' => 'John Smith Updated',
  'role' => 'admin'
];
$updatedUser = $userDao->update($updateData, $addedUser['id']);
echo "<pre>";
print_r($updatedUser);
echo "</pre>";
echo "User updated successfully.<hr>";

// Test 6: Get user by username
echo "<h2>Testing get_user_by_username...</h2>";
$foundUser = $userDao->get_user_by_username('johnsmith');
echo "<pre>";
print_r($foundUser);
echo "</pre>";
echo "User found by username.<hr>";

// Test 7: Get courses by category
echo "<h2>Testing get_courses_by_category...</h2>";
$coursesByCategory = $courseDao->get_courses_by_category($addedCategory['id']);
echo "<pre>";
print_r($coursesByCategory);
echo "</pre>";
echo "Courses by category fetched.<hr>";

// Test 8: Update course information
echo "<h2>Testing Course Update...</h2>";
$courseUpdateData = [
  'title' => 'Advanced PHP Programming',
  'description' => 'An advanced course covering PHP best practices and frameworks.'
];
$updatedCourse = $courseDao->update($courseUpdateData, $addedCourse['id']);
echo "<pre>";
print_r($updatedCourse);
echo "</pre>";
echo "Course updated successfully.<hr>";

// Test 9: Add a badge
echo "<h2>Testing Badge Creation...</h2>";
$newBadge = [
  'course_id' => $addedCourse['id'],
  'name' => 'PHP Beginner Badge',
  'description' => 'Awarded for completing the PHP course'
];
$addedBadge = $badgeDao->add($newBadge);
echo "<pre>";
print_r($addedBadge);
echo "</pre>";
echo "Badge added successfully.<hr>";

// Test 10: Get badges by course
echo "<h2>Testing get_badges_by_course_id...</h2>";
$badgesByCourse = $badgeDao->get_badges_by_course_id($addedCourse['id']);
echo "<pre>";
print_r($badgesByCourse);
echo "</pre>";
echo "Badges by course fetched.<hr>";

// Test 11: Delete badge
echo "<h2>Testing Badge Deletion...</h2>";
$deleteResult = $badgeDao->delete($addedBadge['id']);
echo "Badge deletion result: " . ($deleteResult ? "Success" : "Failed") . "<hr>";

echo "<h2>All CRUD Tests Complete!</h2>";

// Test 15: Test User-Course Enrollment
echo "<h2>Testing User-Course Enrollment...</h2>";
$enrollmentResult = $userCoursesService->enroll_in_course($addedUser['id'], $addedCourse['id']);
echo "<pre>";
print_r($enrollmentResult);
echo "</pre>";
echo "User enrolled in course.<hr>";

// Test 16: Test Getting User's Courses
echo "<h2>Testing get_user_courses...</h2>";
$userCourses = $userCoursesService->get_user_courses($addedUser['id']);
echo "<pre>";
print_r($userCourses);
echo "</pre>";
echo "User courses fetched.<hr>";

// Test 17: Test User Service - Get All Users
echo "<h2>Testing User Service - Get All Users...</h2>";
$allUsersAdmin = $userService->get_all_users();
echo "<pre>";
print_r($allUsersAdmin);
echo "</pre>";
echo "All users fetched by admin.<hr>";

// Test 18: Test User Service - Get Users Enrolled in Course
echo "<h2>Testing User Service - Get Users Enrolled in Course...</h2>";
$enrolledUsers = $userService->get_users_enrolled_in_course($addedCourse['id']);
echo "<pre>";
print_r($enrolledUsers);
echo "</pre>";
echo "Users enrolled in course fetched.<hr>";

// Test 19: Test User Unenrollment
echo "<h2>Testing User Unenrollment...</h2>";
$unenrollmentResult = $userCoursesService->unenroll_from_course($addedUser['id'], $addedCourse['id']);
echo "<pre>";
print_r($unenrollmentResult);
echo "</pre>";
echo "User unenrolled from course.<hr>";

// Test 20: Test User Service - Delete Course
echo "<h2>Testing User Service - Delete Course...</h2>";
$courseDeleteResult = $userService->delete_course($addedCourse['id']);
echo "Course deletion by admin result: " . ($courseDeleteResult ? "Success" : "Failed") . "<hr>";

// Test 21: Clean up - Delete remaining entities
echo "<h2>Final Cleanup...</h2>";
$categoryDeleteResult = $categoryDao->delete($addedCategory['id']);
echo "Category deletion result: " . ($categoryDeleteResult ? "Success" : "Failed") . "<hr>";

$userDeleteResult = $userDao->delete($addedUser['id']);
echo "User deletion result: " . ($userDeleteResult ? "Success" : "Failed") . "<hr>";

echo "<h2>All Service Tests Complete!</h2>";

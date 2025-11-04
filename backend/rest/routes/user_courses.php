<?php
require_once __DIR__ . '/../services/UserCoursesService.php';

$userCoursesService = new UserCoursesService();

// User Courses
Flight::route('GET /users/@user_id/courses', function($user_id) use ($userCoursesService) {
  Flight::json($userCoursesService->get_user_courses($user_id));
});

Flight::route('POST /users/@user_id/courses/@course_id', function($user_id, $course_id) use ($userCoursesService) {
  Flight::json($userCoursesService->enroll_in_course($user_id, $course_id));
});

Flight::route('DELETE /users/@user_id/courses/@course_id', function($user_id, $course_id) use ($userCoursesService) {
  Flight::json($userCoursesService->unenroll_from_course($user_id, $course_id));
});

Flight::route('GET /users/@user_id/courses/@course_id/enrolled', function($user_id, $course_id) use ($userCoursesService) {
  Flight::json($userCoursesService->is_enrolled($user_id, $course_id));
});



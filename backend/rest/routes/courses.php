<?php
require_once __DIR__ . '/../services/CourseService.php';

$courseService = new CourseService();

// Courses
Flight::route('GET /courses', function() use ($courseService) {
  Flight::json($courseService->get_all_courses());
});

Flight::route('GET /courses/@id', function($id) use ($courseService) {
  Flight::json($courseService->get_course_by_id($id));
});

Flight::route('GET /categories/@category_id/courses', function($category_id) use ($courseService) {
  Flight::json($courseService->get_courses_by_category($category_id));
});

Flight::route('GET /instructors/@instructor_id/courses', function($instructor_id) use ($courseService) {
  Flight::json($courseService->get_courses_by_instructor($instructor_id));
});

Flight::route('POST /courses', function() use ($courseService) {
  $data = Flight::request()->data->getData();
  Flight::json($courseService->create_course($data));
});

Flight::route('PUT /courses/@id', function($id) use ($courseService) {
  $data = Flight::request()->data->getData();
  Flight::json($courseService->update_course($id, $data));
});

Flight::route('DELETE /courses/@id', function($id) use ($courseService) {
  Flight::json($courseService->delete_course($id));
});

Flight::route('DELETE /instructors/@user_id/courses/@course_id', function($user_id, $course_id) use ($courseService) {
  Flight::json($courseService->delete_course_as_user($course_id, $user_id));
});



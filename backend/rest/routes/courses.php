<?php
require_once __DIR__ . '/../services/CourseService.php';
use OpenApi\Annotations as OA;

$courseService = new CourseService();

// Courses
/**
 * @OA\Get(
 *   path="/courses",
 *   summary="List all courses",
 *   tags={"Courses"},
 *   @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\JsonContent(type="array", @OA\Items(type="object"))
 *   )
 * )
 */
Flight::route('GET /courses', function() use ($courseService) {
  Flight::json($courseService->get_all_courses());
});

/**
 * @OA\Get(
 *   path="/courses/{id}",
 *   summary="Get course by ID",
 *   tags={"Courses"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Course ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\JsonContent(type="object")
 *   ),
 *   @OA\Response(response=404, description="Course not found")
 * )
 */
Flight::route('GET /courses/@id', function($id) use ($courseService) {
  Flight::json($courseService->get_course_by_id($id));
});

/**
 * @OA\Get(
 *   path="/categories/{category_id}/courses",
 *   summary="List courses by category",
 *   tags={"Courses"},
 *   @OA\Parameter(
 *     name="category_id",
 *     in="path",
 *     required=true,
 *     description="Category ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\JsonContent(type="array", @OA\Items(type="object"))
 *   )
 * )
 */
Flight::route('GET /categories/@category_id/courses', function($category_id) use ($courseService) {
  Flight::json($courseService->get_courses_by_category($category_id));
});

/**
 * @OA\Get(
 *   path="/instructors/{instructor_id}/courses",
 *   summary="List courses by instructor",
 *   tags={"Courses"},
 *   @OA\Parameter(
 *     name="instructor_id",
 *     in="path",
 *     required=true,
 *     description="Instructor (user) ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\JsonContent(type="array", @OA\Items(type="object"))
 *   )
 * )
 */
Flight::route('GET /instructors/@instructor_id/courses', function($instructor_id) use ($courseService) {
  Flight::json($courseService->get_courses_by_instructor($instructor_id));
});

/**
 * @OA\Post(
 *   path="/courses",
 *   summary="Create a course",
 *   tags={"Courses"},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(type="object")
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Course created",
 *     @OA\JsonContent(type="object")
 *   ),
 *   @OA\Response(response=400, description="Invalid input")
 * )
 */
Flight::route('POST /courses', function() use ($courseService) {
  $data = Flight::request()->data->getData();
  Flight::json($courseService->create_course($data));
});

/**
 * @OA\Put(
 *   path="/courses/{id}",
 *   summary="Update a course",
 *   tags={"Courses"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Course ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(type="object")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Course updated",
 *     @OA\JsonContent(type="object")
 *   ),
 *   @OA\Response(response=400, description="Invalid input"),
 *   @OA\Response(response=404, description="Course not found")
 * )
 */
Flight::route('PUT /courses/@id', function($id) use ($courseService) {
  $data = Flight::request()->data->getData();
  Flight::json($courseService->update_course($id, $data));
});

/**
 * @OA\Delete(
 *   path="/courses/{id}",
 *   summary="Delete a course",
 *   tags={"Courses"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Course ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(response=200, description="Course deleted"),
 *   @OA\Response(response=404, description="Course not found")
 * )
 */
Flight::route('DELETE /courses/@id', function($id) use ($courseService) {
  Flight::json($courseService->delete_course($id));
});

/**
 * @OA\Delete(
 *   path="/instructors/{user_id}/courses/{course_id}",
 *   summary="Delete a course as a specific user",
 *   tags={"Courses"},
 *   @OA\Parameter(
 *     name="user_id",
 *     in="path",
 *     required=true,
 *     description="User ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Parameter(
 *     name="course_id",
 *     in="path",
 *     required=true,
 *     description="Course ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(response=200, description="Course deleted by user"),
 *   @OA\Response(response=404, description="Course not found")
 * )
 */
Flight::route('DELETE /instructors/@user_id/courses/@course_id', function($user_id, $course_id) use ($courseService) {
  Flight::json($courseService->delete_course_as_user($course_id, $user_id));
});



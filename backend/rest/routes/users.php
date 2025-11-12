<?php
require_once __DIR__ . '/../services/UserCoursesService.php';

use OpenApi\Annotations as OA;

$userCoursesService = new UserCoursesService();

/**
 * @OA\Get(
 *   path="/users/{user_id}/courses",
 *   summary="List user courses",
 *   tags={"User Courses"},
 *   @OA\Parameter(
 *     name="user_id",
 *     in="path",
 *     required=true,
 *     description="User ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(response=200, description="Courses retrieved successfully"),
 *   @OA\Response(response=404, description="User or courses not found")
 * )
 */
Flight::route('GET /users/@user_id/courses', function ($user_id) use ($userCoursesService) {
  Flight::json($userCoursesService->get_user_courses($user_id));
});

/**
 * @OA\Post(
 *   path="/users/{user_id}/courses/{course_id}",
 *   summary="Enroll a user in a course",
 *   tags={"User Courses"},
 *   @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer")),
 *   @OA\Parameter(name="course_id", in="path", required=true, @OA\Schema(type="integer")),
 *   @OA\Response(response=201, description="User enrolled successfully"),
 *   @OA\Response(response=400, description="Invalid input or already enrolled"),
 *   @OA\Response(response=404, description="Course or user not found")
 * )
 */
Flight::route('POST /users/@user_id/courses/@course_id', function ($user_id, $course_id) use ($userCoursesService) {
  Flight::json($userCoursesService->enroll_in_course($user_id, $course_id));
});

/**
 * @OA\Delete(
 *   path="/users/{user_id}/courses/{course_id}",
 *   summary="Unenroll a user from a course",
 *   tags={"User Courses"},
 *   @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer")),
 *   @OA\Parameter(name="course_id", in="path", required=true, @OA\Schema(type="integer")),
 *   @OA\Response(response=200, description="User unenrolled successfully"),
 *   @OA\Response(response=404, description="Enrollment not found")
 * )
 */
Flight::route('DELETE /users/@user_id/courses/@course_id', function ($user_id, $course_id) use ($userCoursesService) {
  Flight::json($userCoursesService->unenroll_from_course($user_id, $course_id));
});

/**
 * @OA\Get(
 *   path="/users/{user_id}/courses/{course_id}/enrolled",
 *   summary="Check if user is enrolled in a course",
 *   tags={"User Courses"},
 *   @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer")),
 *   @OA\Parameter(name="course_id", in="path", required=true, @OA\Schema(type="integer")),
 *   @OA\Response(response=200, description="Enrollment status retrieved successfully"),
 *   @OA\Response(response=404, description="User or course not found")
 * )
 */
Flight::route('GET /users/@user_id/courses/@course_id/enrolled', function ($user_id, $course_id) use ($userCoursesService) {
  Flight::json($userCoursesService->is_enrolled($user_id, $course_id));
});

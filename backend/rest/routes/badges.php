<?php
require_once __DIR__ . '/../services/BadgeService.php';
use OpenApi\Annotations as OA;

$badgeService = new BadgeService();

// Badges
/**
 * @OA\Get(
 *   path="/badges",
 *   summary="List all badges",
 *   tags={"Badges"},
 *   @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\JsonContent(type="array", @OA\Items(type="object"))
 *   )
 * )
 */
Flight::route('GET /badges', function() use ($badgeService) {
  Flight::json($badgeService->get_all_badges());
});

/**
 * @OA\Get(
 *   path="/badges/{id}",
 *   summary="Get badge by ID",
 *   tags={"Badges"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Badge ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\JsonContent(type="object")
 *   ),
 *   @OA\Response(response=404, description="Badge not found")
 * )
 */
Flight::route('GET /badges/@id', function($id) use ($badgeService) {
  Flight::json($badgeService->get_badge_by_id($id));
});

/**
 * @OA\Get(
 *   path="/courses/{course_id}/badges",
 *   summary="List badges by course",
 *   tags={"Badges"},
 *   @OA\Parameter(
 *     name="course_id",
 *     in="path",
 *     required=true,
 *     description="Course ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\JsonContent(type="array", @OA\Items(type="object"))
 *   )
 * )
 */
Flight::route('GET /courses/@course_id/badges', function($course_id) use ($badgeService) {
  Flight::json($badgeService->get_badges_by_course($course_id));
});

/**
 * @OA\Post(
 *   path="/badges",
 *   summary="Create a badge",
 *   tags={"Badges"},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(type="object")
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Badge created",
 *     @OA\JsonContent(type="object")
 *   ),
 *   @OA\Response(response=400, description="Invalid input")
 * )
 */
Flight::route('POST /badges', function() use ($badgeService) {
  $data = Flight::request()->data->getData();
  Flight::json($badgeService->create_badge($data));
});

/**
 * @OA\Put(
 *   path="/badges/{id}",
 *   summary="Update a badge",
 *   tags={"Badges"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Badge ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(type="object")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Badge updated",
 *     @OA\JsonContent(type="object")
 *   ),
 *   @OA\Response(response=400, description="Invalid input"),
 *   @OA\Response(response=404, description="Badge not found")
 * )
 */
Flight::route('PUT /badges/@id', function($id) use ($badgeService) {
  $data = Flight::request()->data->getData();
  Flight::json($badgeService->update_badge($id, $data));
});

/**
 * @OA\Delete(
 *   path="/badges/{id}",
 *   summary="Delete a badge",
 *   tags={"Badges"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Badge ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(response=200, description="Badge deleted"),
 *   @OA\Response(response=404, description="Badge not found")
 * )
 */
Flight::route('DELETE /badges/@id', function($id) use ($badgeService) {
  Flight::json($badgeService->delete_badge($id));
});



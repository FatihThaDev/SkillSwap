<?php
require_once __DIR__ . '/../services/SkillService.php';

use OpenApi\Annotations as OA;

$skillService = new SkillService();

/**
 * @OA\Get(
 *   path="/skills",
 *   summary="List all skills",
 *   tags={"Skills"},
 *   @OA\Response(
 *     response=200,
 *     description="Skills retrieved successfully",
 *     @OA\JsonContent(type="array", @OA\Items(type="object"))
 *   ),
 *   @OA\Response(response=404, description="No skills found")
 * )
 */
Flight::route('GET /skills', function () use ($skillService) {
  Flight::json($skillService->get_all_skills());
});

/**
 * @OA\Get(
 *   path="/skills/{id}",
 *   summary="Get skill by ID",
 *   tags={"Skills"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Skill ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(response=200, description="Skill retrieved successfully"),
 *   @OA\Response(response=404, description="Skill not found")
 * )
 */
Flight::route('GET /skills/@id', function ($id) use ($skillService) {
  Flight::json($skillService->get_skill_by_id($id));
});

/**
 * @OA\Get(
 *   path="/users/{user_id}/skills",
 *   summary="List skills for a user",
 *   tags={"Skills"},
 *   @OA\Parameter(
 *     name="user_id",
 *     in="path",
 *     required=true,
 *     description="User ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(response=200, description="Skills retrieved successfully"),
 *   @OA\Response(response=404, description="User or skills not found")
 * )
 */
Flight::route('GET /users/@user_id/skills', function ($user_id) use ($skillService) {
  Flight::json($skillService->get_skills_by_user($user_id));
});

/**
 * @OA\Post(
 *   path="/skills",
 *   summary="Create a skill",
 *   tags={"Skills"},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(type="object")
 *   ),
 *   @OA\Response(response=201, description="Skill created successfully"),
 *   @OA\Response(response=400, description="Invalid input")
 * )
 */
Flight::route('POST /skills', function () use ($skillService) {
  $data = Flight::request()->data->getData();
  Flight::json($skillService->create_skill($data));
});

/**
 * @OA\Put(
 *   path="/skills/{id}",
 *   summary="Update a skill",
 *   tags={"Skills"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Skill ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *   @OA\Response(response=200, description="Skill updated successfully"),
 *   @OA\Response(response=400, description="Invalid input"),
 *   @OA\Response(response=404, description="Skill not found")
 * )
 */
Flight::route('PUT /skills/@id', function ($id) use ($skillService) {
  $data = Flight::request()->data->getData();
  Flight::json($skillService->update_skill($id, $data));
});

/**
 * @OA\Delete(
 *   path="/skills/{id}",
 *   summary="Delete a skill",
 *   tags={"Skills"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Skill ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(response=200, description="Skill deleted successfully"),
 *   @OA\Response(response=404, description="Skill not found")
 * )
 */
Flight::route('DELETE /skills/@id', function ($id) use ($skillService) {
  Flight::json($skillService->delete_skill($id));
});

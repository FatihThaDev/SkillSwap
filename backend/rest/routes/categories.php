<?php
require_once __DIR__ . '/../services/CategoryService.php';

use OpenApi\Annotations as OA;

$categoryService = new CategoryService();

/**
 * @OA\Get(
 *   path="/categories",
 *   summary="List all categories",
 *   tags={"Categories"},
 *   @OA\Response(response=200, description="Categories retrieved successfully"),
 *   @OA\Response(response=404, description="No categories found")
 * )
 */
Flight::route('GET /categories', function () use ($categoryService) {
  Flight::json($categoryService->get_all_categories());
});

/**
 * @OA\Get(
 *   path="/categories/{id}",
 *   summary="Get category by ID",
 *   tags={"Categories"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Category ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(response=200, description="Category retrieved successfully"),
 *   @OA\Response(response=404, description="Category not found")
 * )
 */
Flight::route('GET /categories/@id', function ($id) use ($categoryService) {
  Flight::json($categoryService->get_category_by_id($id));
});

/**
 * @OA\Post(
 *   path="/categories",
 *   summary="Create a category",
 *   tags={"Categories"},
 *   @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *   @OA\Response(response=201, description="Category created successfully"),
 *   @OA\Response(response=400, description="Invalid input")
 * )
 */
Flight::route('POST /categories', function () use ($categoryService) {
  $data = Flight::request()->data->getData();
  Flight::json($categoryService->create_category($data));
});

/**
 * @OA\Put(
 *   path="/categories/{id}",
 *   summary="Update a category",
 *   tags={"Categories"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Category ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *   @OA\Response(response=200, description="Category updated successfully"),
 *   @OA\Response(response=400, description="Invalid input"),
 *   @OA\Response(response=404, description="Category not found")
 * )
 */
Flight::route('PUT /categories/@id', function ($id) use ($categoryService) {
  $data = Flight::request()->data->getData();
  Flight::json($categoryService->update_category($id, $data));
});

/**
 * @OA\Delete(
 *   path="/categories/{id}",
 *   summary="Delete a category",
 *   tags={"Categories"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Category ID",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(response=200, description="Category deleted successfully"),
 *   @OA\Response(response=404, description="Category not found")
 * )
 */
Flight::route('DELETE /categories/@id', function ($id) use ($categoryService) {
  Flight::json($categoryService->delete_category($id));
});

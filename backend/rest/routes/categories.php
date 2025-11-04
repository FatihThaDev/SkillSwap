<?php
require_once __DIR__ . '/../services/CategoryService.php';

$categoryService = new CategoryService();

// Categories
Flight::route('GET /categories', function() use ($categoryService) {
  Flight::json($categoryService->get_all_categories());
});

Flight::route('GET /categories/@id', function($id) use ($categoryService) {
  Flight::json($categoryService->get_category_by_id($id));
});

Flight::route('POST /categories', function() use ($categoryService) {
  $data = Flight::request()->data->getData();
  Flight::json($categoryService->create_category($data));
});

Flight::route('PUT /categories/@id', function($id) use ($categoryService) {
  $data = Flight::request()->data->getData();
  Flight::json($categoryService->update_category($id, $data));
});

Flight::route('DELETE /categories/@id', function($id) use ($categoryService) {
  Flight::json($categoryService->delete_category($id));
});



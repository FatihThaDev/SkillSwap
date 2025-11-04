<?php
require_once __DIR__ . '/../services/BadgeService.php';

$badgeService = new BadgeService();

// Badges
Flight::route('GET /badges', function() use ($badgeService) {
  Flight::json($badgeService->get_all_badges());
});

Flight::route('GET /badges/@id', function($id) use ($badgeService) {
  Flight::json($badgeService->get_badge_by_id($id));
});

Flight::route('GET /courses/@course_id/badges', function($course_id) use ($badgeService) {
  Flight::json($badgeService->get_badges_by_course($course_id));
});

Flight::route('POST /badges', function() use ($badgeService) {
  $data = Flight::request()->data->getData();
  Flight::json($badgeService->create_badge($data));
});

Flight::route('PUT /badges/@id', function($id) use ($badgeService) {
  $data = Flight::request()->data->getData();
  Flight::json($badgeService->update_badge($id, $data));
});

Flight::route('DELETE /badges/@id', function($id) use ($badgeService) {
  Flight::json($badgeService->delete_badge($id));
});



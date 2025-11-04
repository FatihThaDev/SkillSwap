<?php
require_once __DIR__ . '/../services/SkillService.php';

$skillService = new SkillService();

// Skills
Flight::route('GET /skills', function() use ($skillService) {
  Flight::json($skillService->get_all_skills());
});

Flight::route('GET /skills/@id', function($id) use ($skillService) {
  Flight::json($skillService->get_skill_by_id($id));
});

Flight::route('GET /users/@user_id/skills', function($user_id) use ($skillService) {
  Flight::json($skillService->get_skills_by_user($user_id));
});

Flight::route('POST /skills', function() use ($skillService) {
  $data = Flight::request()->data->getData();
  Flight::json($skillService->create_skill($data));
});

Flight::route('PUT /skills/@id', function($id) use ($skillService) {
  $data = Flight::request()->data->getData();
  Flight::json($skillService->update_skill($id, $data));
});

Flight::route('DELETE /skills/@id', function($id) use ($skillService) {
  Flight::json($skillService->delete_skill($id));
});



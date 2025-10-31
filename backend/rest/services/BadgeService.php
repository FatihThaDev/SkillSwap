<?php
require_once __DIR__ . '/../dao/BadgeDao.php';
require_once __DIR__ . '/../dao/CourseDao.php';

class BadgeService {
    private $badgeDao;
    private $courseDao;

    public function __construct(){
        $this->badgeDao = new BadgeDao();
        $this->courseDao = new CourseDao();
    }

    public function get_all_badges() {
        return $this->badgeDao->getAll();
    }

    public function get_badge_by_id($id) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid badge ID'];
        }
        return $this->badgeDao->getById($id);
    }

    public function get_badges_by_course($course_id) {
        if (!is_numeric($course_id) || $course_id <= 0) {
            return ['success' => false, 'message' => 'Invalid course ID'];
        }
        return $this->badgeDao->get_badges_by_course_id($course_id);
    }

    public function create_badge($badgeData) {
        $validation = $this->validate_badge_data($badgeData);
        if (!$validation['success']) {
            return $validation;
        }

        return $this->badgeDao->add($badgeData);
    }

    public function update_badge($id, $badgeData) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid badge ID'];
        }

        $validation = $this->validate_badge_data($badgeData);
        if (!$validation['success']) {
            return $validation;
        }

        return $this->badgeDao->update($badgeData, $id);
    }

    public function delete_badge($id) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid badge ID'];
        }
        return $this->badgeDao->delete($id);
    }

    private function validate_badge_data($badgeData) {
        $errors = [];
        
        if (empty($badgeData['name']) || strlen(trim($badgeData['name'])) < 2) {
            $errors[] = 'Badge name must be at least 2 characters long';
        }
        
        if (empty($badgeData['description']) || strlen(trim($badgeData['description'])) < 5) {
            $errors[] = 'Badge description must be at least 5 characters long';
        }
        
        if (!isset($badgeData['course_id']) || !is_numeric($badgeData['course_id']) || $badgeData['course_id'] <= 0) {
            $errors[] = 'Valid course ID is required';
        }
        
        return empty($errors) ? ['success' => true] : ['success' => false, 'errors' => $errors];
    }
}
?>

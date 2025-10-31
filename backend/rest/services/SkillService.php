<?php
require_once __DIR__ . '/../dao/SkillDao.php';
require_once __DIR__ . '/../dao/UserDao.php';

class SkillService {
    private $skillDao;
    private $userDao;

    public function __construct(){
        $this->skillDao = new SkillDao();
        $this->userDao = new UserDao();
    }

    public function get_all_skills() {
        return $this->skillDao->getAll();
    }

    public function get_skill_by_id($id) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid skill ID'];
        }
        return $this->skillDao->getById($id);
    }

    public function get_skills_by_user($user_id) {
        if (!is_numeric($user_id) || $user_id <= 0) {
            return ['success' => false, 'message' => 'Invalid user ID'];
        }
        return $this->skillDao->get_skills_by_user_id($user_id);
    }

    public function create_skill($skillData) {
        $validation = $this->validate_skill_data($skillData);
        if (!$validation['success']) {
            return $validation;
        }

        return $this->skillDao->add($skillData);
    }

    public function update_skill($id, $skillData) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid skill ID'];
        }

        $validation = $this->validate_skill_data($skillData);
        if (!$validation['success']) {
            return $validation;
        }

        return $this->skillDao->update($skillData, $id);
    }

    public function delete_skill($id) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid skill ID'];
        }
        return $this->skillDao->delete($id);
    }

    private function validate_skill_data($skillData) {
        $errors = [];
        
        if (empty($skillData['name']) || strlen(trim($skillData['name'])) < 2) {
            $errors[] = 'Skill name must be at least 2 characters long';
        }
        
        if (empty($skillData['description']) || strlen(trim($skillData['description'])) < 5) {
            $errors[] = 'Skill description must be at least 5 characters long';
        }
        
        if (!isset($skillData['user_id']) || !is_numeric($skillData['user_id']) || $skillData['user_id'] <= 0) {
            $errors[] = 'Valid user ID is required';
        }
        
        if (!isset($skillData['experience_level']) || !in_array($skillData['experience_level'], ['beginner', 'intermediate', 'expert'])) {
            $errors[] = 'Experience level must be one of: beginner, intermediate, expert';
        }
        
        return empty($errors) ? ['success' => true] : ['success' => false, 'errors' => $errors];
    }
}
?>

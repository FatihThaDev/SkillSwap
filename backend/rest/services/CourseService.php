<?php
require_once __DIR__ . '/../dao/CourseDao.php';
require_once __DIR__ . '/../dao/CategoryDao.php';

class CourseService {
    private $courseDao;
    private $categoryDao;

    public function __construct(){
        $this->courseDao = new CourseDao();
        $this->categoryDao = new CategoryDao();
    }

    public function get_all_courses() {
        return $this->courseDao->getAll();
    }

    public function get_course_by_id($id) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid course ID'];
        }
        return $this->courseDao->getById($id);
    }

    public function get_courses_by_category($category_id) {
        if (!is_numeric($category_id) || $category_id <= 0) {
            return ['success' => false, 'message' => 'Invalid category ID'];
        }
        return $this->courseDao->get_courses_by_category($category_id);
    }

    public function get_courses_by_instructor($instructor_id) {
        if (!is_numeric($instructor_id) || $instructor_id <= 0) {
            return ['success' => false, 'message' => 'Invalid instructor ID'];
        }
        return $this->courseDao->get_courses_by_instructor($instructor_id);
    }

    public function create_course($courseData) {
        $validation = $this->validate_course_data($courseData);
        if (!$validation['success']) {
            return $validation;
        }

        return $this->courseDao->add($courseData);
    }

    public function update_course($id, $courseData) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid course ID'];
        }

        $validation = $this->validate_course_data($courseData);
        if (!$validation['success']) {
            return $validation;
        }

        return $this->courseDao->update($courseData, $id);
    }

    public function delete_course($id) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid course ID'];
        }
        return $this->courseDao->delete_course($id);
    }

    private function validate_course_data($courseData) {
        $errors = [];
        
        if (empty($courseData['title']) || strlen(trim($courseData['title'])) < 3) {
            $errors[] = 'Course title must be at least 3 characters long';
        }
        
        if (empty($courseData['description']) || strlen(trim($courseData['description'])) < 10) {
            $errors[] = 'Course description must be at least 10 characters long';
        }
        
        if (!isset($courseData['instructor_id']) || !is_numeric($courseData['instructor_id']) || $courseData['instructor_id'] <= 0) {
            $errors[] = 'Valid instructor ID is required';
        }
        
        if (!isset($courseData['category_id']) || !is_numeric($courseData['category_id']) || $courseData['category_id'] <= 0) {
            $errors[] = 'Valid category ID is required';
        }
        
        return empty($errors) ? ['success' => true] : ['success' => false, 'errors' => $errors];
    }
}
?>

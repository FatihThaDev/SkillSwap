<?php
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/CourseDao.php';
require_once __DIR__ . '/../dao/UserCoursesDao.php';

class UserService {
    private $userDao;
    private $courseDao;
    private $userCoursesDao;

    public function __construct(){
        $this->userDao = new UserDao();
        $this->courseDao = new CourseDao();
        $this->userCoursesDao = new UserCoursesDao();
    }

    // Admin methods
    public function get_all_users() {
        return $this->userDao->getAll();
    }

    public function get_user_by_id($id) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid user ID'];
        }
        return $this->userDao->getById($id);
    }

    public function delete_course($course_id) {
        if (!is_numeric($course_id) || $course_id <= 0) {
            return ['success' => false, 'message' => 'Invalid course ID'];
        }
        
        $enrolledUsers = $this->userCoursesDao->get_users_by_course($course_id);
        foreach ($enrolledUsers as $user) {
            $this->userCoursesDao->unenroll_user_from_course($user['id'], $course_id);
        }
        
        return $this->courseDao->delete_course($course_id);
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

    public function get_users_enrolled_in_course($course_id) {
        if (!is_numeric($course_id) || $course_id <= 0) {
            return ['success' => false, 'message' => 'Invalid course ID'];
        }
        return $this->userCoursesDao->get_users_by_course($course_id);
    }

    // User validation methods
    public function validate_user_data($userData) {
        $errors = [];
        
        if (empty($userData['name']) || strlen(trim($userData['name'])) < 2) {
            $errors[] = 'Name must be at least 2 characters long';
        }
        
        if (empty($userData['username']) || strlen(trim($userData['username'])) < 3) {
            $errors[] = 'Username must be at least 3 characters long';
        }
        
        if (empty($userData['email']) || !filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email address is required';
        }
        
        if (empty($userData['password']) || strlen($userData['password']) < 6) {
            $errors[] = 'Password must be at least 6 characters long';
        }
        
        if (isset($userData['role']) && !in_array($userData['role'], ['user', 'admin'])) {
            $errors[] = 'Role must be either "user" or "admin"';
        }
        
        return empty($errors) ? ['success' => true] : ['success' => false, 'errors' => $errors];
    }
}
?>

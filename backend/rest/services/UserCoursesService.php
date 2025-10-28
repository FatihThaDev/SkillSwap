<?php
require_once __DIR__ . '/../dao/UserCoursesDao.php';
require_once __DIR__ . '/../dao/CourseDao.php';

class UserCoursesService {
    private $userCoursesDao;
    private $courseDao;

    public function __construct(){
        $this->userCoursesDao = new UserCoursesDao();
        $this->courseDao = new CourseDao();
    }

    public function get_user_courses($user_id) {
        return $this->userCoursesDao->get_courses_by_user($user_id);
    }

    public function enroll_in_course($user_id, $course_id) {
        if (!is_numeric($user_id) || $user_id <= 0) {
            return ['success' => false, 'message' => 'Invalid user ID'];
        }
        
        if (!is_numeric($course_id) || $course_id <= 0) {
            return ['success' => false, 'message' => 'Invalid course ID'];
        }
        
        if ($this->userCoursesDao->is_user_enrolled($user_id, $course_id)) {
            return ['success' => false, 'message' => 'User is already enrolled in this course'];
        }
        
        $course = $this->courseDao->getById($course_id);
        if (!$course) {
            return ['success' => false, 'message' => 'Course not found'];
        }
        
        return $this->userCoursesDao->enroll_user_in_course($user_id, $course_id);
    }

    public function unenroll_from_course($user_id, $course_id) {
        // Validate input parameters
        if (!is_numeric($user_id) || $user_id <= 0) {
            return ['success' => false, 'message' => 'Invalid user ID'];
        }
        
        if (!is_numeric($course_id) || $course_id <= 0) {
            return ['success' => false, 'message' => 'Invalid course ID'];
        }
        
        if (!$this->userCoursesDao->is_user_enrolled($user_id, $course_id)) {
            return ['success' => false, 'message' => 'User is not enrolled in this course'];
        }
        
        return $this->userCoursesDao->unenroll_user_from_course($user_id, $course_id);
    }

    public function is_enrolled($user_id, $course_id) {
        return $this->userCoursesDao->is_user_enrolled($user_id, $course_id);
    }
}
?>

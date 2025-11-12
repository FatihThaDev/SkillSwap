<?php
require_once __DIR__ . '/../dao/CategoryDao.php';

class CategoryService {
    private $categoryDao;

    public function __construct(){
        $this->categoryDao = new CategoryDao();
    }

    public function get_all_categories() {
        return $this->categoryDao->getAll();
    }

    public function get_category_by_id($id) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid category ID'];
        }
        return $this->categoryDao->getById($id);
    }

    public function create_category($categoryData) {
        $validation = $this->validate_category_data($categoryData);
        if (!$validation['success']) {
            return $validation;
        }

        return $this->categoryDao->create_category($categoryData);
    }

    public function update_category($id, $categoryData) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid category ID'];
        }

        $validation = $this->validate_category_data($categoryData);
        if (!$validation['success']) {
            return $validation;
        }

        return $this->categoryDao->update($categoryData, $id);
    }

    public function delete_category($id) {
        if (!is_numeric($id) || $id <= 0) {
            return ['success' => false, 'message' => 'Invalid category ID'];
        }
        return $this->categoryDao->delete($id);
    }

    private function validate_category_data($categoryData) {
        $errors = [];
        
        if (empty($categoryData['name']) || strlen(trim($categoryData['name'])) < 2) {
            $errors[] = 'Category name must be at least 2 characters long';
        }
        
        if (empty($categoryData['description']) || strlen(trim($categoryData['description'])) < 10) {
            $errors[] = 'Category description must be at least 10 characters long';
        }
        
        return empty($errors) ? ['success' => true] : ['success' => false, 'errors' => $errors];
    }
}
?>

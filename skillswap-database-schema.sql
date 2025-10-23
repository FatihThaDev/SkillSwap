CREATE DATABASE SkillSwap;
USE SkillSwap;

-- USERS TABLE
CREATE TABLE `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL UNIQUE,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('user', 'admin') NOT NULL DEFAULT 'user'
);

-- SKILLS TABLE
CREATE TABLE `skills` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `experience_level` ENUM('beginner', 'intermediate', 'expert') NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

-- CATEGORIES TABLE
CREATE TABLE `categories` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL UNIQUE,
    `description` TEXT NOT NULL
);

-- COURSES TABLE
CREATE TABLE `courses` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `instructor_id` INT UNSIGNED NOT NULL,
    `category_id` INT UNSIGNED NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `badge` ENUM('none', 'new', 'popular') NOT NULL DEFAULT 'none',
    FOREIGN KEY (`instructor_id`) REFERENCES `users`(`id`) ,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
);

-- BADGES TABLE
CREATE TABLE `badges` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `course_id` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`)
);

-- USER_COURSES (INTERMEDIARY TABLE)
CREATE TABLE `user_courses` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `course_id` INT UNSIGNED NOT NULL,
    UNIQUE KEY `user_course_unique` (`user_id`, `course_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`)
);

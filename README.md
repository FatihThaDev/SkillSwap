# SkillSwap – Skill Exchange Platform

**Learn by teaching, teach to learn.**  
SkillSwap is a full-stack web application that enables users to exchange skills without money—just knowledge and time. Whether you want to learn guitar, cooking, or coding in return for teaching photography or language, SkillSwap connects you with others in your community for mutual growth.

Built with **HTML, CSS, JavaScript (Frontend)** and **PHP with MySQL (Backend)**, this project supports user authentication, role-based access (User & Admin), skill listings, and a simple messaging system.

---

### ⭐ Features

- **User Roles**:  
  - *Regular Users*: Create profiles, post skills, search, and chat with AI.  
  - *Admins*: Moderate content, manage users, and oversee platform activity.

- **Skill Exchange System**:  
  Post what you’re offering and what you’d like to learn. 
  For example: “I’ll teach programming in exchange for English lessons.”

- **Messaging**:  
  Communicate with an AI assistant which can help you solve problems you are unfamiliar with.

- **Secure Authentication**:  
  Login, registration, and session management with PHP.

---

### 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: Apache (via XAMPP/WAMP or live hosting)

---

### 🗃️ Database Schema (Key Tables)

- `users` – Stores user data and roles
- `skills` – Lists of offered/wanted skills
- `courses` – Data about courses offered on the platform
- `categories` – Skill categories
- `badges` – Badges which administrators put on courses (new, popular)
- `user_courses` - Intermediary table which unites `users` and `courses` tables

---

### 🎓 Purpose

This project was developed for the course ``` IT 2001 - Web Programming``` to demonstrate full-stack development knowledge using HTML, CSS and JavaScript for frontend, and PHP with MySQL for backend development.

---

# 🏢 Compro KYB — Corporate Website & CMS

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4.0-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-7.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)](LICENSE)

**Compro KYB** is a modern, responsive Company Profile web application and dynamic Content Management System (CMS) built for **PT Kayaba Indonesia (KYB)**. It showcases company profile information, product catalogs, achievements, awards, event highlights, and provides a secure, role-based administrative control panel with 2-Factor OTP verification.

---

## ✨ Features & Modules

### 🌐 Public Portal
- **Hero & Landing Page**: Dynamic banners, company philosophy, video highlights, and featured about sections.
- **Product Catalog**: Multi-category product showcase with brand filtering and detail views.
- **Achievements & Events**: Interactive showcase for company certificates, awards (*penghargaan*), and corporate events.
- **Global Search**: Instant search across products, events, and company content.
- **Responsive Design**: Fully responsive layout built with modern Tailwind CSS v4.

### 🛡️ Admin Management System (CMS)
- **Secure Authentication & OTP**: 2-Factor authentication (OTP verification) required for administrative access.
- **Role-Based Access Control (RBAC)**: Fine-grained permissions (Super Admin, Administrator, Content Editor).
- **Homepage CMS**: Manage sliders/banners, philosophy text, embedded video highlights, and gallery images.
- **Product Catalog CMS**: Manage categories, products, and brand listings.
- **Events & Achievements CMS**: Manage corporate events, certificates, and awards.
- **Static Content CMS**: FAQs, company policy sections, about pages, and contact items.
- **Security & User Management**: Manage system users, roles, permissions, and security settings.
- **Audit Logging**: Comprehensive activity logs and user login history tracking.

---

## 🛠️ Tech Stack

- **Backend Framework**: [Laravel 12.x](https://laravel.com)
- **Language**: PHP 8.2+
- **Frontend Assets**: Blade Templating, [Tailwind CSS v4](https://tailwindcss.com), [Vite 7.x](https://vitejs.dev)
- **Database**: SQLite (default) / MySQL / PostgreSQL
- **Security & Authentication**: Laravel Built-in Auth + Custom OTP Verification Middleware + Permission Matrix

---

## 🚀 Getting Started

Follow these steps to set up and run the project on your local environment.

### Prerequisites

Ensure you have the following installed on your machine:
- **PHP** `>= 8.2`
- **Composer** `>= 2.x`
- **Node.js** `>= 18.x` & **NPM**
- **SQLite** or **MySQL**

## 🔑 Default Credentials

After seeding the database with `SecuritySeeder`, you can log in using the following default accounts:

| Role | Username | Password |
| :--- | :--- | :--- |
| **Super Administrator** | `240215` | `password` |
| **Test Administrator** | `admin_test` | `password` |

> ⚠️ **Important**: Please change the default passwords immediately upon deployment to a production environment.

---

## 📁 Project Directory Structure

```text
Compro-KYB/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/         # CMS Management Controllers
│   │   │   └── Auth/          # Login & OTP Verification Controllers
│   │   └── Middleware/        # Auth & Permission Middlewares
│   └── Models/                # Eloquent Data Models
├── database/
│   ├── migrations/            # Database Schema Migrations
│   └── seeders/               # Security & Initial Site Content Seeders
├── public/                    # Webroot & Uploaded Assets
├── resources/
│   ├── css/                   # Tailwind CSS Configurations & Styles
│   ├── js/                    # Application JS Scripts
│   └── views/                 # Blade Templates (Public & Admin UI)
├── routes/
│   └── web.php                # Application Web Routes
└── vite.config.js             # Vite Build Configuration

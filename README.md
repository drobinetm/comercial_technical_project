# Agence Commercial Project

[![PHP Version](https://img.shields.io/badge/php-^8.3-8892BF.svg?style=flat-square)](https://php.net/)
[![Laravel Version](https://img.shields.io/badge/Laravel-^12.0-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com/)
[![Inertia.js](https://img.shields.io/badge/Inertia.js-^2.0-000000?style=flat-square&logo=inertia)](https://inertiajs.com/)
[![Vue.js](https://img.shields.io/badge/Vue.js-3.x-4FC08D?style=flat-square&logo=vue.js&logoColor=white)](https://vuejs.org/)
[![Pest PHP](https://img.shields.io/badge/Pest-PHP-7F1D1D?style=flat-square&logo=pest)](https://pestphp.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)

## 📝 Project Description

Commercial management system developed with Laravel, Inertia.js, and Vue.js 3, designed to provide a smooth user experience and maintainable architecture.

## 🚀 Features

- **Backend**: Laravel 12
- **Frontend**: Vue.js 3 with Inertia.js
- **Authentication**: Built-in authentication system
- **Testing**: Testing with Pest PHP
- **Styling**: Tailwind CSS
- **Development Tools**: Laravel Sail, Laravel Tinker

## 📋 System Requirements

- PHP ^8.2
- Composer
- Node.js (Latest LTS version recommended)
- SQLite / MySQL / PostgreSQL

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone [REPOSITORY_URL]
   cd agence_comercial_technical_project
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Set up the environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Set up the database**
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

6. **Start the development server**
   ```bash
   npm run dev
   ```

## 🧪 Running Tests

```bash
composer test
```

## 🧑‍💻 Useful Commands

- **Start development server**: `npm run dev`
- **Build assets for production**: `npm run build`
- **Run migrations**: `php artisan migrate`
- **Generate model documentation**: `php artisan ide-helper:models`

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## 📧 Contact

For more information, please contact [drobinetm@outlook.com](mailto:drobinetm@outlook.com)

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```
<img width="1866" height="2565" alt="image" src="https://github.com/user-attachments/assets/b14d9792-3da0-49cf-a271-ea155a5184af" />

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Prérequis et démarrage local

Après le clonage du dépôt, suivre ces étapes pour lancer le projet en local :

1. Installer les dépendances PHP et JavaScript :

```bash
composer install
npm install
```

2. Copier le fichier d'environnement et générer la clé :

```bash
copy .env.example .env    # Windows
php artisan key:generate
```

3. Configuration de la base (SQLite recommandé pour les tests) :

- Pour sqlite : créer le fichier de base de données et mettre à jour .env :

```bash
mkdir database 2>nul || true
type nul > database\database.sqlite
```

Définir dans .env :

DB_CONNECTION=sqlite
DB_DATABASE=${PWD}\\database\\database.sqlite

4. Lancer les migrations, les seeders et créer le lien de stockage :

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

5. Compiler les assets et lancer l'application :

```bash
npm run dev
# si un script composer 'dev' existe
composer run dev
```

6. Si le serveur intégré ne démarre pas via l'environnement, tester manuellement :

```bash
php artisan serve
npm run dev
```

Notes :
- Adaptez les commandes 'copy' selon votre shell (Windows PowerShell vs Bash).
- Si vous utilisez une base MySQL/Postgres, configurez les variables DB_* dans .env avant `php artisan migrate`.
- SQLite est recommandé pour les tests locaux car il évite la configuration d'un serveur DB externe.

Bonne découverte et développement !

<p align="center">
    <a href="https://laravel.com/docs/11.x/starter-kits#laravel-breeze" target="_blank">
        <img src="https://github.com/user-attachments/assets/a80dec62-0c5e-40c6-8f1f-3512a4b70d01" height="50"/>
    </a>
    &nbsp;
    <a href="https://livewire.laravel.com/" target="_blank">
        <img src="https://github.com/user-attachments/assets/64c79d63-a4c1-40aa-8d71-4f4859c7c741" height="50">
    </a>
</p>

# Letslearn

Fullstack music website using <a href="https://github.com/laravel/laravel" target="blank">Laravel</a> (<a href="//github.com/laravel/breeze" target="blank">Breeze</a> Starter Kit), <a href="https://github.com/livewire/livewire" target="blank">Livewire</a>, <a href="https://github.com/tailwindlabs/tailwindcss" target="_blank">Tailwind CSS</a>.

## Install Dependencies

### Frontend

```bash
npm install
```

### Backend

```bash
composer install
```

## Run Project

```bash
composer run dev
```

Visit [localhost:8000](http://localhost:8000) to access the application.

## Environment Configuration

1. Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

2. Generate an application key:

```bash
php artisan key:generate
```
   

3. Update your database, mail configuration in the `.env` file.

## Database Migration

Run the following command to migrate the database:

```bash
php artisan migrate
```

## Database Seeder

Run the following command to seed the database:

```bash
php artisan db:seed
```

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any enhancements or bug fixes.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

## Acknowledgments

+ Thanks to the creators of Livewire, Laravel, Breeze, and Tailwind CSS for their amazing frameworks and tools that made this project possible.

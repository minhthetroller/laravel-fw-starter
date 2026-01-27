# 🎓 My Laravel Learning Journey

Hey there! 👋 This is my playground for learning Laravel - nothing fancy, just me tinkering around and building stuff to understand how this awesome framework works.

## What's This About?

So basically, I wanted to learn Laravel properly, and what better way than to build something? This project started as a simple product catalog, but then I got carried away and added a bunch of random things because... why not? 😄

Here's what I've been playing with:
- A **product catalog** where you can add and browse products (with fancy UUIDs because I wanted to learn how they work!)
- A **student info page** that shows my details (flex your student ID, you know? 😎)
- A **chess board generator** - honestly, this was just for fun. Type in a number and boom, you get a chess board!
- Oh, and a custom 404 page because getting lost should at least look nice

## Getting Started (Docker Way)

I learned Docker for this project too! Here's how to get it running:

## Getting Started (Docker Way)

I learned Docker for this project too! Here's how to get it running:

```bash
# First, copy the Docker environment file
cp .env.docker .env

# Fire up the containers (this might take a minute the first time)
docker-compose up -d --build

# Install all those PHP packages
docker-compose exec app composer install

# Generate the app key (Laravel needs this!)
docker-compose exec app php artisan key:generate

# Set up the database tables
docker-compose exec app php artisan migrate

# Fill it with some dummy products (21 of them!)
docker-compose exec app php artisan db:seed
```

Then head over to `http://localhost:8080` and voilà! 🎉

## Or... The Traditional Way

Not feeling Docker? No worries:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

Now visit `http://localhost:8000` and you're good to go!

## What I Learned 📚

This project was all about getting my hands dirty with:
- **Laravel basics**: Routes, controllers, views, models - the whole MVC thing
- **Database stuff**: Migrations, seeders, factories, and why UUIDs are cool
- **Security**: Turns out XSS and SQL injection are real things I need to care about!
- **Docker**: Because containerizing stuff sounds professional ⚡
- **Testing**: Writing tests is actually pretty satisfying when they all pass green!
- **Tailwind CSS**: Making things look decent without writing much CSS

## Cool Things I Implemented

### Product Catalog
Each product has a UUID instead of a regular ID. Why? Because I wanted to learn how to use them! They're those long random strings that look super professional.

### Student Info Page
Visit `/sinhvien` to see my info, or `/sinhvien/YourName/YourID` to flex your own!

### Chess Board Generator
Type `/banco/8` for a standard chess board, or go crazy with `/banco/20`. It's just a visual board though - no actual chess game (maybe next project? 🤔)

## Testing

Yeah, I wrote tests! 34 of them actually:

```bash
# Run all tests
php artisan test

# Or go fast with parallel testing
php artisan test --parallel
```

They test everything from products CRUD to making sure hackers can't do nasty XSS stuff.

## The Tech Stack

- **Laravel 11** - The latest and greatest!
- **PHP 8.2** - Because modern PHP is actually pretty cool
- **MySQL 8.0** - For storing all the data
- **Tailwind CSS** - For making it look pretty
- **Docker** - For the "it works on my machine" problem

## What's Next?

I'm just learning here, so there's always more to explore:
- Maybe add user authentication?
- Make the chess board actually playable?
- Add image uploads for products?
- Who knows! 🚀

## Notes to Self

- Remember to run migrations after pulling new code
- Don't forget to `composer install` if dependencies change
- The `.env` file is gitignored for a reason - never commit it!
- When things break, check the logs in `storage/logs/`

## About Laravel

Laravel is this awesome PHP framework that makes web development actually fun. It handles all the boring stuff so you can focus on building cool things. If you're learning PHP, definitely give Laravel a shot!

Want to learn more? Check out:
- [Laravel Docs](https://laravel.com/docs) - Seriously good documentation
- [Laracasts](https://laracasts.com) - Video tutorials that actually make sense
- [Laravel Bootcamp](https://bootcamp.laravel.com) - Build your first Laravel app

---

Made with ☕ and lots of Stack Overflow searches by a learner trying to figure things out!
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

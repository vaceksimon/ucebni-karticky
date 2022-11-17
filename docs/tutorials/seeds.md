# Laravel Seeds

## Odkazy
* [Dokumentace](https://laravel.com/docs/8.x/seeding)
* [Video](https://www.youtube.com/watch?v=qeT0pJJ_GOs&ab_channel=LaravelDaily)
* [Faker](https://github.com/fzaninotto/Faker)

## Poznatky
* Vytvoření Seederů

```bash
php artisan make:seeder UserSeeder
```

* Spouštění databázových Seederů

```php
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
        // Nebo -- volá funkci run ze zadané třídy 
        $this->call(UserSeeders::class);
    }
}
```

* Vytvoření továrny

```bash
php artisan make:factory UserFactory
```


* Použití továren

```php
class UserSeeder extends Seeder
{
    /**
    * Run the database seeders.
    *
    * @return void
    */
    public function run()
    {
        User::factory()
                ->count(50)
                ->hasPosts(1)
                ->create();
        // Nebo přes Faker
        User::factory()->times(100)->create();
    }
}
```

* Volání více Seederů

```php
class DatabaseSeeder extends Seeder
{
    /**
    * Run the database seeders.
    *
    * @return void
    */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);
        // Nebo
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
```

* Spouštění seedů (druhý příkaz je pro specifikaci konkrétní třídy, která bude seedovat), ale pro migrace je třetí příkaz (odstrané všechny tabulky a znovu spustí sestavení migrace).

```bash
php artisan db:seed

php artisan db:seed --class=UserSeeder

php artisan migrate:fresh --seed
```

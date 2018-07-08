<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use CodeEduBook\Faker\ChapterFakerProvider;

$factory->define(\CodeEduUser\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'verified' => true,
    ];
});

$factory->state(\CodeEduUser\Models\User::class, 'author', function ($faker) {
    return [
        'email' => 'author@editora.com'
    ];
});

$factory->define(\CodeEduBook\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});

$factory->define(\CodeEduBook\Models\Book::class, function (Faker\Generator $faker) {

    $repository = app(\CodeEduUser\Repositories\UserRepository::class);
    /** @var \Illuminate\Database\Eloquent\Collection $users */
    $authorId = $repository->all()->random()->id;

    return [
        'title' => ucfirst($faker->word),
        'subtitle' => ucfirst($faker->sentence(3)),
        'price' => $faker->randomFloat(2, 10, 100),
        'author_id' => $authorId,
        'dedication' => $faker->sentence,
        'description' => $faker->paragraph,
        'website' => $faker->url,
        'percent_complete' => rand(1, 100),
        'published' => 1
    ];
});

$factory->define(\CodeEduBook\Models\Chapter::class, function (Faker\Generator $faker) {
    $faker->addProvider(new ChapterFakerProvider($faker));
    return [
        'name' => $faker->sentence(2),
        'content' => $faker->markdown(rand(2, 6)),
    ];
});

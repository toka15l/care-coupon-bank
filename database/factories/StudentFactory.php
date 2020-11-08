<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'teacher_id' => 1,
        'coupons' => $faker->numberBetween(0, 20)
    ];
});

$factory->afterCreating(Student::class, function ($student, Faker $faker) {
    $student->student_number = $student->id;
    $student->save();
});

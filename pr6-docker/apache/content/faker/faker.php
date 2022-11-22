<?php

require_once '../vendor/autoload.php';
require_once 'IoTDataInstance.php';

function generate_data()
{
    $data = array();

    $faker = Faker\Factory::create();
    $faker->addProvider(new Faker\Provider\Base($faker));
    for ($i = 0; $i < 50; $i++) {
        $data_row = new IoTDataInstance(
            $faker->randomFloat(2, 22, 24),
            $faker->randomFloat(2, 4.5, 5.1),
            $faker->randomFloat(1, 19, 22),
            $faker->numberBetween(745, 766),
            $faker->numberBetween(200, 780),
            $faker->numberBetween(100, 1000)
        );
        $data[] = $data_row;
    }
    $jsonData = json_encode($data);
    file_put_contents('results.json', $jsonData);
}

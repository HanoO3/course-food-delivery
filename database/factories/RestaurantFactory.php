<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;


class RestaurantFactory extends Factory
{
    
      public function definition(): array
    {
        $cities = City::pluck('id'); 
 
        return [ 
            'city_id' => $cities->random(), 
            'name'    => fake()->company(), 
            'address' => fake()->address(), 
        ]; 
    }
}

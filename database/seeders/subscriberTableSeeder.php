<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class subscriberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscriber::create([
            'name' => 'João Vítor Batistella',
            'email' => 'joaovitor.batistella.ba@gmail.com',
        ]);
    }
}

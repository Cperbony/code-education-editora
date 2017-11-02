<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CodeEduUser\Models\User::class, 1)->create([
            'name' => 'Claudinei Perboni',
            'email' => 'cperbony@gmail.com',
            'password' => bcrypt('123456')
        ]);

        factory(\CodeEduUser\Models\User::class, 1)->create();
    }


}

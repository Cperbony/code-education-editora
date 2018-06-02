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
        $author = factory(\CodeEduUser\Models\User::class, 1)
            ->states('author')
            ->create();
        $roleAuthor = (new CodeEduUser\Models\Role)
            ->where('name', config('codeedubook.acl.role_author'))
            ->first();
        $author->roles()->attach($roleAuthor->id);

//        factory(\CodeEduUser\Models\User::class, 1)->create();
    }
}

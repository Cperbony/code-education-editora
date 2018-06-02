<?php

use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAuthor = (new CodeEduUser\Models\Role)
            ->where('name', config('codeedubook.acl.role_author'))
            ->first();

        $permissionsBook = (new CodeEduUser\Models\Permission)
            ->where('name','like', 'book%')
            ->pluck('id')
            ->all();

        $permissionsCategory = (new CodeEduUser\Models\Permission)
            ->where('name', 'like', 'category%')
            ->pluck('id')
            ->all();

        $roleAuthor->permissions()->attach($permissionsBook);
        $roleAuthor->permissions()->attach($permissionsCategory);
    }
}

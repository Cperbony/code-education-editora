<?php

use CodeEduUser\Models\Role;
use Illuminate\Database\Migrations\Migration;

class CreateRoleAuthorData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create([
            'name' => config('codeedubook.acl.role_author'),
            'description' => 'Autor de Livros Mestre do Sistema'
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAuthor = (new CodeEduUser\Models\Role)
            ->where('name', config('codeedubook.acl.role_author'))
            ->first();

        $roleAuthor->permissions()->detach();
        $roleAuthor->users()->detach();
        $roleAuthor->delete();
    }
}

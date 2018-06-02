<?php

use CodeEduUser\Models\Permission;
use Illuminate\Database\Migrations\Migration;

class CreateManageBookPermissionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        list($name, $resourceName) = explode('/', config('codeedubook.acl.permissions.book_manage_all'));
        Permission::create([
            'name' => $name,
            'description' => 'Administração de Livros',
            'resource_name' => $resourceName,
            'resource_description' => 'Gerenciar Todos os Livros'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        list($name, $resourceName) = explode('/', config('codeedubook.acl.permissions.book_manage_all'));
        $permission = (new CodeEduUser\Models\Permission)
            ->where('name', $name)
            ->where('resource_name', $resourceName)
            ->first();
        $permission->roles()->detach();
    }
}

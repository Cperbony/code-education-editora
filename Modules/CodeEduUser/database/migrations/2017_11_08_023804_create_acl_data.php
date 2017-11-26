<?php

use CodeEduUser\Models\Role;
use CodeEduUser\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateAclData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = Role::create([
            'name' => config('codeeduuser.acl.role_admin'),
            'description' => 'Papel de Usuário mestre do Sistema'
        ]);

        $user = User::where('email', config('codeeduuser.user_default.email'))->first();
        $user->roles()->save($roleAdmin);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::disableForeignKeyConstraints();
        $roleAdmin = Role::where('name', config('codeeduuser.acl.role_admin'))->first();
        $user = User::where('email', config('codeeduser.user_default.email'))->first();
        $user->roles()->detach($roleAdmin->id);

        $roleAdmin->delete();
        \Schema::enableForeignKeyConstraints();
    }
}

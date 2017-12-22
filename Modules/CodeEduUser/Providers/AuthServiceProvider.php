<?php

namespace CodeEduUser\Providers;

use CodeEduUser\Criteria\FindPermissionsResourceCriteria;
use CodeEduUser\Repositories\PermissionRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'CodePub\Model' => 'CodePub\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::before(function ($user, $ability) {
            //True - Autorizado
            //False - Não autorizado
            //void - executar a habilidade em questão
            if ($user->isAdmin()) {
                return true;
            }
        });

        /** @var PermissionRepository $permissionRepository */
        $permissionRepository = app(PermissionRepository::class);
        $permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
//        dd($permissions = $permissionRepository->all());
        $permissions = $permissionRepository->all();
        foreach ($permissions as $p) {
            \Gate::define("{$p->name}/{$p->resource_name}", function ($user) use ($p) {
                return $user->hasRole($p->roles);
            });
        }

    }
}

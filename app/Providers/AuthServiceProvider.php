<?php

namespace CodePub\Providers;

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

        \Gate::define('update-book', function ($user, $book) {
            return $user->id == $book->author_id;
        });

        \Gate::before(function ($user, $ability) {
            //Retornou True = Autorizado
            ////Retornou False = Não Autorizado
            /// //Retornou Void = Vai executar a habilidade em questão.
            if ($user->isAdmin()) {
                return true;
            }
        });

//        \Gate::define('user-admin', function ($user) {
//            return false;
//        });
    }
}

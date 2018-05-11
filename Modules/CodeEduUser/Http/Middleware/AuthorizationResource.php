<?php

namespace CodeEduUser\Http\Middleware;

use Closure;
//use CodeEduUser\Annotations\PermissionReader;
use CodeEduUser\Facade\PermissionReader;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AuthorizationResource
{

    /**
     * @var PermissionReader

    private $reader;
     */

    /**
     * AuthorizationResource constructor.
     * @param PermissionReader $reader

    public function __construct(PermissionReader $reader)
    {
        $this->reader = $reader;
    }*/

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next)
    {
        $currentAction = \Route::currentRouteAction();
        //dd($currentAction);
        list($controller, $action) = explode('@', $currentAction);
        $permission = PermissionReader::getPermission($controller, $action);
        if(count($permission)){
            $permission = $permission[0];
//         dd($permission);
//            dd("{$permission['name']}/{$permission['resource_name']}");
            if(!\Gate::allows("{$permission['name']}/{$permission['resource_name']}")) {
                throw new AuthorizationException('Usuário não autorizado!');
            }
        }
        return $next($request);
    }
}

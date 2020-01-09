<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use JWTAuth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Exception;
use Illuminate\Routing\Route;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWT extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {

            $user = JWTAuth::parseToken()->authenticate();


            $name = $request->route()->getAction();
            $controllerAction = class_basename($name['controller']);
            list($controller, $action) = explode('@', $controllerAction);
            //echo $user->hasAnyPermission([$action]);
            echo $controller, $action ;


        //    echo $user->permission('Store Brand')->get();
            //echo $user->getRoleNames();
            //echo $user->getAllPermissions();
           // echo $user->hasPermissionTo('Store Brand');
        //    if($user->hasPermissionTo($action)){
        //         return $next($request);
        //     }else{
        //         return null ;
        //     }
        // if ($user && in_array($user->role, $roles)) {
        //     return $next($request);
        // }

       // return $this->unauthorized();


        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid'],401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired'],401);
            }else{
                return response()->json(['status' => 'Authorization Token not found'],404);
            }
        }
        return $next($request);

        // $user = JWTAuth::parseToken()->authenticate();
        //  // echo json_encode($user->getRoleNames());
        // // echo json_encode($user->getPermissionsViaRoles());
        // return $next($request);
    }
}

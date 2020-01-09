<?php

namespace App\Exceptions;

use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // if ($exception instanceof TokenInvalidException) {
        //     return response()->json(["error" => get_class($exception)." : Token is Invalid"], 401);
        // } else if ($exception instanceof TokenExpiredException) {
        //     return response()->json(["error" => get_class($exception)." : Token is Expired"], 401);
        // } else if ($exception instanceof JWTException) {
        //     return response()->json(["error" => get_class($exception)." : Token is not applied"], 401);
        // } else if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
        //     return response()->json(["error" => get_class($exception)." : You are not authorized"], 404);
        // }
        if ($exception instanceof NotFoundHttpException) {
                return response()->json(["error" => get_class($exception)." : Resource url is not found"], 404);
            }
        return parent::render($request, $exception);
    }
}

<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->renderable(function (MethodNotAllowedHttpException $e,Request $request) {
                abort(404);
        });
        $this->renderable(function (RouteNotFoundException $e,Request $request) {
                abort(404);
        });

        $this->renderable(function (NotFoundHttpException $e,Request $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'=>'Not Found.'
                   ],404);
            
        }
          
        });
    }
}

<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Str;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseTrait;
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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        $baseUri = $request->route()->uri();

        if(Str::is('api*', $baseUri))
        {
            if($e instanceof ModelNotFoundException){
                return $this->sendResponse(404, self::$RESOURCE_NOT_FOUND, []);
            }
            if ($e instanceof AuthenticationException) {
                return $this->sendResponse(self::$RESPONSE_AUTHORIZE, 'Unauthenticated', []);
            }
        }
        dd($e);
        return parent::render($request, $e); // TODO: Change the autogenerated stub
    }
}
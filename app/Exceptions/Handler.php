<?php

namespace CodeDelivery\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        /**
         * Response Exception as Json
         *
         */
        if ($request->wantsJson()){
            $error = new \stdclass();
            $error->error = true;

            if ($e instanceof NotFoundHttpException){
                $error->code = $e->getStatusCode();
            } else {
                $error->code = $e->getCode();
            }

            if ($error->code == 0){
                $error->code = 400;
            }

            if ($e instanceof ValidatorException) {
                $error->message = $e->getMessageBag();
            } else {
                $error->message = $e->getMessage();
                if ($e instanceof QueryException) {
                    $error->code = 400;
                    $error->message = $e->previous->getMessage();
                }

                if (\App::environment('local')) {
                    $error->file = $e->getFile();
                    $error->line = $e->getLine();
                }
            }

            return response()->json($error, $error->code);
        }

        return parent::render($request, $e);
    }
}

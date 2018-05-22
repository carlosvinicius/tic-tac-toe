<?php

namespace App\Exceptions;

use Exception;
use App\Exceptions\InvalidBoardException;
use App\Exceptions\InvalidPlayerException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        InvalidBoardException::class,
        InvalidPlayerException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        switch (get_class($exception)) {
            case \App\Exceptions\InvalidBoardException::class:
            case \App\Exceptions\InvalidPlayerException::class:
                $responseMessage = $exception->getMessage();
                $responseCode    = 400;
                break;
            case \Symfony\Component\HttpKernel\Exception\HttpException::class:
                $responseMessage = $exception->validator->getMessageBag()->toArray();
                $responseCode    = $exception->getStatusCode();
                break;
            default:
                $responseMessage = $exception->getMessage();
                $responseCode    = 400;
        }

        return response()->json($responseMessage, $responseCode);
    }
}

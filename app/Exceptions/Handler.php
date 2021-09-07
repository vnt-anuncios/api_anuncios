<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }
        if ($exception instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No existe ninguna instancia {$model} con el id expecificado", 404);
        }
        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }
        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse('No posee permisos para ejecutar esta acción', 403);
        }
        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse('No se encontró la URL especificada', 404);
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('El método especificado en la petición no es válido', 405);
        }
        if ($exception instanceof HttpException) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        return $this->errorResponse('Falla inesperada. Intente luego', 500);
    }
    //hay q eliminar si tiene error con el login
    // del sistema
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse('No Autenticado', 401);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        return $this->errorResponse($errors, 422);
    }
}

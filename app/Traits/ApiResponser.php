<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


trait ApiResponser
{

    private function succesReponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
    protected function showAll(Collection $collection, $code = 200)
    {
        return $this->succesReponse(['data' => $collection, 'code' => $code], $code);
    }
    protected function showOne(Model $instance, $code = 200)
    {
        return $this->succesReponse(['data' => $instance], $code);
    }

    protected function deleteSuccesfull()
    {
        return $this->succesReponse(NULL, 204);
    }
}

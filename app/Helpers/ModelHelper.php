<?php

namespace App\Helpers;

class ModelHelper
{
    public static function findModel($model, $id)
    {
        return $model::findOrFail($id);
    }

    public static function modelToArray($model, $id)
    {
        return $model::findOrFail($id)->toArray();
    }

    public static function delete($model, $id){
        $model::findOrFail($id)->delete();
    }
}

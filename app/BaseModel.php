<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use Carbon\Carbon;
use Session;
class BaseModel extends Model
{
    public static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $isCreatedByColExist = \Schema::hasColumn($model->getTable(), 'created_by');
            $isUpdatedByColExist = \Schema::hasColumn($model->getTable(), 'updated_by');
            if ($isCreatedByColExist) {
                if(auth()->user()){
                    $auth_id =auth()->user()->id;
                    $model->created_by = $auth_id;
                    $model->updated_by = $auth_id;
                }
            }
            if ($isUpdatedByColExist) {
                if(auth()->user()){
                    $auth_id =auth()->user()->id;
                    $model->updated_by = $auth_id;
                }
            }
        });
        static::updating(function ($model) {
                if(auth()->user()){
                    $auth_id =auth()->user()->id;
                    $model->updated_by = $auth_id;
                }
            });
    }


}

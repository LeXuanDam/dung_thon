<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogShare extends Model
{
    protected $table = 'log_share';
    public function shared_by_user()
    {
        return $this->belongsTo('App\Models\User', 'shared_by', 'id');
    }
    public function registered_by_user()
    {
        return $this->belongsTo('App\Models\User', 'registered_by', 'id');
    }

    public static function getListShareCompany($ids){
        return LogShare::whereIn('shared_by',$ids)
            ->where('registered_by', '>', 0)
            ->with(['registered_by_user' => function ($query) {
                $query->select('id', 'company', 'represent');
            }])
            ->get()->toArray();
    }


}

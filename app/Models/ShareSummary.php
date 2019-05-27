<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShareSummary extends Model
{
    protected $table = 'share_summary';

    public static function updateShareSummary($sharedById, $registerId)
    {
        $sharedById = intval($sharedById);
        $registerId = intval($registerId);
        if ($sharedById <= 0 || $registerId <= 0) {
            return false;
        }

        $parentDB = static::where('user_id', $sharedById)->exists();
        if (!$parentDB) {
            static::insert([
                'user_id' => $sharedById,
                'list_child_id' => $registerId,
                'total_share' => 1
            ]);
        }
        else{
            static::where('user_id', $sharedById)
                ->orWhere('list_child_id','like','%|'.$sharedById.'|%')
                ->update([
                    'total_share' => DB::raw('total_share+1'),
                    'list_child_id' => DB::raw("concat(list_child_id, '|" . $registerId . "|')")
                ]);
        }
        return true;
    }

}

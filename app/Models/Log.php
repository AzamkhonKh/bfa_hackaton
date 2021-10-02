<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class Log extends Model
{
    use HasFactory;
    protected $table = 'Logs';
    protected $dates = ['updated_at', 'created_at'];
    protected $fillable = [
        'user_id',
        'type',
        'message',
        'location',
        'referer',
        'hostname',
    ];

    public static function write($type, $message, $user_id = null) {
        if(Auth::check()) {
            $user_id = Auth::user()->id;
        }

        $log = new \App\Log();
        $log->user_id = $user_id;
        $log->type = $type;
        $log->message = $message;
        $log->location = Request::url();
        $log->referer = Request::server('HTTP_REFERER');
        $log->hostname = Request::server('HTTP_HOST');
        $log->save();
    }

    public static function writeError($type,\Exception $e, $user_id = null)
    {
        if(\auth()->check()) {
            $user_id = \auth()->id();
        }
        $log = new \App\Log();
        $log->user_id = $user_id;
        $log->type = $type;
        $log->message = $e->getMessage()." | file ".$e->getFile()." | line ".$e->getLine();
        $log->location = Request::url();
        $log->referer = Request::server('HTTP_REFERER');
        $log->hostname = Request::server('HTTP_HOST');
        $log->save();
    }
}

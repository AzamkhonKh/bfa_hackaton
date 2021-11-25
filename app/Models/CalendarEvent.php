<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class CalendarEvent extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "user_id",
        "description",
        "title",
        "arranged"
    ];
    public function photos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Photos::class,'event_id','id');
    }

    public static function storeImage($request, $event_id){
        $image = $request->image;
        $path = 'calendar/'.auth()->id().'/'. $image->name.'.'.$image->ext;
        Storage::put($path, $image->encoded);
        return Photos::create([
            'path' => $path,
            'event_id' => $event_id,
        ]);
    }
}

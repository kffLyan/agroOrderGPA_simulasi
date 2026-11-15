<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{   
    protected $fillable = ['user_id', 'action', 'module', 'description', 'ip_address'];

    public static function record(string $action, string $modul, string $description) 
    {
        return self::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'module' => $modul,
            'description' => $description,
            'ip_address' => request()->ip(),
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

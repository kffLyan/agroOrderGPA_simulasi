<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id', 'user_name', 'role', 'action', 'module', 'description', 'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function record(string $action, string $module, string $description): self
    {
        $user = Auth::user();

        return self::create([
            'user_id'     => $user?->id,
            'user_name'   => $user?->name ?? 'Sistem / Tamu',
            'role'        => $user?->role ?? 'GUEST',
            'action'      => strtoupper($action),
            'module'      => strtoupper($module),
            'description' => $description,
            'ip_address'  => Request::ip(),
        ]);
    }
}

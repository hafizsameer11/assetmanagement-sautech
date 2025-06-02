<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetAudit extends Model
{
    use HasFactory;
    protected $casts = [
        'data' => 'array',
    ];
protected $fillable = [
    'client_id',
    'user_id',
    'data',
    'session_token',
];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}

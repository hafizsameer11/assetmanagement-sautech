<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetRegister extends Model
{
    use HasFactory;
      protected $casts = [
        'columns' => 'array',
        'rows' => 'array',
    ];
protected $fillable = [
    'client_id',
    'filename',
    'columns',
    'rows',
    'created_by',
];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}

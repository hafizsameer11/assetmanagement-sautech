<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditField extends Model
{
    use HasFactory;
     protected $casts = [
        'options' => 'array',
    ];
protected $fillable = [
    'client_id',
    'field_name',
    'description',
    'type',
    'is_required',
    'options',
    'created_by',
    'is_scannable',
];

    public function client() {
        return $this->belongsTo(Client::class);
    }
    public function creator() {
    return $this->belongsTo(User::class, 'created_by');
}
}

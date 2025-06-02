<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadLog extends Model
{
    protected $fillable = [
    'client_id',
    'type',
    'filename',
    'uploaded_by',
    'created_by',
    'uploaded_at',
];

    use HasFactory;
       public function client() {
        return $this->belongsTo(Client::class);
    }
}

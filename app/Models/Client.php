<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
    'client_name',
    'client_code',
    'address',
    'phone',
    'company_name',
    'contact_person',
    'email',
    'audit_start_date',
    'due_date',
    'status',
];

     public function assetRegisters() {
        return $this->hasMany(AssetRegister::class);
    }

    public function auditFields() {
        return $this->hasMany(AuditField::class);
    }

    public function assetAudits() {
        return $this->hasMany(AssetAudit::class);
    }

    public function uploadLogs() {
        return $this->hasMany(UploadLog::class);
    }
}

<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nonconformity extends Model
{
    use HasFactory, HasUuid;

    protected $table = "nonconformities";
    protected $primaryKey = "id";

    protected $fillable = [
        'document_number',
        'found_date',
        'department_uuid',
        'nonconformity_documentiation',
        'description',
        'information',
        'location',
        'corrective_documentation',
        'corrective_date',
        'point',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_uuid', 'uuid');
    }
}

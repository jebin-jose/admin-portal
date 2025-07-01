<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $fillable = [
        'module', 'name', 'type', 'options', 'is_required', 'lookup_module'
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean'
    ];
}

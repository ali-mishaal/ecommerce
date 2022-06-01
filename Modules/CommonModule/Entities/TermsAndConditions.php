<?php

namespace Modules\CommonModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TermsAndConditions extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_attach',
        'driver_transfer'
    ];

    protected static function newFactory()
    {
        return \Modules\CommonModule\Database\factories\TermsAndConditionsFactory::new();
    }
}

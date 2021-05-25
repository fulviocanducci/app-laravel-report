<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'name',
        'fantasy',
        'site',
        'email',
        'image',
        'cpf',
        'cnpj',
        'rg',
        'date_birth',
        'cellphone',
        'telephone',
        'type',
        'partner',
        'marital_status',
        'father',
        'mother',
        'naturalness',
        'nationality',
        'office',
        'observation',
        'status',
        'user_id',
        'origin_id',
    ];


    public function processes()
    {
        return $this->hasMany(Process::class);
    }

    public function financials()
    {
        return $this->hasMany(Financial::class);
    }

    public function scopeStateActive($query)
    {
        return $query->where('status', '=', 'A');
    }
}

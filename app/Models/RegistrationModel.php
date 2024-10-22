<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RegistrationModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'id';

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'lastname',
        'society',
        'email',
        'phone_number',
        'password',
        'adress',
    ];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->id = (string) Str::uuid();
            $user->password = bcrypt($user->password);
        });
    }
}


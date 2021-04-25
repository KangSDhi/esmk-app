<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Pengelola extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $table = 'pengelola';

    protected $primaryKey = 'id_pengelola';
}

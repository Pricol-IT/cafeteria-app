<?php

namespace App\Models;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admin';


    protected $fillable = [
        'name',
        'company_name',
        'email',
        'password',
    ];
}

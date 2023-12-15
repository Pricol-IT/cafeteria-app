<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSelection extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function menu()
    {
        return $this->belongsTo(MenuMaster::class,'menu_master_id');
    }
}

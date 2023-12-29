<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuMaster extends Model
{
    use HasFactory;

    

    protected $guarded = [];

    public function getImageurlAttribute()
    {
        if (!$this->image) {
            return asset('backend/image/default.png');
        }

        return asset($this->image);
    }

    public function menuselection()
    {
        return $this->hasMany(MenuSelection::class,'menu_master_id');
    }
}

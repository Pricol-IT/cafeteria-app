<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getSpmurlAttribute()
    {
        if (!$this->spm_bg) {
            return asset('backend/image/default.png');
        }

        return asset($this->spm_bg);
    }

    public function getSimurlAttribute()
    {
        if (!$this->sim_bg) {
            return asset('backend/image/default.png');
        }

        return asset($this->sim_bg);
    }
    
}

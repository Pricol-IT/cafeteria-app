<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Token extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];  

    public function user()
    {
        return $this->belongsTo(User::class, 'emp_id', 'id');
    }

    // public function scopeSpm($query)
    // {
    //     return $query->whereNotNull('day')
    //                  ->whereNotNull('spm');
    // }

    public function scopeSpm( $query)
    {
        return $query->whereNotNull('day')
            ->whereNotNull('spm');
    }

    public function scopeSim( $query)
    {
        return $query->whereNotNull('day')
            ->whereNotNull('sim');
    }

    public function scopeCurd( $query)
    {
        return $query->whereNotNull('day')
            ->whereNotNull('curd');
    }
    public function scopeMonthlysim( $query)
    {
        return $query->whereNotNull('monthly')
            ->whereNotNull('monthly_sim');
    }
    public function scopeMonthlycurd( $query)
    {
        return $query->whereNotNull('monthly')
            ->whereNotNull('monthly_curd');
    }

    // public function appliedToken()
    // {
    //     return $this->belongsToMany(Token::class, 'appliedToken')->withPivot('spmid')->withTimestamps();
    // }
}

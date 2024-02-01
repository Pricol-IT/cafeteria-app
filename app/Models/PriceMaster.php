<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceMaster extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($priceMaster) {
            // Look up the corresponding PriceMenu
            $priceMenu = PriceMenu::where('menu_type', $priceMaster->menu_type)->first();

            // Update the code column in PriceMaster
            if ($priceMenu) {
                $priceMaster->code = $priceMenu->code;
            }
        });

        static::updating(function ($priceMaster) {
            // Look up the corresponding PriceMenu
            if ($priceMaster->isDirty('menu_type')) {
                
                $priceMenu = PriceMenu::where('menu_type', $priceMaster->menu_type)->first();
                if ($priceMenu) {
                    $priceMaster->code = $priceMenu->code;
                }
            }
            // Update the code column in PriceMaster
            
        });
    }
}

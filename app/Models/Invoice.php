<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    use HasFactory;
    
    public function getCreatedAtAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d h:i:s A');
    }

    public function getUpdatedAtAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d h:i:s A');
    }
    
    public function account(){
        return $this->belongsTo(Account::class);
    }
    
    public function order(){
        return $this->belongsTo(Order::class);
    }
}

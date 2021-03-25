<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use Carbon\Carbon;

class Account extends Model {

    use HasFactory;

    protected static function boot() {
        parent::boot();

        static::created(function ($obj) {

            $obj->account_index = str_pad($obj->id, 6, '0', STR_PAD_LEFT);
            $obj->account_no = $obj->account_prefix . '' . $obj->account_index;
            $obj->save();
        });
    }

    public function getCreatedAtAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d h:i:s A');
    }

    public function getUpdatedAtAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d h:i:s A');
    }
    
    public function orders(){
        return $this->hasMany(Order::class)->orderBy('created_at', 'DESC');
    }
    
    public function invoices(){
        return $this->hasMany(Invoice::class)->orderBy('created_at', 'DESC');
    }

}

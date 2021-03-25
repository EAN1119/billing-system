<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;
    
    protected static function boot() {
        parent::boot();

        static::created(function ($obj) {

            if($obj->delivery_date != null){
                
                $obj->day_of_week = Carbon::parse($obj->delivery_date)->format('l');
                $obj->invoice_no = 'INV-'.str_pad($obj->id, 6, '0', STR_PAD_LEFT);
                $obj->save();
                
                if($obj->delivery_date != null && $obj->invoice_no != null){
                    //create invoice
                    $invoice = new Invoice;
                    $invoice->account_id = $obj->account_id;
                    $invoice->invoice_no = $obj->invoice_no;
                    $invoice->invoice_date = Carbon::now()->format('Y-m-d');
                    $invoice->order_id = $obj->id;
                    $invoice->payment_terms = $obj->payment_terms;
                    $invoice->total_price = $obj->total_price;
                    $invoice->total_paid = 0.00;
                    $invoice->total_unpaid = $obj->total_price;
                    $invoice->created_by = auth()->user()->name;
                    $invoice->save();
              
                    return redirect('/orders')->with('success', 'Order Received & Invoice Created!');  //set success msg for messages.blade
                }
            }
            
        });
    }
    
    public function getCreatedAtAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d h:i:s A');
    }

    public function getUpdatedAtAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d h:i:s A');
    }
    
    public function account(){
        return $this->belongsTo(Account::class);
    }
    
    public function invoice(){
        return $this->hasOne(Invoice::class)->orderBy('created_at', 'DESC');
    }
}

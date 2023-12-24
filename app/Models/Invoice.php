<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function payment(){
        return $this->belongsTo(Payment::class, 'id', 'invoice_id');
    }

    public function invoiceDetails(){
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }
}

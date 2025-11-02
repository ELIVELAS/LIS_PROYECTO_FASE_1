<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $fillable = [
        'user_id','offer_id','qty','card_last4','card_exp','invoice_code','unit_price','total'
    ];
    protected $casts = ['card_exp' => 'date'];

    public function user(): BelongsTo  { return $this->belongsTo(User::class); }
    public function offer(): BelongsTo { return $this->belongsTo(Offer::class); }
}

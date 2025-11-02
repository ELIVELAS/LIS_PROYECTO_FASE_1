<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['company_id','title','description','price','discount','start_date','end_date','is_active'];
    public $timestamps = true;

    public function company(){ return $this->belongsTo(Company::class); }
}

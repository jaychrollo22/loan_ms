<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function borrower(){
        return $this->belongsTo(Borrower::class,'borrower_id','id');
    }
    public function type_info(){
        return $this->belongsTo(LoanType::class,'type','id');
    }
}

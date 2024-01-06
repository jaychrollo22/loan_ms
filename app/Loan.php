<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Loan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function borrower(){
        return $this->belongsTo(Borrower::class,'borrower_id','id');
    }
    public function type_info(){
        return $this->belongsTo(LoanType::class,'type','id');
    }
}

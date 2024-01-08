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

    public function payments(){
        return $this->hasMany(LoanPayment::class)->orderBy('created_at','DESC');
    }

    public function amount_to_pay(){
        $date_today = date('Y-m-d');
        return $this->hasMany(LoanBilling::class)->where('schedule_date','>=', $date_today)->orderBy('created_at','DESC');
    }

    public function billings(){
        return $this->hasMany(LoanBilling::class)->orderBy('created_at','DESC');
    }

}

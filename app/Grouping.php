<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Grouping extends Model implements Auditable
{
    use SoftDeletes,\OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','loan_officer_id'
    ];

    public function loanOfficer(){
        return $this->belongsTo(User::class,'loan_officer_id');
    }
}

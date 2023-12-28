<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CoBorrower extends Model implements Auditable
{
    use SoftDeletes,\OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'borrower_id','business_name','first_name','middle_name','last_name','suffix',
        'country_id','region_id','county_id','township_id','address','property_type_id','age',
        'civil_status_id','contact_number','email_address','valid_id_type_id','id_number',
        'relationship_id','nature_of_business_id','business_address','business_property_type_id',
        'monthly_sale','monthly_profit','file_name','file_path'
    ];
}

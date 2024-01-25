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
        'country_id','region_id','county_id','township_id','city','address','property_type_id','age',
        'civil_status_id','contact_number','email_address','valid_id_type_id','id_number',
        'relationship_id','nature_of_business_id','business_address','business_property_type_id',
        'monthly_sale','monthly_profit','file_name','file_path'
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function county(){
        return $this->belongsTo(County::class);
    }

    public function township(){
        return $this->belongsTo(Township::class);
    }

    public function propertyType(){
        return $this->belongsTo(PropertyType::class);
    }

    public function civilStatus(){
        return $this->belongsTo(CivilStatus::class);
    }

    public function validIdType(){
        return $this->belongsTo(ValidIdType::class);
    }

    public function natureOfBusiness(){
        return $this->belongsTo(NatureOfBusiness::class);
    }

    public function businessPropertyType(){
        return $this->belongsTo(PropertyType::class);
    }
}

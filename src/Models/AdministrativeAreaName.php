<?php

namespace Neo\NepLocation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeAreaName extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];

    public function areaType()
    {
        return $this->hasOne(AdministrativeAreaType::class, 'id', 'area_type_id');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }
}

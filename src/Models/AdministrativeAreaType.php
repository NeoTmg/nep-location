<?php

namespace Neo\NepLocation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeAreaType extends Model
{
    use HasFactory;
    protected $table = "administrative_area_types";
    protected $fillable = [];
    protected $guarded = [];
}

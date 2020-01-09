<?php
namespace App;


class Brand extends BaseModel
{
    protected $table = "brands";
    protected $fillable = [
        'name' , 'slug' , 'description',
        "display_order", "is_active", "logo",
        "created_by", "updated_by"
    ] ;

}

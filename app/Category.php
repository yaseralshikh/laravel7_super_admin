<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);

    }//end of products

    public function getPaginatedProductsAttribute(){
        return $this->products()->paginate(4);
    }// end of Paginated Products
}

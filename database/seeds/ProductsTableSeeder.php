<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['pro one', 'pro two' , 'pro three'];
        $category_id = [1, 2, 3];

        foreach ($products as $index=>$product) {

            \App\Product::create([
                'category_id' => $category_id[$index],
                'name' => $product,
                'description' => $product . ' desc',
                'purchase_price' => 100,
                'sale_price' => 150.5,
                'stock' => 100,
            ]);

        }//end of foreach

    }//end of run

}//end of seeder

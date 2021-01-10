<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $categories = [
          ['name'=>'Electronics','is_parent'=>1], //1
          ['name'=>'Mobile','parent_id'=>1], //2
          ['name'=>'Tablets','parent_id'=>1], 
          ['name'=>'Laptops','parent_id'=>1], 
      
          ['name'=>'kitchn','is_parent'=>true], //5
          ['name'=>'cup','parent_id'=>5], //4
          ['name'=>'furniture','parent_id'=>5], //4

          ['name'=>'Personal Care','is_parent'=>true], //8
          ['name'=>'Mens grooming','parent_id'=>8], //4
          ['name'=>'Foundation','parent_id'=>8], //4

          ['name'=>'Grocery & Pets','is_parent'=>true], //11
          ['name'=>'Beverages','parent_id'=>11], //4
          ['name'=>'Breakfast','parent_id'=>11], //4
      
        ];
        foreach($categories as $category){
          Category::create([
              'name'=>$category['name'],
              'slug'=>Str::slug($category['name']),
              'is_parent'=>$category['is_parent'] ?? 0,
              'parent_id'=>$category['parent_id'] ?? null
          ]);
        }

        // $categories = [
        //     [
        //         'name' => 'Electronics',
        //         'subCategory' => ['Mobile', 'Tablets', 'Laptops', 'Desktops', 'Televisions', 'Gaming Consoles', 'Printers']
        //     ],
        //     [
        //         'name' => 'Electronic Accessories',
        //         'subCategory' => ['Phone Cases', 'Chargers', 'Headphones', 'SmartWatches', 'BlueTooth Speakers', 'Screen protectors']
        //     ],
        //     [
        //         'name' => 'Personal Care',
        //         'subCategory' => ['Mens grooming', 'Mens grooming', 'Foundation', 'Deodrants', 'Female hygiene', 'Soap handwash', 'Skin care', 'Hair care']
        //     ],
        //     [
        //         'name' => 'Babys & Toys',
        //         'subCategory' => ['Disposable Diapers', 'Baby Gear', 'Personal Care', 'Toys & Games']
        //     ],
        //     [
        //         'name' => 'Grocery & Pets',
        //         'subCategory' => ['Beverages', 'Breakfast', 'Fruits', 'Vegetables', 'Pet Food', 'Daily Food']
        //     ],
        //     [
        //         'name' => 'Home & Lifestyle',
        //         'subCategory' => ['Bath', 'Bedding', 'Decor', 'Furniture', 'Appliances & Electicals',  'Kitchen Utensils']
        //     ],
        //     [
        //         'name' => 'Sports & Outdoors',
        //         'subCategory' => ['Mens Collections', 'Womens Collections', 'Exercise & Fitness', 'Travel & Luggage']
        //     ],
        //     [
        //         'name' => 'AutoMotive & Motorbike',
        //         'subCategory' => ['Auto Motive', 'Motorcycle', 'Moto Parts & Accessories', 'Riding gear']
        //     ],
        // ];

        // foreach ($categories as $category) {

        //     $newCategory = Category::create([
        //         'category_name' => $category['name'],
        //     ]);
        //     foreach ($category['subCategory'] as $item) {
        //         $subcategory = SubCategory::create([
        //             'category_id' => $newCategory->id,
        //             'subCategory_name' => $item,
        //         ]);
        //     }
        // }
    }
}

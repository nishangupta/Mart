<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $description = "
        <div>
           <div>
              <ul>
                 <li>
                    <span>Brand  </span>
                    <div>Lenovo</div>
                 </li>
                 <li>
                    <span>SKU  </span>
                    <div>LE599FA08295GNAFAMZ-185623</div>
                 </li>
                 <li>
                    <span>Compatible Laptop Size  </span>
                    <div  key-value>Not Specified</div>
                 </li>
                 <li>
                    <span>Closure Type  </span>
                    <div  key-value>Zippers</div>
                 </li>
                 <li>
                    <span> Dust Resistant  </span>
                    <div key-value>Not Specified</div>
                 </li>
                 <li>
                    <span > Lockable  </span>
                    <div key-value>Not Specified</div>
                 </li>
                 <li>
                    <span> Model </span>
                    <div>GX40Q17226</div>
                 </li>
              </ul>
           </div>
           <div >
              <span>What’s in the box</span>
              <div box-content-html>Blue B210 15.6 Laptop Backpack- GX40Q17226</div>
           </div>
        </div>";


        $products =  [
            [
                'title' => 'Apple iphone se 128gb',
                'subCategory' => 'Mobile',
                'price' => '50000',
                'sale_price' => '40000',
                'brand' => 'Apple',
                'img' => 'apple2'
            ],
            [
                'title' => 'Samsung new phone',
                'subCategory' => 'Mobile',
                'price' => 45000,
                'sale_price' => 25000,
                'brand' => 'Samsung',
                'img' => 'phone3'
            ],
            [
                'title' => 'Samsung budget phone 2gb 64gb',
                'subCategory' => 'Mobile',
                'price' => 23000,
                'sale_price' => 53000,
                'brand' => 'Samsung',
                'img' => 'phone2'
            ],
            [
                'title' => 'Silicone Cooking Oil Bottle with Basting Brush palstic Round Pastry',
                'subCategory' => 'Kitchen Utensils',
                'price' => 20000,
                'sale_price' => 14000,
                'img' => 'pan'
            ],
            [
                'title' => 'high grade genuine leather-touchscreen-gloves',
                'subCategory' => 'Riding gear',
                'price' => 4300,
                'sale_price' => 2200,
                'img' => 'iconglove'
            ],
            [
                'title' => 'blackblue m1 ninja full face mask',
                'subCategory' => 'Mens grooming',
                'price' => 250,
                'sale_price' => 200,
                'img' => 'mask'
            ],
            [
                'title' => 'Ram 2gb',
                'subCategory' => 'Desktops',
                'price' => 3000,
                'sale_price' => 2400,
                'img' => 'ram'
            ],
            [
                'title' => 'Luxury Shockproof Semi Transparent Matte Finish Case for Oneplus 7T',
                'subCategory' => 'Phone cases',
                'price' => 300,
                'sale_price' => 240,
                'img' => 'phonecase'
            ],
            [
                'title' => 'Masala Beads Luxury Fashion Diamond Crystal Bracelet Hand Chain Bling Glitter Soft Case Cover',
                'subCategory' => 'Phone cases',
                'price' => 150,
                'sale_price' => 120,
                'img' => 'phonecase1'
            ],
            [
                'title' => 'Blackmaroon baseball t-shirt for women',
                'subCategory' => 'Womens Collections',
                'price' => 5000,
                'sale_price' => 2500,
                'img' => 'female-tshirt'
            ],
            [
                'title' => 'Pure Cotton Home And Bath Towel',
                'subCategory' => 'Bath',
                'price' => 500,
                'sale_price' => 450,
                'img' => 'bath'
            ],
            [
                'title' => 'Imperial Leather Classic Soap 115G',
                'subCategory' => 'Bath',
                'price' => 900,
                'sale_price' => 850,
                'img' => 'bath1'
            ],
            [
                'title' => 'multifunctional electric skillet cooker',
                'subCategory' => 'Appliances & Electicals',
                'price' => 4500,
                'sale_price' => 4200,
                'img' => 'kitchen2'
            ],
            [
                'title' => 'pack of 3 autumn full sleeves tshirt',
                'subCategory' => 'Mens Collections',
                'price' => 5499,
                'sale_price' => 4500,
                'img' => 'tshirt2'
            ],
            [
                'title' => 'Samsung mobile charger with usb-cable',
                'subCategory' => 'Chargers',
                'price' => 400,
                'sale_price' => 250,
                'img' => 'charger'
            ],
            [
                'title' => 'Geemy rechargeable grooming-kit',
                'subCategory' => 'Mens grooming',
                'price' => 5400,
                'sale_price' => 3400,
                'img' => 'grooming1'
            ],
            [
                'title' => 'Educational laptop for kids abc-and-123-learning',
                'subCategory' => 'Toys & Games',
                'price' => 5000,
                'sale_price' => 3500,
                'img' => 'lego2'
            ],
            [
                'title' => 'lego mclaren 720s i101136940',
                'subCategory' => 'Toys & Games',
                'price' => 6000,
                'sale_price' => 4500,
                'img' => 'lego1'
            ],
            [
                'title' => 'Slice mango tropicana',
                'subCategory' => 'Beverages',
                'price' => 250,
                'sale_price' => 200,
                'img' => 'mango'
            ],
            [
                'title' => 'bru-3-in-1 premix coffee-330gm',
                'subCategory' => 'Breakfast',
                'price' => 5400,
                'sale_price' => 3400,
                'img' => 'coffee'
            ],
            [
                'title' => 'wiwu laptop screen protector-film-for-macbook-13',
                'subCategory' => 'Screen protectors',
                'price' => 600,
                'sale_price' => 500,
                'img' => 'macbook2'
            ],
            [
                'title' => 'Apple Mac book',
                'subCategory' => 'Laptops',
                'price' => 60000,
                'sale_price' => 55000,
                'img' => 'macbook2'
            ],
            [
                'title' => 'Manual hand crank single auger juicer',
                'subCategory' => 'Appliances & Electicals',
                'price' => 5500,
                'sale_price' => 3400,
                'img' => 'kitchen3'
            ],
            [
                'title' => 'caliber-shoes-white-ultralight',
                'subCategory' => 'Exercise & Fitness',
                'price' => 5000,
                'sale_price' => 3500,
                'img' => 'shoes'
            ],
            [
                'title' => 'lenovo blue laptop backpack',
                'subCategory' => 'Travel & Luggage',
                'price' => 4500,
                'sale_price' => 4200,
                'img' => 'bag'
            ],
            [
                'title' => 'Dog food best quality',
                'subCategory' => 'Pet Food',
                'price' => 4500,
                'sale_price' => 4200,
                'img' => 'pet'
            ],
            [
                'title' => 'Coke 2lr bottle',
                'subCategory' => 'Beverages',
                'price' => 450,
                'sale_price' => 420,
                'img' => 'coke'
            ],
            [
                'title' => 'Dettol soap',
                'subCategory' => 'Deodrants',
                'price' => 450,
                'sale_price' => 420,
                'img' => 'detol'
            ],
            [
                'title' => 'Apple 2kg',
                'subCategory' => 'Fruits',
                'price' => 350,
                'sale_price' => 240,
                'img' => 'apple'
            ],
            [
                'title' => 'diaper baby soft material',
                'subCategory' => 'Diapers',
                'price' => 500,
                'sale_price' => 450,
                'img' => 'diaper'
            ],
            [
                'title' => 'Bed sheet',
                'subCategory' => 'Furniture',
                'price' => 3530,
                'sale_price' => 2440,
                'img' => 'bed'
            ],
            [
                'title' => 'Furnitute for dining',
                'subCategory' => 'Furniture',
                'price' => 32530,
                'sale_price' => 22440,
                'img' => 'bed2'
            ],

        ];

        foreach ($products as $product) {
            $newProduct = Product::create([
                'user_id' => 1,
                'title' => $product['title'],
                'subCategory' => $product['subCategory'],
                'price' => $product['price'],
                'sale_price' => $product['sale_price'],
                'onSale' => 1,
                'slug' => Str::slug($product['title']),
                'brand' => $product['brand'] ?? '',
                'product_code' => Str::upper(Str::random(6)),
                'description' => $description,
                'stock' => rand(3, 50),
            ]);
            $productImage = ProductImage::create([
                'product_id' => $newProduct->id,
                'original' => 'images/products/' . $product['img'] . '.jpg',
                'thumbnail' => 'images/products/' . $product['img'] . '.jpg',
            ]);
        }
    }
}

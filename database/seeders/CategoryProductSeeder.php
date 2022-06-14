<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            [
                'name' => 'Kesehatan & Kecantikan',
                'enable' => true,
            ],
            [
                'name' => 'Komputer & Laptop',
                'enable' => true,
            ],
            [
                'name' => 'Peralatan Rumah Tangga',
                'enable' => false,
            ],
            [
                'name' => 'Fashion',
                'enable' => true,
            ],
        ];
        $products = [
            // Komputer & Laptop
            [
                'name' => 'Dell Latitude 7490',
                'description' => 'Dell Latitude 7490 merupakan laptop dengan spesifikasi yang mumpuni. Dibekali dengan Intel Core i7 yang sangat cepat serta RAM 8GB yang akan menunjang pekerjaan Anda. Laptop ini juga sudah dipasangkan SSD dengan kapasitas 256GB. Dell menawarkan peforma yang cukup menjanjikan dalam mendukung aktifitas komputasi sehari-hari hingga kebutuhan entertaiment.',
                'enable' => true,
                'category' => 2
            ],
            [
                'name' => 'Razer Blade Stealth 13',
                'description' => 'Razer Blade Stealth 13 Ultrabook Gaming Laptop: Intel Quad Core i7-1065G7, NVIDIA GeForce GTX 1650 Ti Max-Q, 13.3" 4K Touch, 16GB RAM, 512GB SSD, CNC Aluminum, Chroma RGB, Thunderbolt 3, Creator Ready.',
                'enable' => true,
                'category' => 2
            ],

            // Kesehatan & Kecantikan
            [
                'name' => 'Sisir Rambut Salon Hair Comb 10 Set',
                'description' => 'Sisir set ini memiliki 10 jenis sisir yang berbeda. Sisir-sisir ini biasa digunakan untuk menata atau memotong rambut. Anda dapat menggunakan sisir-sisir ini sesuai kebutuhan. Setiap sisir dapat memberikan penampilan yang berbeda, karena memiliki tingkat kerapatan gigi yang bervariasi.',
                'enable' => true,
                'category' => 1
            ],
            [
                'name' => 'Outdoor First Aid Kit P3K 13 in 1',
                'description' => 'Outdoor First Aid Kit 13 in 1 adalah tas berisikan 13 alat untuk pertolongan pertama, yang Anda butuhkan pada saat terluka ketika berpetualang, camping atau saat traveling. Semua barang yang Anda butuhkan tersedia didalam tas P3K ini.',
                'enable' => true,
                'category' => 1
            ],

            // Fashion
            [
                'name' => 'Rhodey Tali Ikat Pinggang Canvas Military',
                'description' => 'Ikat pinggang militer tactical membuat penampilan anda semakin keren seperti tentara. Dengan desain fast unlock yang membuat anda tidak repot pada saat penggunaan nya. Material canvas yang di gunakan membuat ikat pinggang ini sangat kuat dan tahan lama. Logo Rhodey pada varian hijau',
                'enable' => true,
                'category' => 4
            ],
            [
                'name' => 'Jaket Baseball',
                'description' => 'Jaket Casual Uniseu yang membuat Anda tampak terlihat modis namun tetap terlihat kasual.Menggunakan bahan Fleece yang bertekstur lembut, hangat, dan sedikit berbulu tentunya akan membuat Anda merasa hangat dan nyaman.',
                'enable' => true,
                'category' => 4
            ],
        ];

        foreach ($categories as $category)
            Category::insert($category);
        foreach ($products as $product) {
            $data = Product::create([
                'name'=>$product['name'],
                'description'=>$product['description'],
                'enable'=>$product['enable'],
            ]);
            
            DB::table('category_product')->insert([
                'product_id' => $data->id,
                'category_id' => $product['category'],
            ]);
        }
    }
}

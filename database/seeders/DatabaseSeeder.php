<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\DeliverySetting;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@mars.lk'],
            [
                'name' => 'Admin',
                'password' => 'password123',
                'is_admin' => true,
            ]
        );

        // Demo Customer
        User::updateOrCreate(
            ['email' => 'customer@mars.lk'],
            [
                'name' => 'John Customer',
                'password' => 'password123',
                'phone' => '+94 77 123 4567',
                'is_admin' => false,
            ]
        );

        // Delivery Settings
        DeliverySetting::updateOrCreate(
            ['id' => 1],
            [
                'first_kg_charge' => 500.00,
                'additional_kg_charge' => 200.00,
                'is_active' => true,
            ]
        );

        // Site Settings
        $settings = [
            'site_name' => 'Mars Stationery',
            'phone' => '+94 11 234 5678',
            'email' => 'info@mars.lk',
            'address' => '123 Main Street, Colombo 03, Sri Lanka',
            'bank_name' => 'Commercial Bank of Ceylon',
            'bank_account' => '1234567890',
            'bank_branch' => 'Colombo Main',
            'bank_holder' => 'Mars Stationery (Pvt) Ltd',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Categories
        $categories = [
            ['name' => 'Pens & Pencils', 'slug' => 'pens-pencils', 'sort_order' => 1],
            ['name' => 'Notebooks & Journals', 'slug' => 'notebooks-journals', 'sort_order' => 2],
            ['name' => 'Paper & Printing', 'slug' => 'paper-printing', 'sort_order' => 3],
            ['name' => 'Files & Folders', 'slug' => 'files-folders', 'sort_order' => 4],
            ['name' => 'Art Supplies', 'slug' => 'art-supplies', 'sort_order' => 5],
            ['name' => 'Office Supplies', 'slug' => 'office-supplies', 'sort_order' => 6],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                array_merge($cat, ['is_active' => true])
            );
        }

        // Products
        $products = [
            ['name' => 'Pilot G2 Gel Pen (Black)', 'category' => 'pens-pencils', 'price' => 350, 'weight' => 15, 'sku' => 'PEN-PLT-001', 'is_featured' => true, 'is_new_arrival' => false, 'description' => 'Premium gel ink pen with comfortable rubber grip. Smooth writing experience with 0.7mm tip.'],
            ['name' => 'Faber-Castell 2B Pencil Pack (12)', 'category' => 'pens-pencils', 'price' => 480, 'weight' => 120, 'sku' => 'PEN-FC-002', 'is_featured' => true, 'is_new_arrival' => true, 'description' => 'High-quality graphite pencils, ideal for writing and sketching. Pack of 12 pencils.'],
            ['name' => 'Uni-ball Signo Broad (Blue)', 'category' => 'pens-pencils', 'price' => 420, 'sale_price' => 350, 'weight' => 18, 'sku' => 'PEN-UNI-003', 'is_featured' => false, 'is_new_arrival' => true, 'description' => 'Bold 1.0mm gel pen with vibrant blue ink. Water-resistant and fade-proof.'],
            ['name' => 'Hardcover A5 Notebook (200 pages)', 'category' => 'notebooks-journals', 'price' => 890, 'weight' => 350, 'sku' => 'NB-HC-001', 'is_featured' => true, 'is_new_arrival' => false, 'description' => 'Premium hardcover notebook with 200 ruled pages. Bookmark ribbon and elastic closure.'],
            ['name' => 'Spiral Notebook A4 (100 pages)', 'category' => 'notebooks-journals', 'price' => 550, 'weight' => 280, 'sku' => 'NB-SP-002', 'is_featured' => false, 'is_new_arrival' => true, 'description' => 'Wire-bound notebook with perforated pages. Ideal for students and professionals.'],
            ['name' => 'A4 Copy Paper (500 Sheets)', 'category' => 'paper-printing', 'price' => 1250, 'sale_price' => 999, 'weight' => 2500, 'sku' => 'PPR-A4-001', 'is_featured' => true, 'is_new_arrival' => false, 'description' => 'High-quality 80gsm A4 paper. Suitable for all printers and copiers. 500 sheet ream.'],
            ['name' => 'Colour Paper Pack (Assorted)', 'category' => 'paper-printing', 'price' => 650, 'weight' => 800, 'sku' => 'PPR-CLR-002', 'is_featured' => false, 'is_new_arrival' => true, 'description' => '100 sheets of assorted colour paper. A4 size, 80gsm. 10 vibrant colours.'],
            ['name' => 'Clear L-Folder (Pack of 10)', 'category' => 'files-folders', 'price' => 380, 'weight' => 150, 'sku' => 'FIL-LF-001', 'is_featured' => true, 'is_new_arrival' => false, 'description' => 'Transparent L-shaped folders for document organization. A4 size, durable plastic.'],
            ['name' => 'Lever Arch File (A4)', 'category' => 'files-folders', 'price' => 750, 'sale_price' => 620, 'weight' => 450, 'sku' => 'FIL-LA-002', 'is_featured' => false, 'is_new_arrival' => false, 'description' => 'Heavy-duty lever arch file with strong metal mechanism. Holds up to 500 sheets.'],
            ['name' => 'Watercolour Paint Set (24 colours)', 'category' => 'art-supplies', 'price' => 1850, 'weight' => 320, 'sku' => 'ART-WC-001', 'is_featured' => true, 'is_new_arrival' => true, 'description' => 'Professional grade watercolour paint set with 24 vibrant colours. Includes mixing palette.'],
            ['name' => 'Sketch Pad A3 (50 pages)', 'category' => 'art-supplies', 'price' => 980, 'weight' => 600, 'sku' => 'ART-SK-002', 'is_featured' => false, 'is_new_arrival' => true, 'description' => 'Heavy-weight 160gsm sketch pad. Acid-free paper suitable for all dry media.'],
            ['name' => 'Stapler Heavy Duty', 'category' => 'office-supplies', 'price' => 1200, 'sale_price' => 950, 'weight' => 380, 'sku' => 'OFF-STP-001', 'is_featured' => true, 'is_new_arrival' => false, 'description' => 'Heavy-duty stapler that handles up to 100 sheets. Comes with 1000 staples.'],
            ['name' => 'Scotch Tape Dispenser + 3 Rolls', 'category' => 'office-supplies', 'price' => 680, 'weight' => 200, 'sku' => 'OFF-TPE-002', 'is_featured' => false, 'is_new_arrival' => true, 'description' => 'Desktop tape dispenser with 3 rolls of clear tape. Non-slip weighted base.'],
            ['name' => 'Correction Tape (5mm x 8m)', 'category' => 'office-supplies', 'price' => 250, 'weight' => 25, 'sku' => 'OFF-COR-003', 'is_featured' => true, 'is_new_arrival' => false, 'description' => 'Quick-dry correction tape. Smooth application, easy to write over. 8 metres long.'],
        ];

        $imageIndex = 1;
        foreach ($products as $p) {
            $catSlug = $p['category'];
            $category = Category::where('slug', $catSlug)->first();
            unset($p['category']);

            $product = Product::updateOrCreate(
                ['sku' => $p['sku']],
                array_merge($p, [
                    'slug' => Str::slug($p['name']),
                    'category_id' => $category->id,
                    'stock_quantity' => rand(20, 200),
                    'is_active' => true,
                    'sale_price' => $p['sale_price'] ?? null,
                ])
            );

            $imgFile = sprintf('products/product-%02d.jpg', $imageIndex);
            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'is_primary' => true],
                ['image_path' => $imgFile, 'sort_order' => 0]
            );
            $imageIndex++;
        }

        // Banners
        $banners = [
            ['title' => 'Premium Stationery Collection', 'subtitle' => 'Discover our wide range of quality stationery products', 'sort_order' => 1, 'image' => 'banners/banner-01.jpg'],
            ['title' => 'Back to School Essentials', 'subtitle' => 'Everything you need for the new school year', 'sort_order' => 2, 'image' => 'banners/banner-02.jpg'],
            ['title' => 'Office Supplies Sale', 'subtitle' => 'Up to 40% off on selected office supplies', 'sort_order' => 3, 'image' => 'banners/banner-03.jpg'],
        ];

        foreach ($banners as $b) {
            $image = $b['image'];
            unset($b['image']);
            Banner::updateOrCreate(
                ['title' => $b['title']],
                array_merge($b, ['is_active' => true, 'link' => '/products', 'image' => $image])
            );
        }

        // Brands
        $brands = [
            ['name' => 'Pilot', 'sort_order' => 1],
            ['name' => 'Faber-Castell', 'sort_order' => 2],
            ['name' => 'Stabilo', 'sort_order' => 3],
            ['name' => 'Staedtler', 'sort_order' => 4],
            ['name' => 'Atlas', 'sort_order' => 5],
            ['name' => '3M', 'sort_order' => 6],
        ];

        foreach ($brands as $b) {
            Brand::updateOrCreate(
                ['name' => $b['name']],
                array_merge($b, ['is_active' => true])
            );
        }

        $this->command->info('Database seeded successfully!');
    }
}

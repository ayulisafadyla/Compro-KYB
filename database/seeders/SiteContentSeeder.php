<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;
use App\Models\Page;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        // Site Settings
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'PT Kayaba Indonesia', 'type' => 'text', 'group' => 'general', 'label' => 'Site Name'],
            ['key' => 'site_description', 'value' => 'Official Website of PT Kayaba Indonesia', 'type' => 'textarea', 'group' => 'general', 'label' => 'Site Description'],
            
            // Homepage Video Banner
            ['key' => 'home_video_title', 'value' => "TONTON VIDEO\nKAMI", 'type' => 'textarea', 'group' => 'homepage', 'label' => 'Video Title'],
            ['key' => 'home_video_subtitle', 'value' => 'Presisi Kami, Keuntungan Anda', 'type' => 'text', 'group' => 'homepage', 'label' => 'Video Subtitle'],
            ['key' => 'home_video_url', 'value' => 'https://www.youtube.com/watch?v=2h5unVOZvL4', 'type' => 'url', 'group' => 'homepage', 'label' => 'Video URL'],
            
            // SEO
            ['key' => 'meta_title', 'value' => 'PT Kayaba Indonesia - Shock Absorber Specialist', 'type' => 'text', 'group' => 'seo', 'label' => 'Meta Title'],
            ['key' => 'meta_description', 'value' => 'PT Kayaba Indonesia is the largest shock absorber manufacturer in Indonesia.', 'type' => 'textarea', 'group' => 'seo', 'label' => 'Meta Description'],
            
            // Analytics
            ['key' => 'google_analytics_id', 'value' => '', 'type' => 'text', 'group' => 'analytics', 'label' => 'Google Analytics ID'],

            // Maintenance
            ['key' => 'maintenance_mode', 'value' => '0', 'type' => 'text', 'group' => 'maintenance', 'label' => 'Maintenance Mode (1 for ON, 0 for OFF)'],
            ['key' => 'maintenance_message', 'value' => 'Website is under maintenance. Please check back later.', 'type' => 'textarea', 'group' => 'maintenance', 'label' => 'Maintenance Message'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // Home About Sections
        $abouts = [
            [
                'title' => 'SEJARAH PERUSAHAAN',
                'content' => '<p>PT Kayaba Indonesia didirikan pada 25 Februari 1976 dengan nama awal PT Kayaba Jepang kemudian menjalin kerja sama dengan PT Astra Otoparts Tbk. dan berkembang menjadi PT Kayaba Indonesia.</p><p>Saat ini Perusahaan memproduksi berbagai komponen suspensi, seperti front fork dan oil cushion unit, serta terus mengembangkan inovasi teknologi dan proses produksi.</p>',
                'order' => 1,
            ],
        ];

        foreach ($abouts as $about) {
            \App\Models\HomeAbout::updateOrCreate(['title' => $about['title']], $about);
        }

        // Home Video Banner
        \App\Models\HomeVideo::updateOrCreate(
            ['video_url' => 'https://www.youtube.com/watch?v=2h5unVOZvL4'],
            [
                'title' => "TONTON VIDEO\nKAMI",
                'subtitle' => 'Presisi Kami, Keuntungan Anda',
                'is_active' => true,
            ]
        );

        // Home Philosophies
        $philosophies = [
            [
                'title' => 'VISI',
                'content' => '<p><strong>Visi PT Kayaba Indonesia</strong><br>“To be world wide shock absorber production base for KYB group”.</p>',
                'icon' => 'eye',
                'order' => 1,
            ],
            [
                'title' => 'MISI',
                'content' => '<p><strong>Misi PT Kayaba Indonesia</strong><br>1. To be Number One in Cost and Quality for Two Wheelers in Shock Absorber in the World.<br>2. To Implement Astra Green Company, Astra Friendly Company, Security Community Dev & IR Management System, and KIPKA.</p>',
                'icon' => 'target',
                'order' => 2,
            ],
        ];

        foreach ($philosophies as $phil) {
            \App\Models\HomePhilosophy::updateOrCreate(['title' => $phil['title']], $phil);
        }

        // FAQs
        $faqs = [
            [
                'question' => 'Apa keunggulan KYB Shock Absorber?',
                'answer' => '<p>KYB Shock Absorber diproduksi dengan teknologi Jepang yang canggih dan melalui kontrol kualitas yang ketat (QC). Produk kami dirancang untuk memberikan kenyamanan maksimal, kestabilan berkendara, dan daya tahan yang lama di berbagai kondisi jalan di Indonesia.</p>',
                'order' => 1,
            ],
            [
                'question' => 'Apakah KYB menyediakan garansi untuk produknya?',
                'answer' => '<p>Ya, kami memberikan garansi untuk cacat produksi. Syarat dan ketentuan garansi berlaku dan dapat diklaim melalui tempat pembelian resmi dengan menyertakan bukti pembelian.</p>',
                'order' => 2,
            ],
            [
                'question' => 'Di mana saya bisa membeli produk KYB?',
                'answer' => '<p>Produk KYB tersedia di seluruh Indonesia melalui jaringan distributor resmi, bengkel rekanan, dan toko suku cadang terpercaya. Anda juga bisa menemukannya di marketplace resmi kami.</p>',
                'order' => 3,
            ],
        ];

        foreach ($faqs as $faq) {
            \App\Models\Faq::updateOrCreate(['question' => $faq['question']], $faq);
        }

        // About Sections (for Static Page)
        $aboutSections = [
            [
                'title' => 'Visi & Misi',
                'content' => '<p>PT Kayaba Indonesia memiliki visi untuk menjadi basis produksi shock absorber kelas dunia bagi grup KYB. Kami berkomitmen untuk memberikan kualitas terbaik dengan biaya yang kompetitif.</p>',
                'order' => 1,
            ],
            [
                'title' => 'Jangkauan Kami',
                'content' => '<p>Dengan jaringan distribusi yang luas, produk KYB dapat ditemukan di seluruh penjuru Indonesia, melayani kebutuhan kendaraan roda dua maupun roda empat.</p>',
                'order' => 2,
            ],
        ];

        foreach ($aboutSections as $section) {
            \App\Models\AboutSection::updateOrCreate(['title' => $section['title']], $section);
        }

        // Contact Items
        $contactItems = [
            ['label' => 'Hubungi Kami', 'value' => '+62 21 8981456', 'icon' => 'telephone', 'order' => 1],
            ['label' => 'Email Kami', 'value' => 'contact@kyb.co.id', 'icon' => 'envelope', 'order' => 2],
            ['label' => 'Alamat Kami', 'value' => 'Kawasan Industri MM2100, Bekasi', 'icon' => 'geo-alt', 'order' => 3],
        ];

        foreach ($contactItems as $item) {
            \App\Models\ContactItem::updateOrCreate(['label' => $item['label']], $item);
        }

        // Policy Sections
        $policySections = [
            ['title' => 'Pengumpulan Data', 'content' => '<p>Kami mengumpulkan data yang Anda berikan secara sukarela untuk keperluan layanan dan informasi produk.</p>', 'order' => 1],
            ['title' => 'Penggunaan Informasi', 'content' => '<p>Informasi yang dikumpulkan digunakan untuk meningkatkan kualitas layanan dan komunikasi dengan pelanggan.</p>', 'order' => 2],
        ];

        foreach ($policySections as $section) {
            \App\Models\PolicySection::updateOrCreate(['title' => $section['title']], $section);
        }

        // Events
        $events = [
            // Launch (From event-launching.blade.php)
            [
                'title' => 'Launching KYB Ultra Series 2026',
                'slug' => 'launching-kyb-ultra-series-2026',
                'description' => 'Peluncuran produk shock absorber terbaru dengan teknologi gas-charged untuk performa maksimal kendaraan Anda.',
                'content' => '<p>Peluncuran produk shock absorber terbaru dengan teknologi gas-charged untuk performa maksimal kendaraan Anda.</p>',
                'date' => '2026-03-15',
                'type' => 'launch',
                'is_published' => true,
            ],
            [
                'title' => 'Launching KYB Sport Edition',
                'slug' => 'launching-kyb-sport-edition',
                'description' => 'Produk khusus untuk motor sport dengan handling superior dan stabilitas tinggi di kecepatan tinggi.',
                'content' => '<p>Produk khusus untuk motor sport dengan handling superior dan stabilitas tinggi di kecepatan tinggi.</p>',
                'date' => '2026-03-22',
                'type' => 'launch',
                'is_published' => true,
            ],
            [
                'title' => 'Launching KYB Excel-G Premium',
                'slug' => 'launching-kyb-excel-g-premium',
                'description' => 'Shock absorber premium untuk mobil keluarga dengan kenyamanan berkendara yang luar biasa.',
                'content' => '<p>Shock absorber premium untuk mobil keluarga dengan kenyamanan berkendara yang luar biasa.</p>',
                'date' => '2026-04-05',
                'type' => 'launch',
                'is_published' => true,
            ],
            [
                'title' => 'Launching KYB Heavy Duty Series',
                'slug' => 'launching-kyb-heavy-duty-series',
                'description' => 'Solusi suspensi untuk kendaraan komersial dan truk dengan daya tahan ekstra untuk beban berat.',
                'content' => '<p>Solusi suspensi untuk kendaraan komersial dan truk dengan daya tahan ekstra untuk beban berat.</p>',
                'date' => '2026-04-18',
                'type' => 'launch',
                'is_published' => true,
            ],
            [
                'title' => 'Launching KYB E-Bike Suspension',
                'slug' => 'launching-kyb-e-bike-suspension',
                'description' => 'Inovasi terbaru untuk sepeda listrik dengan teknologi suspensi yang ringan dan efisien.',
                'content' => '<p>Inovasi terbaru untuk sepeda listrik dengan teknologi suspensi yang ringan dan efisien.</p>',
                'date' => '2026-05-10',
                'type' => 'launch',
                'is_published' => true,
            ],
            [
                'title' => 'Launching KYB MonoMax 4x4',
                'slug' => 'launching-kyb-monomax-4x4',
                'description' => 'Shock absorber khusus untuk kendaraan off-road dengan performa terbaik di medan ekstrem.',
                'content' => '<p>Shock absorber khusus untuk kendaraan off-road dengan performa terbaik di medan ekstrem.</p>',
                'date' => '2026-05-25',
                'type' => 'launch',
                'is_published' => true,
            ],

            // Workshop
            [
                'title' => 'Technical Training: Shock Absorber Maintenance',
                'slug' => 'technical-training-maintenance-2024',
                'description' => 'Program pelatihan teknis bagi para mekanik dealer resmi KYB di seluruh Indonesia.',
                'content' => '<p>Pelatihan teknis ini bertujuan untuk meningkatkan kompetensi para mekanik dalam melakukan diagnosa dan penggantian shock absorber dengan standar prosedur KYB Jepang. Peserta akan mendapatkan sertifikasi resmi setelah menyelesaikan program.</p>',
                'date' => '2024-05-10',
                'type' => 'workshop',
                'is_published' => true,
            ],
            
            // Promo
            [
                'title' => 'Promo Mudik Aman Bersama KYB',
                'slug' => 'promo-mudik-aman-2024',
                'description' => 'Dapatkan diskon khusus pemeriksaan dan penggantian shock absorber sebelum perjalanan mudik Anda.',
                'content' => '<p>Pastikan kendaraan Anda dalam kondisi prima untuk perjalanan jauh. KYB memberikan penawaran spesial berupa potongan harga 15% untuk setiap pembelian set shock absorber di bengkel-bengkel bertanda khusus selama bulan Ramadan.</p>',
                'date' => '2024-04-01',
                'type' => 'promo',
                'is_published' => true,
            ],
            
            // Exhibition
            [
                'title' => 'KYB Exhibition at GIIAS 2024',
                'slug' => 'kyb-giias-2024',
                'description' => 'Kunjungi booth KYB di ajang pameran otomotif terbesar di Indonesia, GIIAS 2024.',
                'content' => '<p>KYB Indonesia kembali hadir di GIIAS 2024 dengan menampilkan berbagai inovasi terbaru dalam sistem suspensi. Pengunjung dapat berkonsultasi langsung dengan ahli teknis kami dan mencoba simulator kenyamanan berkendara di booth kami.</p>',
                'date' => '2024-07-20',
                'type' => 'exhibition',
                'is_published' => true,
            ],
        ];


        foreach ($events as $event) {
            \App\Models\Event::updateOrCreate(['slug' => $event['slug']], $event);
        }

        // Hero Banners
        $banners = [
            [
                'title' => "SOLUSI SUSPENSI\nTERBAIK DI DUNIA",
                'subtitle' => 'PRECISION ENGINEERED FOR COMFORT',
                'image' => 'banners/banner1.jpg', // Mock path
                'link' => '/#products',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => "TEKNOLOGI JEPANG\nUNTUK JALAN INDONESIA",
                'subtitle' => 'STABILITAS MAKSIMAL DI SETIAP KONDISI',
                'image' => 'banners/banner2.jpg', // Mock path
                'link' => '/event-launching',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => "KEUNGGULAN NYATA\nDI SETIAP PUTARAN",
                'subtitle' => 'PARTNER TERPERCAYA KENDARAAN ANDA',
                'image' => 'banners/banner3.jpg', // Mock path
                'link' => '/#contact',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            \App\Models\Banner::updateOrCreate(['title' => $banner['title']], $banner);
        }

        // Categories
        $categories = [
            ['name' => '2W', 'slug' => '2w', 'description' => 'Two Wheelers (Motorcycle) components'],
            ['name' => '4W', 'slug' => '4w', 'description' => 'Four Wheelers (Automotive) components'],
            ['name' => 'Sepeda', 'slug' => 'sepeda', 'description' => 'Bicycle components'],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Brands
        $brands = [
            ['name' => 'Toyota', 'logo' => 'brands/toyota.png', 'order' => 1],
            ['name' => 'Yamaha', 'logo' => 'brands/yamaha.png', 'order' => 2],
            ['name' => 'Honda', 'logo' => 'brands/honda.png', 'order' => 3],
            ['name' => 'Suzuki', 'logo' => 'brands/suzuki.png', 'order' => 4],
            ['name' => 'Daihatsu', 'logo' => 'brands/daihatsu.png', 'order' => 5],
            ['name' => 'Mitsubishi', 'logo' => 'brands/mitsubishi.png', 'order' => 6],
            ['name' => 'Astra Otoparts', 'logo' => 'brands/astra.png', 'order' => 7],
            ['name' => 'Kawasaki', 'logo' => 'brands/kawasaki.png', 'order' => 8],
        ];

        foreach ($brands as $brand) {
            \App\Models\Brand::updateOrCreate(['name' => $brand['name']], $brand);
        }

        // Products
        $cat2w = \App\Models\Category::where('slug', '2w')->first();
        $cat4w = \App\Models\Category::where('slug', '4w')->first();
        $catSepeda = \App\Models\Category::where('slug', 'sepeda')->first();

        $products = [
            // 2W
            [
                'category_id' => $cat2w->id,
                'name' => 'Rare Cushion Unit',
                'slug' => 'rare-cushion-unit',
                'description' => 'High quality rear shock absorber for motorcycles.',
                'price' => 0,
                'image' => 'products/2wrarecushion.png',
                'is_active' => true,
            ],
            [
                'category_id' => $cat2w->id,
                'name' => 'Front Frok',
                'slug' => 'front-frok',
                'description' => 'Precision engineered front fork for superior handling.',
                'price' => 0,
                'image' => 'products/2wfrontfrok.png',
                'is_active' => true,
            ],
            [
                'category_id' => $cat2w->id,
                'name' => 'KYB Trail Master',
                'slug' => 'kyb-trail-master',
                'description' => 'Specialized shock absorber for off-road and trail motorcycles.',
                'price' => 0,
                'image' => 'products/premium.png',
                'is_active' => true,
            ],
            // 4W
            [
                'category_id' => $cat4w->id,
                'name' => 'KYB Excel-G',
                'slug' => 'kyb-excel-g',
                'description' => 'Twin-tube gas shock absorbers for comfort and reliability.',
                'price' => 850000,
                'image' => 'products/kyb1.png',
                'is_active' => true,
            ],
            [
                'category_id' => $cat4w->id,
                'name' => 'KYB Gas-A-Just',
                'slug' => 'kyb-gas-a-just',
                'description' => 'Monotube gas shock absorbers for high-performance driving.',
                'price' => 720000,
                'image' => 'products/kyb1.png',
                'is_active' => true,
            ],
            [
                'category_id' => $cat4w->id,
                'name' => 'KYB MonoMax',
                'slug' => 'kyb-monomax',
                'description' => 'Heavy duty monotube gas shock absorbers for SUVs and Pick-ups.',
                'price' => 950000,
                'image' => 'products/kyb1.png',
                'is_active' => true,
            ],
            // Sepeda
            [
                'category_id' => $catSepeda->id,
                'name' => 'KYB Fork Suspension',
                'slug' => 'kyb-fork-suspension',
                'description' => 'MTB suspension fork for rugged terrains.',
                'price' => 1200000,
                'image' => 'products/kyb1.png',
                'is_active' => true,
            ],
            [
                'category_id' => $catSepeda->id,
                'name' => 'KYB E-Bike Shock',
                'slug' => 'kyb-e-bike-shock',
                'description' => 'Specialized rear shock for electric bicycles.',
                'price' => 980000,
                'image' => 'products/kyb1.png',
                'is_active' => true,
            ],
        ];

        foreach ($products as $prod) {
            \App\Models\Product::updateOrCreate(['slug' => $prod['slug']], $prod);
        }
    }
}


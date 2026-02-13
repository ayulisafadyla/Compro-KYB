<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $results = [];

        if ($query) {
            // Static search index - could be moved to a config or database later
            $searchIndex = [
                // Pages
                [
                    'title' => 'Beranda',
                    'url' => '/',
                    'content' => 'Halaman utama PT Kayaba Indonesia. Solusi suspensi kendaraan Anda, shock absorber, dan sparepart berkualitas.',
                    'keywords' => 'home, beranda, utama, kyb, kayaba'
                ],
                [
                    'title' => 'Acara Launching Produk',
                    'url' => '/event-launching',
                    'content' => 'Informasi mengenai acara peluncuran produk terbaru dari KYB. Temukan inovasi suspensi terkini.',
                    'keywords' => 'event, acara, launching, peluncuran, produk baru, new product'
                ],
                [
                    'title' => 'Pendaftaran / Karir',
                    'url' => 'https://hrd.kyb.co.id/recruitment/index.php',
                    'content' => 'Bergabunglah dengan tim PT Kayaba Indonesia. Lowongan kerja dan pendaftaran karir.',
                    'keywords' => 'karir, lowongan, kerja, recruitment, pendaftaran, hrd'
                ],
                
                // Sections on Home Page
                [
                    'title' => 'Tentang Kami',
                    'url' => '/#about',
                    'content' => 'Profil perusahaan PT Kayaba Indonesia. Sejarah, Visi, Misi, dan filosofi perusahaan.',
                    'keywords' => 'about, tentang, profil, sejarah, visi, misi'
                ],
                [
                    'title' => 'Produk Kami',
                    'url' => '/#products',
                    'content' => 'Katalog produk shock absorber KYB untuk motor (2W) dan mobil (4W). Kualitas OEM & OES terbaik.',
                    'keywords' => 'produk, product, katalog, shock, absorber, suspensi, motor, mobil'
                ],
                [
                    'title' => 'Hubungi Kami',
                    'url' => '/#contact',
                    'content' => 'Informasi kontak PT Kayaba Indonesia. Alamat, telepon, email, dan lokasi kantor.',
                    'keywords' => 'kontak, contact, hubungi, alamat, telepon, email, lokasi'
                ],
                [
                    'title' => 'Pertanyaan Umum (FAQ)',
                    'url' => '/#faq',
                    'content' => 'Jawaban atas pertanyaan yang sering diajukan mengenai produk dan layanan KYB.',
                    'keywords' => 'faq, tanya, jawab, pertanyaan, bantuan'
                ],
                [
                    'title' => 'Partner & Brand',
                    'url' => '/#partners',
                    'content' => 'Daftar brand otomotif yang mempercayai KYB sebagai mitra OEM & OES.',
                    'keywords' => 'partner, mitra, brand, merek, oem, oes'
                ]
            ];

            // Perform simple search
            foreach ($searchIndex as $item) {
                if (
                    stripos($item['title'], $query) !== false || 
                    stripos($item['content'], $query) !== false ||
                    stripos($item['keywords'], $query) !== false
                ) {
                    $results[] = $item;
                }
            }
        }

        return view('search', compact('results', 'query'));
    }
}

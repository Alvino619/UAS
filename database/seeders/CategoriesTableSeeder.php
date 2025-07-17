<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
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
                'name' => 'Programming',
                'slug' => 'programming',
                'description' => 'Belajar bahasa pemrograman dan framework terbaru',
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Kursus pengembangan website dari dasar hingga mahir',
            ],
            [
                'name' => 'Mobile Development',
                'slug' => 'mobile-development',
                'description' => 'Belajar membuat aplikasi mobile untuk Android dan iOS',
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
                'description' => 'Analisis data, machine learning, dan artificial intelligence',
            ],
            [
                'name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'description' => 'Desain antarmuka dan pengalaman pengguna yang menarik',
            ],
            [
                'name' => 'Cyber Security',
                'slug' => 'cyber-security',
                'description' => 'Keamanan sistem dan jaringan komputer',
            ],
            [
                'name' => 'Database',
                'slug' => 'database',
                'description' => 'Manajemen dan administrasi database',
            ],
            [
                'name' => 'Cloud Computing',
                'slug' => 'cloud-computing',
                'description' => 'Teknologi komputasi awan dan layanan cloud',
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'description' => 'Integrasi pengembangan dan operasi TI',
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Kursus bisnis dan kewirausahaan',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'categoryName' => 'Tutorial',
                'typeDescription' => 'Step-by-step guides and how-tos.'
            ],
            [
                'categoryName' => 'Opinion',
                'typeDescription' => 'Developer opinions and thought pieces.'
            ],
            [
                'categoryName' => 'News',
                'typeDescription' => 'Latest updates and announcements.'
            ]
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }
    }
}

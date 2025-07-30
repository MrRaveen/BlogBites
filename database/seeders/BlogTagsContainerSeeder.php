<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogTagsContainer;

class BlogTagsContainerSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            [
                'tagName' => 'Laravel',
                'tagDescription' => 'Posts related to Laravel framework.'
            ],
            [
                'tagName' => 'PHP',
                'tagDescription' => 'Posts related to core PHP development.'
            ],
            [
                'tagName' => 'Web Development',
                'tagDescription' => 'All things related to web development.'
            ]
        ];

        foreach ($tags as $tag) {
            BlogTagsContainer::create($tag);
        }
    }
}

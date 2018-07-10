<?php

namespace CodeEduBook\Faker;

use Faker\Provider\Base;

class ChapterFakerProvider extends Base
{
    public function markdown($numSubTitles = 1)
    {
        $title = $this->generator->sentence(3);
        $contents = [];
        foreach (range(1, $numSubTitles) as $value) {
            $contents[] = [
                'subtitle' => $this->generator->sentence(2),
                'content' => $this->generator->paragraph(10),
            ];
        }
        return view('codeedubook::faker.chapter', compact('title', 'contents'));
    }

}
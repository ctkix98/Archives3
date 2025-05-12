<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;

class StorySeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(database_path('data/story_data.json'));
        $data = json_decode($json, true);

        foreach ($data['stories'] as $entry) {
            // Crée l'histoire
            $story = Story::create([
                'title' => $entry['story']['title'],
                'description' => $entry['story']['description'] ?? '',
            ]);

            $chapterIdMap = [];

            // Crée les chapitres
            foreach ($entry['chapters'] as $chapterData) {
                $chapter = Chapter::create([
                    'story_id' => $story->id,
                    'title' => $chapterData['title'],
                    'text' => $chapterData['text'],
                ]);
                $chapterIdMap[$chapterData['id']] = $chapter->id;
            }

            // Crée les choix
            foreach ($entry['choices'] as $choiceData) {
                Choice::create([
                    'chapter_id' => $chapterIdMap[$choiceData['from']],
                    'text' => $choiceData['text'],
                    'target_chapter_id' => $chapterIdMap[$choiceData['target']],
                ]);
            }
        }
    }
}

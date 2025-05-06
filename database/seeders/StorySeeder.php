<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Chapter;
use App\Models\Choice;
use App\Models\Story;

class StorySeeder extends Seeder
{
    public function run(): void
    {
        // Lire le fichier JSON
        $json = File::get(database_path('data/story_data.json'));
        $data = json_decode($json, true);

        dump("Seeder lancé ✅");
        dump("Story title: " . $data['story']['title']);
        dump("Chapters count: " . count($data['chapters']));
        dump("Choices count: " . count($data['choices']));

        // Stoppe ici pour tester
        dd("Fin test");

        // Créer la story
        $story = Story::create([
            'title' => $data['story']['title'],
            'description' => $data['story']['description'] ?? '',
        ]);

        // Stock temporaire des IDs
        $chapterIdMap = [];

        foreach ($data['chapters'] as $chapterData) {
            $chapter = Chapter::create([
                'story_id' => $story->id,
                'title' => $chapterData['title'],
                'text' => $chapterData['text'],
            ]);

            $chapterIdMap[$chapterData['id']] = $chapter->id;
        }

        foreach ($data['choices'] as $choiceData) {
            Choice::create([
                'chapter_id' => $chapterIdMap[$choiceData['from']],
                'text' => $choiceData['text'],
                'target_chapter_id' => $chapterIdMap[$choiceData['target']],
            ]);
        }
    }
}

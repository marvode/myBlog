<?php

use App\Category;
use App\Post;
use App\Tags;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $author1 = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@email.com',
            'password' => Hash::make('password')
        ]);

        $author2 = User::create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@email.com',
            'password' => Hash::make('password')
        ]);

        $tag1 = Tags::create([
            'name' => 'record',
        ]);

        $tag2 = Tags::create([
            'name' => 'customer',
        ]);

        $tag3 = Tags::create([
            'name' => 'design',
        ]);

        $tag4 = Tags::create([
            'name' => 'version',
        ]);

        $category1 = Category::create([
            'name' => 'News',
        ]);

        $category2 = Category::create([
            'name' => 'Marketing',
        ]);

        $category3 = Category::create([
            'name' => 'Partnership',
        ]);

        $category4 = Category::create([
            'name' => 'Hiring',
        ]);

        $post1 = $author1->posts()->create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'They were dropping, losing altitude in a canyon of rainbow foliage, a lurid communal mural that completely covered the hull of the arcade showed him broken lengths of damp chipboard and the',
            'content' => 'The Tessier-Ashpool ice shattered, peeling away from the Chinese program’s thrust, a worrying impression of solid fluidity, as though the shards of a broken mirror bent and elongated as they rotated, but it never told the correct time. A narrow wedge of light from a half-open service hatch framed a heap of discarded fiber optics and the chassis of a broken mirror bent and elongated as they fell. It was disturbing to think of the Flatline as a gliding cursor struck sparks from the missionaries, the train reached Case’s station. She put his pistol down, picked up her fletcher, dialed the barrel over to single shot, and very carefully put a toxin dart through the center of a skyscraper canyon. Her cheekbones flaring scarlet as Wizard’s Castle burned, forehead drenched with azure when Munich fell to the Tank War, mouth touched with hot gold as a paid killer in the dark, curled in his devotion to esoteric forms of tailor-worship. Strata of cigarette smoke rose from the tiers, drifting until it struck currents set up by the blowers and the drifting shoals of waste. Its hands were holograms that altered to match the convolutions of the bright void beyond the chain link.',
            'category_id' => $category1->id,
            'image' => 'post/1.jpg',
        ]);

        $post2 = $author2->posts()->create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'They were dropping, losing altitude in a canyon of rainbow foliage, a lurid communal mural that completely covered the hull of the arcade showed him broken lengths of damp chipboard and the',
            'content' => 'The Tessier-Ashpool ice shattered, peeling away from the Chinese program’s thrust, a worrying impression of solid fluidity, as though the shards of a broken mirror bent and elongated as they rotated, but it never told the correct time. A narrow wedge of light from a half-open service hatch framed a heap of discarded fiber optics and the chassis of a broken mirror bent and elongated as they fell. It was disturbing to think of the Flatline as a gliding cursor struck sparks from the missionaries, the train reached Case’s station. She put his pistol down, picked up her fletcher, dialed the barrel over to single shot, and very carefully put a toxin dart through the center of a skyscraper canyon. Her cheekbones flaring scarlet as Wizard’s Castle burned, forehead drenched with azure when Munich fell to the Tank War, mouth touched with hot gold as a paid killer in the dark, curled in his devotion to esoteric forms of tailor-worship. Strata of cigarette smoke rose from the tiers, drifting until it struck currents set up by the blowers and the drifting shoals of waste. Its hands were holograms that altered to match the convolutions of the bright void beyond the chain link.',
            'category_id' => $category2->id,
            'image' => 'post/2.jpg',
        ]);

        $post3 = $author1->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'They were dropping, losing altitude in a canyon of rainbow foliage, a lurid communal mural that completely covered the hull of the arcade showed him broken lengths of damp chipboard and the',
            'content' => 'The Tessier-Ashpool ice shattered, peeling away from the Chinese program’s thrust, a worrying impression of solid fluidity, as though the shards of a broken mirror bent and elongated as they rotated, but it never told the correct time. A narrow wedge of light from a half-open service hatch framed a heap of discarded fiber optics and the chassis of a broken mirror bent and elongated as they fell. It was disturbing to think of the Flatline as a gliding cursor struck sparks from the missionaries, the train reached Case’s station. She put his pistol down, picked up her fletcher, dialed the barrel over to single shot, and very carefully put a toxin dart through the center of a skyscraper canyon. Her cheekbones flaring scarlet as Wizard’s Castle burned, forehead drenched with azure when Munich fell to the Tank War, mouth touched with hot gold as a paid killer in the dark, curled in his devotion to esoteric forms of tailor-worship. Strata of cigarette smoke rose from the tiers, drifting until it struck currents set up by the blowers and the drifting shoals of waste. Its hands were holograms that altered to match the convolutions of the bright void beyond the chain link.',
            'category_id' => $category3->id,
            'image' => 'post/3.jpg',
        ]);

        $post4 = $author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'They were dropping, losing altitude in a canyon of rainbow foliage, a lurid communal mural that completely covered the hull of the arcade showed him broken lengths of damp chipboard and the',
            'content' => 'The Tessier-Ashpool ice shattered, peeling away from the Chinese program’s thrust, a worrying impression of solid fluidity, as though the shards of a broken mirror bent and elongated as they rotated, but it never told the correct time. A narrow wedge of light from a half-open service hatch framed a heap of discarded fiber optics and the chassis of a broken mirror bent and elongated as they fell. It was disturbing to think of the Flatline as a gliding cursor struck sparks from the missionaries, the train reached Case’s station. She put his pistol down, picked up her fletcher, dialed the barrel over to single shot, and very carefully put a toxin dart through the center of a skyscraper canyon. Her cheekbones flaring scarlet as Wizard’s Castle burned, forehead drenched with azure when Munich fell to the Tank War, mouth touched with hot gold as a paid killer in the dark, curled in his devotion to esoteric forms of tailor-worship. Strata of cigarette smoke rose from the tiers, drifting until it struck currents set up by the blowers and the drifting shoals of waste. Its hands were holograms that altered to match the convolutions of the bright void beyond the chain link.',
            'category_id' => $category4->id,
            'image' => 'post/4.jpg',
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag4->id, $tag3->id]);
        $post3->tags()->attach([$tag4->id, $tag2->id]);
        $post4->tags()->attach([$tag2->id, $tag3->id]);
    }
}
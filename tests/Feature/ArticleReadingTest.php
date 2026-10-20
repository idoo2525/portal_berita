<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleReadingTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_article_can_be_read(): void
    {
        $article = Article::create([
            'title' => 'Kabar Penting Hari Ini',
            'slug' => 'kabar-penting-hari-ini',
            'category' => 'Nasional',
            'content' => 'Isi berita lengkap untuk pembaca.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/berita/'.$article->slug);

        $response->assertOk();
        $response->assertSee($article->title);
        $response->assertSee($article->content);
    }

    public function test_draft_article_is_not_publicly_accessible(): void
    {
        $article = Article::create([
            'title' => 'Berita Dalam Draft',
            'slug' => 'berita-dalam-draft',
            'category' => 'Nasional',
            'content' => 'Isi yang belum boleh dibaca publik.',
        ]);

        $response = $this->get('/berita/'.$article->slug);

        $response->assertNotFound();
    }
}

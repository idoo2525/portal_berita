<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsHomepageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_shows_published_news_and_hides_drafts(): void
    {
        Article::create([
            'title' => 'Nelayan Temukan Terumbu Baru',
            'slug' => 'nelayan-temukan-terumbu-baru',
            'category' => 'Nasional',
            'content' => 'Penemuan ini menjadi kabar baik.',
            'is_published' => true,
            'published_at' => now(),
        ]);
        Article::create([
            'title' => 'Catatan Redaksi Draft',
            'slug' => 'catatan-redaksi-draft',
            'category' => 'Nasional',
            'content' => 'Belum diterbitkan.',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Nelayan Temukan Terumbu Baru');
        $response->assertDontSee('Catatan Redaksi Draft');
    }

    public function test_search_filters_published_articles_by_title(): void
    {
        Article::create([
            'title' => 'Harga Pangan Mulai Stabil',
            'slug' => 'harga-pangan-stabil',
            'category' => 'Ekonomi',
            'content' => 'Harga bahan pokok mulai stabil.',
            'is_published' => true,
            'published_at' => now(),
        ]);
        Article::create([
            'title' => 'Tim Muda Juara Nasional',
            'slug' => 'tim-muda-juara',
            'category' => 'Olahraga',
            'content' => 'Kemenangan di partai final.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/?q=pangan');

        $response->assertOk();
        $response->assertSee('Harga Pangan Mulai Stabil');
        $response->assertDontSee('Tim Muda Juara Nasional');
    }

    public function test_category_filter_only_shows_matching_articles(): void
    {
        Article::create([
            'title' => 'Ruang Baca Baru untuk Warga',
            'slug' => 'ruang-baca-baru',
            'category' => 'Pendidikan',
            'content' => 'Perpustakaan lingkungan dibuka.',
            'is_published' => true,
            'published_at' => now(),
        ]);
        Article::create([
            'title' => 'Pasar Tradisional Direnovasi',
            'slug' => 'pasar-tradisional-renovasi',
            'category' => 'Ekonomi',
            'content' => 'Pasar mulai beroperasi kembali.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/?category=Pendidikan');

        $response->assertOk();
        $response->assertSee('Ruang Baca Baru untuk Warga');
        $response->assertDontSee('Pasar Tradisional Direnovasi');
    }
}

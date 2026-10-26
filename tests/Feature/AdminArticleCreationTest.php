<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminArticleCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_an_article_with_a_photo(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['is_admin' => true]);
        $photo = UploadedFile::fake()->image('berita.jpg');

        $response = $this->actingAs($admin)->post('/admin/berita', [
            'title' => 'Berita Baru Hari Ini',
            'category' => 'Nasional',
            'excerpt' => 'Ringkasan berita terbaru.',
            'content' => 'Isi lengkap berita terbaru.',
            'image' => $photo,
            'is_published' => '1',
        ]);

        $response->assertRedirect('/admin/berita');
        $this->assertDatabaseHas('articles', [
            'title' => 'Berita Baru Hari Ini',
            'category' => 'Nasional',
            'is_published' => true,
        ]);

        $article = Article::where('title', 'Berita Baru Hari Ini')->firstOrFail();
        $this->assertNotNull($article->image);
        Storage::disk('public')->assertExists($article->image);
    }

    public function test_admin_can_open_the_article_creation_form(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/admin/berita/tambah');

        $response->assertOk();
        $response->assertSee('name="title"', false);
        $response->assertSee('name="image"', false);
        $response->assertSee('enctype="multipart/form-data"', false);
        $response->assertSee('Navigasi admin', false);
        $response->assertSee('Tambah berita');
        $response->assertDontSee('Kembali ke daftar berita');
        $response->assertDontSee('Batal');
    }
}

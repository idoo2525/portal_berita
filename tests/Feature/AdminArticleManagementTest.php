<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminArticleManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_an_article(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $article = Article::create([
            'title' => 'Judul Sebelum Diedit',
            'slug' => 'judul-sebelum-diedit',
            'category' => 'Nasional',
            'content' => 'Isi awal artikel.',
        ]);

        $response = $this->actingAs($admin)->put(route('admin.articles.update', $article->id), [
            'title' => 'Judul Setelah Diedit',
            'category' => 'Teknologi',
            'excerpt' => 'Ringkasan baru.',
            'content' => 'Isi terbaru artikel.',
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'Judul Setelah Diedit',
            'category' => 'Teknologi',
            'content' => 'Isi terbaru artikel.',
            'is_published' => true,
        ]);
    }

    public function test_admin_can_delete_an_article_and_its_photo(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['is_admin' => true]);
        Storage::disk('public')->put('articles/berita.jpg', 'photo');
        $article = Article::create([
            'title' => 'Berita untuk Dihapus',
            'slug' => 'berita-untuk-dihapus',
            'category' => 'Nasional',
            'content' => 'Isi berita.',
            'image' => 'articles/berita.jpg',
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.articles.destroy', $article->id));

        $response->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
        Storage::disk('public')->assertMissing('articles/berita.jpg');
    }

    public function test_admin_article_list_has_edit_and_delete_actions(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $article = Article::create([
            'title' => 'Berita dengan Tombol Aksi',
            'slug' => 'berita-dengan-tombol-aksi',
            'category' => 'Nasional',
            'content' => 'Isi berita.',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.articles.index'));

        $response->assertOk();
        $response->assertSee(route('admin.articles.edit', $article->id), false);
        $response->assertSee(route('admin.articles.destroy', $article->id), false);
        $response->assertSee('Edit');
        $response->assertSee('Hapus');
    }

    public function test_edit_form_uses_sidebar_without_a_back_link(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $article = Article::create([
            'title' => 'Berita yang Diedit',
            'slug' => 'berita-yang-diedit',
            'category' => 'Nasional',
            'content' => 'Isi berita.',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.articles.edit', $article));

        $response->assertOk();
        $response->assertSee('Navigasi admin', false);
        $response->assertSee('name="title"', false);
        $response->assertDontSee('Kembali ke daftar berita');
    }
}

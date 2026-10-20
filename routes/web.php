
<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// HALAMAN DEPAN
Route::get('/', function () {
    $articles = Article::where('is_published', true)
        ->whereNotNull('published_at')
        ->latest('published_at')
        ->get();

    return view('welcome', compact('articles'));
});

Route::get('/admin/login', [AuthController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::post('/admin/login', [AuthController::class, 'store'])
    ->middleware(['guest', 'throttle:5,1'])
    ->name('login.store');
Route::post('/admin/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'can:access-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/berita', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/berita/tambah', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/berita', [ArticleController::class, 'store'])->name('articles.store');

        Route::get('/berita/{id}/edit', function ($id) {
            $article = Article::findOrFail($id);

            return view('admin.articles.edit', compact('article'));
        })->name('articles.edit');

        Route::put('/berita/{id}', function (Request $request, $id) {
            $article = Article::findOrFail($id);

            $data = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|string|max:100',
                'excerpt' => 'nullable|string|max:1000',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'is_published' => 'nullable|boolean',
            ]);

            if ($request->hasFile('image')) {
                if ($article->image) {
                    Storage::disk('public')->delete($article->image);
                }

                $data['image'] = $request->file('image')->store('articles', 'public');
            }

            $data['is_published'] = $request->boolean('is_published');
            $data['published_at'] = $data['is_published']
                ? ($article->published_at ?? now())
                : null;

            $article->update($data);

            return redirect()->route('admin.articles.index')
                ->with('success', 'Berita berhasil diperbarui!');
        })->name('articles.update');
    });

// DETAIL BERITA
Route::get('/berita/{slug}', function (string $slug) {
    $article = Article::where('slug', $slug)
        ->where('is_published', true)
        ->whereNotNull('published_at')
        ->firstOrFail();

    return view('admin.articles.show', compact('article'));
});

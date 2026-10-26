
<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// HALAMAN DEPAN
Route::get('/', function (Request $request) {
    $search = trim($request->query('q', ''));
    $category = trim($request->query('category', ''));

    $articles = Article::query()
        ->where('is_published', true)
        ->whereNotNull('published_at')
        ->when($search !== '', function (Builder $query) use ($search): void {
            $query->where(function (Builder $query) use ($search): void {
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('excerpt', 'like', '%'.$search.'%');
            });
        })
        ->when($category !== '', fn (Builder $query): Builder => $query->where('category', $category))
        ->latest('published_at')
        ->paginate(10)
        ->withQueryString();
    $featuredArticle = $articles->first();
    $supportingArticles = $articles->getCollection()->skip(1);

    $categories = Article::query()
        ->where('is_published', true)
        ->whereNotNull('published_at')
        ->distinct()
        ->orderBy('category')
        ->pluck('category');

    return view('welcome', compact(
        'articles',
        'categories',
        'search',
        'category',
        'featuredArticle',
        'supportingArticles',
    ));
})->name('home');

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
        Route::get('/berita/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/berita/{article}', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('/berita/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    });

// DETAIL BERITA
Route::get('/berita/{slug}', function (string $slug) {
    $article = Article::where('slug', $slug)
        ->where('is_published', true)
        ->whereNotNull('published_at')
        ->firstOrFail();

    return view('admin.articles.show', compact('article'));
});

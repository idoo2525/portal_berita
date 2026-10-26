<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kabar terkini, cerita pilihan, dan informasi yang mudah dipahami setiap hari.">
    <title>KabarKita — Berita yang dekat denganmu</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/kabarkita-mark.svg') }}?v=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { color-scheme: light; --ink: #17211e; --muted: #64716b; --paper: #f6f7f3; --green: #176b52; --lime: #d9f279; --line: #e3e8e1; }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { margin: 0; background: var(--paper); color: var(--ink); font-family: 'DM Sans', sans-serif; }
        h1, h2, h3, .brand { font-family: 'Manrope', sans-serif; }
        .masthead { background: radial-gradient(ellipse at 88% 12%, rgba(217,242,121,.18), transparent 28%), #10251f; }
        .ticker { background-image: repeating-linear-gradient(135deg, rgba(23,107,82,.04) 0 1px, transparent 1px 8px); }
        .article-image { transition: transform .55s cubic-bezier(.2,.7,.2,1); }
        .article-link:hover .article-image { transform: scale(1.035); }
        .fade-up { animation: fade-up .55s ease-out both; }
        @keyframes fade-up { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { scroll-behavior: auto !important; animation-duration: .01ms !important; transition-duration: .01ms !important; } }
    </style>
</head>

<body>
    <header class="masthead text-white">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="flex min-h-[76px] items-center justify-between gap-5 border-b border-white/15">
                @include('partials.brand', ['variant' => 'light', 'size' => 'medium'])
                <p class="hidden text-sm text-white/65 md:block">Berita yang dekat dengan hidupmu.</p>
                <a href="@can('access-admin'){{ route('admin.articles.index') }}@else{{ route('login') }}@endcan"
                   class="inline-flex min-h-10 items-center gap-2 rounded-md border border-white/25 px-4 text-sm font-semibold transition hover:border-[#d9f279] hover:text-[#d9f279]">
                    <svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3 4.5 6v5.4c0 4.6 3.2 7.8 7.5 9.6 4.3-1.8 7.5-5 7.5-9.6V6L12 3Z"/><path d="m9 12 2 2 4-4"/></svg>
                    Admin
                </a>
            </div>
            <div class="flex min-h-11 items-center justify-between gap-4 text-[11px] font-semibold uppercase tracking-[.14em] text-white/65">
                <span>Indonesia <span class="px-2 text-[#d9f279]">/</span> Kabar hari ini</span>
                <span>{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </header>

    <div class="ticker border-b border-[#e3e8e1] bg-[#edf2e9]">
        <div class="mx-auto flex max-w-7xl items-center gap-3 overflow-x-auto px-5 py-3 text-sm sm:px-8">
            <span class="shrink-0 rounded-sm bg-[#176b52] px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white">Pilihan redaksi</span>
            <p class="min-w-0 truncate text-[#43514a]">Informasi penting hari ini, dirangkum ringkas dan jelas untuk kamu.</p>
            <span class="ml-auto hidden shrink-0 text-xs text-[#64716b] sm:block">Baca. Pahami. Bagikan.</span>
        </div>
    </div>

    <main class="mx-auto max-w-7xl px-5 pb-16 pt-9 sm:px-8 sm:pt-12">
        <div class="mb-7 flex flex-col gap-5 border-b border-[#dbe2d9] pb-6 md:flex-row md:items-end md:justify-between">
            <div class="fade-up">
                <p class="text-xs font-bold uppercase tracking-[.18em] text-[#176b52]">Jernih membaca hari ini</p>
                <h1 class="mt-2 text-3xl font-extrabold leading-tight sm:text-4xl">Cerita terbaru, <span class="text-[#176b52]">lebih dekat.</span></h1>
                <p class="mt-2 max-w-xl text-sm leading-6 text-[#64716b]">Kabar pilihan dari berbagai sudut, disajikan singkat supaya mudah dipahami.</p>
            </div>
            <form action="{{ route('home') }}" method="GET" role="search" class="flex w-full max-w-md items-center rounded-md border border-[#d5ddd3] bg-white p-1.5 focus-within:border-[#176b52] focus-within:ring-2 focus-within:ring-[#176b52]/10">
                @if ($category !== '')
                    <input type="hidden" name="category" value="{{ $category }}">
                @endif
                <label for="news-search" class="sr-only">Cari berita</label>
                <svg aria-hidden="true" viewBox="0 0 24 24" class="ml-2 h-5 w-5 shrink-0 text-[#64716b]" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 4.5 4.5"/></svg>
                <input id="news-search" name="q" value="{{ $search }}" type="search" placeholder="Cari berita atau topik..." class="min-w-0 flex-1 border-0 bg-transparent px-3 py-2 text-sm outline-none placeholder:text-[#8b9690]">
                <button type="submit" aria-label="Cari" class="grid h-9 w-9 shrink-0 place-items-center rounded bg-[#176b52] text-white transition hover:bg-[#105640]">
                    <svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </button>
            </form>
        </div>

        <nav aria-label="Filter kategori berita" class="mb-9 flex gap-2 overflow-x-auto pb-2">
            <a href="{{ route('home', array_filter(['q' => $search])) }}" class="shrink-0 rounded-sm border px-4 py-2 text-sm font-semibold transition {{ $category === '' ? 'border-[#176b52] bg-[#176b52] text-white' : 'border-[#d5ddd3] bg-white text-[#43514a] hover:border-[#176b52] hover:text-[#176b52]' }}">Semua berita</a>
            @foreach ($categories as $categoryOption)
                <a href="{{ route('home', array_filter(['q' => $search, 'category' => $categoryOption])) }}" class="shrink-0 rounded-sm border px-4 py-2 text-sm font-semibold transition {{ $category === $categoryOption ? 'border-[#176b52] bg-[#176b52] text-white' : 'border-[#d5ddd3] bg-white text-[#43514a] hover:border-[#176b52] hover:text-[#176b52]' }}">{{ $categoryOption }}</a>
            @endforeach
        </nav>

        @if ($articles->isEmpty())
            <section class="border-y border-[#dbe2d9] py-20 text-center">
                <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-[#e5ecdf] text-[#176b52]">
                    <svg aria-hidden="true" viewBox="0 0 24 24" class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 5.5h16v13H4zM8 9h8m-8 4h5"/></svg>
                </div>
                <h2 class="mt-5 text-xl font-extrabold">{{ $search || $category ? 'Berita belum ditemukan' : 'Berita baru segera hadir' }}</h2>
                <p class="mt-2 text-sm text-[#64716b]">{{ $search || $category ? 'Coba kata kunci atau kategori lain.' : 'Kabar terbaru akan muncul di sini setelah diterbitkan.' }}</p>
                @if ($search || $category)
                    <a href="{{ route('home') }}" class="mt-5 inline-flex rounded-sm bg-[#176b52] px-4 py-2.5 text-sm font-bold text-white hover:bg-[#105640]">Lihat semua berita</a>
                @endif
            </section>
        @else
            @if ($featuredArticle)
                <section aria-labelledby="featured-heading" class="grid gap-7 border-b border-[#dbe2d9] pb-10 lg:grid-cols-[1.55fr_0.85fr] lg:gap-10">
                    <a href="{{ url('/berita/'.$featuredArticle->slug) }}" class="article-link group block min-w-0">
                        <div class="relative aspect-[16/9] overflow-hidden bg-[#dfe7dc]">
                            @if ($featuredArticle->image)
                                <img src="{{ asset('storage/'.$featuredArticle->image) }}" alt="{{ $featuredArticle->title }}" fetchpriority="high" class="article-image h-full w-full object-cover">
                            @else
                                <div class="grid h-full w-full place-items-center bg-[linear-gradient(135deg,#dce8dd,#b9d2c3)] text-[#176b52]">
                                    <svg aria-hidden="true" viewBox="0 0 24 24" class="h-16 w-16" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="4" width="18" height="16" rx="1"/><circle cx="8.5" cy="9" r="1.5"/><path d="m4 18 5-5 3 3 3-4 5 6"/></svg>
                                </div>
                            @endif
                            <span class="absolute left-4 top-4 bg-[#d9f279] px-3 py-1.5 text-[10px] font-extrabold uppercase tracking-wider text-[#17211e]">Berita utama</span>
                        </div>
                        <div class="pt-5">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs font-semibold text-[#176b52]">
                                <span class="uppercase tracking-wider">{{ $featuredArticle->category }}</span>
                                <span class="h-1 w-1 rounded-full bg-[#aab5ac]"></span>
                                <time datetime="{{ $featuredArticle->published_at?->toDateString() }}" class="text-[#64716b]">{{ $featuredArticle->published_at?->locale('id')->translatedFormat('d F Y') }}</time>
                            </div>
                            <h2 id="featured-heading" class="mt-3 max-w-3xl text-2xl font-extrabold leading-tight transition group-hover:text-[#176b52] sm:text-3xl lg:text-[40px]">{{ $featuredArticle->title }}</h2>
                            <p class="mt-3 max-w-2xl text-sm leading-7 text-[#64716b] sm:text-base">{{ $featuredArticle->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($featuredArticle->content), 190) }}</p>
                            <span class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-[#176b52]">Baca cerita <span aria-hidden="true">&rarr;</span></span>
                        </div>
                    </a>

                    <aside class="min-w-0 lg:border-l lg:border-[#dbe2d9] lg:pl-8" aria-label="Berita pilihan lainnya">
                        <div class="mb-4 flex items-center justify-between border-b border-[#dbe2d9] pb-3">
                            <h2 class="text-sm font-extrabold uppercase tracking-[.12em]">Pilihan hari ini</h2>
                            <span class="text-xs text-[#64716b]">{{ $supportingArticles->count() }} berita</span>
                        </div>
                        @forelse ($supportingArticles->take(4) as $article)
                            <article class="border-b border-[#dbe2d9] py-4 first:pt-1 last:border-0">
                                <a href="{{ url('/berita/'.$article->slug) }}" class="article-link group flex gap-4">
                                    <div class="h-[88px] w-[112px] shrink-0 overflow-hidden bg-[#dfe7dc] sm:h-[96px] sm:w-[128px]">
                                        @if ($article->image)
                                            <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}" loading="lazy" class="article-image h-full w-full object-cover">
                                        @else
                                            <div class="grid h-full place-items-center bg-[#e3ece1] text-[#176b52]"><span class="text-2xl font-extrabold">K.</span></div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 py-0.5">
                                        <p class="text-[10px] font-bold uppercase tracking-[.12em] text-[#176b52]">{{ $article->category }}</p>
                                        <h3 class="mt-1 line-clamp-3 text-sm font-bold leading-5 transition group-hover:text-[#176b52]">{{ $article->title }}</h3>
                                        <time datetime="{{ $article->published_at?->toDateString() }}" class="mt-2 block text-[11px] text-[#7a8780]">{{ $article->published_at?->locale('id')->translatedFormat('d M Y') }}</time>
                                    </div>
                                </a>
                            </article>
                        @empty
                            <p class="py-6 text-sm leading-6 text-[#64716b]">Berita lainnya akan menyusul. Pantau terus kabar terbaru di sini.</p>
                        @endforelse
                    </aside>
                </section>
            @endif

            @if ($supportingArticles->count() > 4)
                <section aria-labelledby="latest-heading" class="pt-9">
                    <div class="mb-5 flex items-end justify-between gap-4 border-b border-[#dbe2d9] pb-4">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[.16em] text-[#176b52]">Jangan sampai ketinggalan</p>
                            <h2 id="latest-heading" class="mt-1 text-2xl font-extrabold">Berita lainnya</h2>
                        </div>
                        <span class="text-xs text-[#64716b]">{{ $articles->total() }} artikel</span>
                    </div>
                    <div class="grid gap-x-7 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($supportingArticles->skip(4) as $article)
                            <article class="border-b border-[#dbe2d9] py-5">
                                <a href="{{ url('/berita/'.$article->slug) }}" class="article-link group flex gap-4">
                                    <div class="h-24 w-28 shrink-0 overflow-hidden bg-[#dfe7dc]">
                                        @if ($article->image)
                                            <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}" loading="lazy" class="article-image h-full w-full object-cover">
                                        @else
                                            <div class="grid h-full place-items-center bg-[#e3ece1] text-[#176b52]"><span class="text-2xl font-extrabold">K.</span></div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-[#176b52]">{{ $article->category }}</p>
                                        <h3 class="mt-1 line-clamp-3 text-sm font-bold leading-5 group-hover:text-[#176b52]">{{ $article->title }}</h3>
                                        <time datetime="{{ $article->published_at?->toDateString() }}" class="mt-2 block text-[11px] text-[#7a8780]">{{ $article->published_at?->locale('id')->translatedFormat('d M Y') }}</time>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            @if ($articles->hasPages())
                <nav aria-label="Navigasi halaman berita" class="mt-8 border-t border-[#dbe2d9] pt-5">
                    {{ $articles->links() }}
                </nav>
            @endif
        @endif
    </main>

    <footer class="border-t border-[#dbe2d9] bg-[#edf2e9]">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-5 py-7 text-sm text-[#64716b] sm:flex-row sm:items-center sm:justify-between sm:px-8">
            @include('partials.brand', ['variant' => 'dark', 'size' => 'small'])
            <p>Kabar yang jernih, untuk semua.</p>
            <p>&copy; {{ date('Y') }} KabarKita</p>
        </div>
    </footer>
</body>

</html>

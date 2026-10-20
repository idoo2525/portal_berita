<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Berita — Informasi Terkini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800">

    <header class="bg-slate-950 text-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
            <a href="/" class="text-2xl font-black">
                Portal<span class="text-blue-400">Berita.</span>
            </a>
            <a href="@can('access-admin'){{ route('admin.articles.index') }}@else{{ route('login') }}@endcan" class="rounded-lg border border-slate-600 px-4 py-2 text-sm hover:bg-slate-800">
                Admin
            </a>
        </div>
    </header>

    <section class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white">
        <div class="mx-auto max-w-7xl px-6 py-16 md:py-24">
            <p class="font-semibold uppercase tracking-[0.2em] text-blue-200">
                Informasi terpercaya
            </p>
            <h1 class="mt-4 max-w-3xl text-4xl font-black leading-tight md:text-6xl">
                Berita terkini, wawasan setiap hari.
            </h1>
            <p class="mt-5 max-w-xl text-lg text-blue-100">
                Ikuti kabar terbaru dan temukan informasi yang penting untukmu.
            </p>
        </div>
    </section>

    <main class="mx-auto max-w-7xl px-6 py-12">
        <div class="mb-8 flex items-end justify-between">
            <div>
                <p class="font-semibold text-blue-600">JANGAN LEWATKAN</p>
                <h2 class="mt-2 text-3xl font-extrabold">Berita Terbaru</h2>
            </div>
            <span class="text-sm text-slate-500">
                {{ $articles->count() }} artikel
            </span>
        </div>

        @if ($articles->isEmpty())
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
            <div class="text-5xl">📰</div>
            <h3 class="mt-4 text-xl font-bold">Belum ada berita terbit</h3>
            <p class="mt-2 text-slate-500">
                Artikel yang sudah diterbitkan akan tampil di sini.
            </p>
        </div>
        @else
        <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($articles as $article)
            <article
                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                @if ($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                    class="h-52 w-full object-cover">
                @else
                <div class="flex h-52 items-center justify-center bg-slate-200 text-5xl">
                    📰
                </div>
                @endif

                <div class="p-6">
                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">
                        {{ $article->category }}
                    </span>

                    <h3 class="mt-4 text-xl font-extrabold leading-snug">
                        <a href="{{ url('/berita/' . $article->slug) }}" class="hover:text-blue-600">
                            {{ $article->title }}
                        </a>
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        {{ $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 130) }}
                    </p>

                    <p class="mt-5 text-xs text-slate-400">
                        {{ $article->published_at?->format('d M Y') }}
                    </p>
                </div>
            </article>
            @endforeach
        </div>
        @endif
    </main>

    <footer class="mt-12 bg-slate-950 px-6 py-8 text-center text-sm text-slate-400">
        © {{ date('Y') }} PortalBerita. Semua hak cipta dilindungi.
    </footer>

</body>

</html>

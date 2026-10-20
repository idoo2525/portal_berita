
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} | PortalBerita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800">

    <header class="bg-slate-950 text-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-5">
            <a href="/" class="text-2xl font-black">
                Portal<span class="text-blue-400">Berita.</span>
            </a>
            <a href="/" class="text-sm text-slate-300 hover:text-white">
                ← Kembali ke Beranda
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-4xl px-5 py-10 md:py-16">

        <span class="rounded-full bg-blue-100 px-4 py-2 text-sm font-bold text-blue-700">
            {{ $article->category }}
        </span>

        <h1 class="mt-6 text-3xl font-black leading-tight md:text-5xl">
            {{ $article->title }}
        </h1>

        <p class="mt-5 text-sm text-slate-500">
            Dipublikasikan pada
            {{ $article->published_at?->format('d F Y, H:i') }}
        </p>

        @if ($article->image)
            <img
                src="{{ asset('storage/' . $article->image) }}"
                alt="{{ $article->title }}"
                class="mt-8 max-h-[500px] w-full rounded-2xl object-cover shadow-sm"
            >
        @endif

        @if ($article->excerpt)
            <p class="mt-8 border-l-4 border-blue-600 pl-5 text-lg font-medium leading-8 text-slate-600">
                {{ $article->excerpt }}
            </p>
        @endif

        <article class="mt-8 whitespace-pre-line text-base leading-8 text-slate-700 md:text-lg">
            {{ $article->content }}
        </article>

        <div class="mt-12 border-t border-slate-200 pt-6">
            <a href="/" class="font-bold text-blue-600 hover:text-blue-800">
                ← Baca berita lainnya
            </a>
        </div>

    </main>

    <footer class="bg-slate-950 px-6 py-8 text-center text-sm text-slate-400">
        © {{ date('Y') }} PortalBerita
    </footer>

</body>
</html>

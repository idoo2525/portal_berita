
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita | KabarKita</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/kabarkita-mark.svg') }}?v=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f4f6f1] text-[#17211e]">

    <div class="min-h-screen md:flex">

        @include('admin.partials.sidebar')

        <!-- Konten utama -->
        <main class="min-w-0 flex-1 p-5 md:p-10">

            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-[#176b52]">
                        Ruang Redaksi
                    </p>
                    <h2 class="mt-2 text-3xl font-extrabold">
                        Kelola Berita
                    </h2>
                    <p class="mt-2 text-slate-500">
                        Buat, pantau, dan kelola artikel portal berita kamu.
                    </p>
                </div>

                <a href="{{ route('admin.articles.create') }}"
                   class="inline-flex min-h-11 items-center justify-center gap-2 rounded-md bg-[#176b52] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#105640]">
                    <span aria-hidden="true" class="text-lg leading-none">+</span> Tambah berita
                </a>
            </div>

            <!-- Notifikasi -->
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                    <p class="font-bold">Terjadi kesalahan:</p>
                    <ul class="mt-2 list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Statistik -->
            <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-lg border border-[#e0e6dd] bg-white p-6 shadow-sm">
                    <p class="text-sm text-slate-500">Total Artikel</p>
                    <p class="mt-2 text-3xl font-extrabold">
                        {{ $articles->count() }}
                    </p>
                </div>

                <div class="rounded-lg border border-[#e0e6dd] bg-white p-6 shadow-sm">
                    <p class="text-sm text-slate-500">Sudah Terbit</p>
                    <p class="mt-2 text-3xl font-extrabold text-green-600">
                        {{ $articles->where('is_published', true)->count() }}
                    </p>
                </div>

                <div class="rounded-lg border border-[#e0e6dd] bg-white p-6 shadow-sm">
                    <p class="text-sm text-slate-500">Draft</p>
                    <p class="mt-2 text-3xl font-extrabold text-amber-600">
                        {{ $articles->where('is_published', false)->count() }}
                    </p>
                </div>
            </div>

            <!-- Tabel berita -->
            <div class="overflow-hidden rounded-lg border border-[#e0e6dd] bg-white shadow-sm">

                <div class="flex flex-col justify-between gap-3 border-b border-slate-100 p-6 sm:flex-row sm:items-center">
                    <div>
                        <h3 class="text-lg font-bold">Daftar Artikel</h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Semua artikel yang tersimpan di database.
                        </p>
                    </div>
                    <span class="text-sm text-slate-500">
                        {{ $articles->count() }} artikel
                    </span>
                </div>

                @if ($articles->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <div class="text-5xl">📰</div>
                        <h4 class="mt-4 text-lg font-bold">Belum ada berita</h4>
                        <p class="mt-2 text-slate-500">
                            Yuk, buat artikel pertamamu!
                        </p>
                        <a href="/admin/berita/tambah"
                           class="mt-5 inline-block rounded-xl bg-[#176b52] px-5 py-3 font-semibold text-white hover:bg-[#105640]">
                            + Buat Berita
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-[#f4f6f1] text-xs uppercase tracking-wider text-slate-500">
                                <tr>
                                    <th class="px-6 py-4">Artikel</th>
                                    <th class="px-6 py-4">Kategori</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Tanggal</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @foreach ($articles as $article)
                                    <tr class="transition hover:bg-slate-50">
                                        <td class="px-6 py-4">
                                            <div class="flex min-w-64 items-center gap-4">
                                                @if ($article->image)
                                                    <img
                                                        src="{{ asset('storage/' . $article->image) }}"
                                                        alt="{{ $article->title }}"
                                                        class="h-16 w-20 rounded-lg object-cover"
                                                    >
                                                @else
                                                    <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-2xl">
                                                        📰
                                                    </div>
                                                @endif

                                                <div class="min-w-0">
                                                    <p class="font-bold text-slate-800">
                                                        {{ $article->title }}
                                                    </p>

                                                    <p class="mt-1 max-w-xs truncate text-slate-500">
                                                        {{ $article->excerpt ?: 'Belum ada ringkasan.' }}
                                                    </p>

                                                    <p class="mt-1 text-xs text-slate-400">
                                                        /{{ $article->slug }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4">
                                            <span class="rounded-full bg-[#eaf1e8] px-3 py-1 text-xs font-semibold text-[#176b52]">
                                                {{ $article->category }}
                                            </span>
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4">
                                            @if ($article->is_published)
                                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                    ● Terbit
                                                </span>
                                            @else
                                                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                                    ● Draft
                                                </span>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4 text-slate-500">
                                            {{ $article->created_at?->format('d M Y') ?? '-' }}
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.articles.edit', $article) }}"
                                                   class="inline-flex min-h-9 items-center gap-2 rounded-md border border-[#c9d9cf] px-3 text-sm font-semibold text-[#176b52] transition hover:bg-[#eaf1e8]">
                                                    <svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m14 5 5 5M4 20l4.2-.8L19 8.4a2.1 2.1 0 0 0-3-3L5.2 16.2 4 20Z"/></svg>
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                                                      onsubmit="return confirm('Hapus berita ini? Foto berita juga akan dihapus.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex min-h-9 items-center gap-2 rounded-md border border-red-200 px-3 text-sm font-semibold text-red-700 transition hover:bg-red-50">
                                                        <svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 7h16m-10 4v6m4-6v6M6 7l1 13h10l1-13M9 7V4h6v3"/></svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <p class="mt-6 text-center text-xs text-slate-400">
                Portal Berita · Panel Administrator
            </p>

        </main>
    </div>

</body>
</html>

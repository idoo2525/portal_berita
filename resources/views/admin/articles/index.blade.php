
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita | Portal Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800">

    <div class="min-h-screen md:flex">

        <!-- Sidebar -->
        <aside class="w-full bg-slate-900 p-6 text-white md:min-h-screen md:w-64">
            <h1 class="text-2xl font-extrabold">
                Portal<span class="text-blue-400">Berita.</span>
            </h1>

            <p class="mt-2 text-sm text-slate-400">Panel Administrator</p>

            <nav class="mt-8 space-y-2">
                <a href="/admin/berita"
                   class="block rounded-xl bg-blue-600 px-4 py-3 font-semibold">
                    📰 Kelola Berita
                </a>

                <a href="/admin/berita/tambah"
                   class="block rounded-xl px-4 py-3 text-slate-300 hover:bg-slate-800">
                    ✍️ Tambah Berita
                </a>

                <a href="/"
                   class="block rounded-xl px-4 py-3 text-slate-300 hover:bg-slate-800">
                    🌐 Lihat Website
                </a>
            </nav>
        </aside>

        <!-- Konten utama -->
        <main class="min-w-0 flex-1 p-5 md:p-10">

            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">
                        Dashboard
                    </p>
                    <h2 class="mt-2 text-3xl font-extrabold">
                        Kelola Berita
                    </h2>
                    <p class="mt-2 text-slate-500">
                        Buat, pantau, dan kelola artikel portal berita kamu.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="/admin/berita/tambah"
                       class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700">
                        + Tambah Berita
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold hover:bg-slate-50">
                            Keluar
                        </button>
                    </form>
                </div>
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
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm text-slate-500">Total Artikel</p>
                    <p class="mt-2 text-3xl font-extrabold">
                        {{ $articles->count() }}
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm text-slate-500">Sudah Terbit</p>
                    <p class="mt-2 text-3xl font-extrabold text-green-600">
                        {{ $articles->where('is_published', true)->count() }}
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm text-slate-500">Draft</p>
                    <p class="mt-2 text-3xl font-extrabold text-amber-600">
                        {{ $articles->where('is_published', false)->count() }}
                    </p>
                </div>
            </div>

            <!-- Tabel berita -->
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

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
                           class="mt-5 inline-block rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700">
                            + Buat Berita
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                                <tr>
                                    <th class="px-6 py-4">Artikel</th>
                                    <th class="px-6 py-4">Kategori</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Tanggal</th>
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
                                            <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
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

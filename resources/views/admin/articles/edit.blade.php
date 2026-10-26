
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita | KabarKita</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/kabarkita-mark.svg') }}?v=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#f4f6f1] text-[#17211e]">
    <div class="min-h-screen md:flex">
        @include('admin.partials.sidebar')
        <main class="min-w-0 flex-1 px-5 py-7 sm:px-8 md:px-10 md:py-10">
        <div class="mx-auto max-w-3xl rounded-xl border border-[#e0e6dd] bg-white p-6 shadow-sm md:p-10">
        <p class="mt-7 text-sm font-bold uppercase tracking-widest text-[#176b52]">Manajemen Konten</p>
        <h1 class="mt-2 text-3xl font-black">Edit berita</h1>
        <p class="mt-2 text-slate-500">Perbarui informasi artikel kamu.</p>

        @if ($errors->any())
            <div class="mt-5 rounded-xl bg-red-50 p-4 text-red-700">
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.articles.update', $article) }}"
              method="POST"
              enctype="multipart/form-data"
              class="mt-8 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="mb-2 block font-semibold">Judul Berita</label>
                <input type="text" name="title" required maxlength="255"
                       value="{{ old('title', $article->title) }}"
                       class="w-full rounded-xl border border-slate-300 p-3 focus:border-[#176b52] focus:outline-none">
            </div>

            <div>
                <label class="mb-2 block font-semibold">Kategori</label>
                <select name="category" required
                    class="w-full rounded-xl border border-slate-300 p-3 focus:border-[#176b52]">
                    @foreach (['Nasional', 'Internasional', 'Teknologi', 'Olahraga', 'Ekonomi', 'Hiburan', 'Pendidikan'] as $category)
                        <option value="{{ $category }}"
                            @selected(old('category', $article->category) === $category)>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block font-semibold">Ringkasan</label>
                <textarea name="excerpt" rows="3" maxlength="1000"
                          class="w-full rounded-xl border border-slate-300 p-3 focus:border-[#176b52]">{{ old('excerpt', $article->excerpt) }}</textarea>
            </div>

            <div>
                <label class="mb-2 block font-semibold">Isi Berita</label>
                <textarea name="content" rows="10" required
                          class="w-full rounded-xl border border-slate-300 p-3 focus:border-[#176b52]">{{ old('content', $article->content) }}</textarea>
            </div>

            <div>
                <label class="mb-2 block font-semibold">Foto Berita</label>

                @if ($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}"
                         alt="Foto berita saat ini"
                         class="mb-4 h-48 w-full rounded-xl object-cover">
                @endif

                <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
                       class="w-full rounded-xl border border-slate-300 p-3 file:mr-4 file:rounded-md file:border-0 file:bg-[#eaf1e8] file:px-4 file:py-2 file:font-semibold file:text-[#176b52]">
                <p class="mt-2 text-sm text-slate-500">
                    Kosongkan jika tidak ingin mengganti foto. Maksimal 2 MB.
                </p>
            </div>

            <label class="flex items-center gap-3 rounded-xl bg-slate-50 p-4">
                <input type="checkbox" name="is_published" value="1"
                       @checked(old('is_published', $article->is_published))
                       class="h-5 w-5 text-[#176b52]">
                <span class="font-semibold">Terbitkan berita</span>
            </label>

            <button type="submit"
                    class="w-full rounded-xl bg-[#176b52] px-5 py-3 font-bold text-white hover:bg-[#105640]">
                Simpan Perubahan
            </button>
        </form>
        </div>
    </main>
    </div>
</body>
</html>

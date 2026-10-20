
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita | PortalBerita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 p-5 md:p-10">

    <main class="mx-auto max-w-3xl rounded-2xl bg-white p-6 shadow-sm md:p-10">
        <a href="/admin/berita" class="text-sm font-semibold text-blue-600">
            ← Kembali ke daftar berita
        </a>

        <h1 class="mt-5 text-3xl font-black">Edit Berita</h1>
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

        <form action="{{ url('/admin/berita/' . $article->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="mt-8 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="mb-2 block font-semibold">Judul Berita</label>
                <input type="text" name="title" required maxlength="255"
                       value="{{ old('title', $article->title) }}"
                       class="w-full rounded-xl border border-slate-300 p-3 focus:border-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="mb-2 block font-semibold">Kategori</label>
                <select name="category" required
                        class="w-full rounded-xl border border-slate-300 p-3">
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
                          class="w-full rounded-xl border border-slate-300 p-3">{{ old('excerpt', $article->excerpt) }}</textarea>
            </div>

            <div>
                <label class="mb-2 block font-semibold">Isi Berita</label>
                <textarea name="content" rows="10" required
                          class="w-full rounded-xl border border-slate-300 p-3">{{ old('content', $article->content) }}</textarea>
            </div>

            <div>
                <label class="mb-2 block font-semibold">Foto Berita</label>

                @if ($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}"
                         alt="Foto berita saat ini"
                         class="mb-4 h-48 w-full rounded-xl object-cover">
                @endif

                <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
                       class="w-full rounded-xl border border-slate-300 p-3">
                <p class="mt-2 text-sm text-slate-500">
                    Kosongkan jika tidak ingin mengganti foto. Maksimal 2 MB.
                </p>
            </div>

            <label class="flex items-center gap-3 rounded-xl bg-slate-50 p-4">
                <input type="checkbox" name="is_published" value="1"
                       @checked(old('is_published', $article->is_published))
                       class="h-5 w-5">
                <span class="font-semibold">Terbitkan berita</span>
            </label>

            <button type="submit"
                    class="w-full rounded-xl bg-blue-600 px-5 py-3 font-bold text-white hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </form>
    </main>

</body>
</html>

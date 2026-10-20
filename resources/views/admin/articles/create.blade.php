<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis Berita | Portal Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 p-5 text-slate-800 md:p-10">
    <main class="mx-auto max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:p-10">
        <a href="{{ route('admin.articles.index') }}" class="text-sm font-semibold text-blue-700">&larr; Kembali ke daftar berita</a>
        <p class="mt-7 text-sm font-bold uppercase tracking-widest text-blue-700">Manajemen Konten</p>
        <h1 class="mt-2 text-3xl font-black">Tulis berita baru</h1>
        <p class="mt-2 text-slate-500">Lengkapi informasi dan pilih foto untuk artikel.</p>

        @if ($errors->any())
            <div role="alert" class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
            @csrf
            <div>
                <label for="title" class="mb-2 block font-semibold">Judul berita</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" maxlength="255" required
                    class="w-full rounded-lg border border-slate-300 p-3 focus:border-blue-600 focus:outline-none">
            </div>

            <div>
                <label for="category" class="mb-2 block font-semibold">Kategori</label>
                <select id="category" name="category" required class="w-full rounded-lg border border-slate-300 p-3">
                    @foreach (['Nasional', 'Internasional', 'Teknologi', 'Olahraga', 'Ekonomi', 'Hiburan', 'Pendidikan'] as $category)
                        <option value="{{ $category }}" @selected(old('category', 'Nasional') === $category)>{{ $category }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="excerpt" class="mb-2 block font-semibold">Ringkasan</label>
                <textarea id="excerpt" name="excerpt" rows="3" maxlength="1000"
                    class="w-full rounded-lg border border-slate-300 p-3 focus:border-blue-600 focus:outline-none">{{ old('excerpt') }}</textarea>
            </div>

            <div>
                <label for="content" class="mb-2 block font-semibold">Isi berita</label>
                <textarea id="content" name="content" rows="12" required
                    class="w-full rounded-lg border border-slate-300 p-3 focus:border-blue-600 focus:outline-none">{{ old('content') }}</textarea>
            </div>

            <div>
                <label for="image" class="mb-2 block font-semibold">Foto berita</label>
                <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/webp"
                    class="w-full rounded-lg border border-slate-300 p-3 file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:font-semibold file:text-blue-700">
                <p class="mt-2 text-sm text-slate-500">Format JPG, PNG, atau WebP. Maksimal 2 MB.</p>
            </div>

            <label class="flex items-center gap-3 rounded-lg bg-slate-50 p-4">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published')) class="h-5 w-5 rounded border-slate-300 text-blue-600">
                <span class="font-semibold">Terbitkan berita setelah disimpan</span>
            </label>

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.articles.index') }}" class="rounded-lg border border-slate-300 px-5 py-3 text-center font-semibold hover:bg-slate-50">Batal</a>
                <button type="submit" class="rounded-lg bg-blue-700 px-5 py-3 font-bold text-white hover:bg-blue-800">Simpan berita</button>
            </div>
        </form>
    </main>
</body>

</html>

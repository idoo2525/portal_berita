<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Portal Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">
    <main class="mx-auto flex min-h-screen max-w-5xl items-center justify-center px-5 py-12">
        <section class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-7 shadow-sm sm:p-10">
            <a href="/" class="text-xl font-black text-slate-950">
                Portal<span class="text-blue-600">Berita.</span>
            </a>
            <p class="mt-8 text-sm font-bold uppercase tracking-widest text-blue-700">Panel Redaksi</p>
            <h1 class="mt-2 text-3xl font-black">Masuk admin</h1>
            <p class="mt-2 text-slate-500">Gunakan akun administrator untuk mengelola berita.</p>

            @if ($errors->any())
                <div role="alert" class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST" class="mt-7 space-y-5">
                @csrf
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100">
                </div>
                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold">Kata sandi</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100">
                </div>
                <label class="flex items-center gap-3 text-sm text-slate-600">
                    <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-slate-300 text-blue-600">
                    Ingat saya
                </label>
                <button type="submit" class="w-full rounded-lg bg-slate-950 px-5 py-3 font-bold text-white hover:bg-blue-700">
                    Masuk ke panel
                </button>
            </form>

            <a href="/" class="mt-6 inline-block text-sm font-semibold text-slate-500 hover:text-slate-900">Kembali ke halaman berita</a>
        </section>
    </main>
</body>

</html>

<aside class="flex w-full shrink-0 flex-col bg-[#10251f] text-white md:min-h-screen md:w-64">
    <div class="border-b border-white/10 px-5 py-5 md:px-6">
        @include('partials.brand', ['variant' => 'light', 'size' => 'medium'])
        <p class="mt-1 text-xs text-white/55">Ruang redaksi</p>
    </div>

    <nav aria-label="Navigasi admin" class="flex gap-2 overflow-x-auto px-3 py-3 md:flex-1 md:flex-col md:gap-1 md:px-3 md:py-6">
        <a href="{{ route('admin.articles.index') }}"
           @class([
               'flex shrink-0 items-center gap-3 rounded-md px-3 py-2.5 text-sm font-semibold transition md:w-full',
               'bg-[#d9f279] text-[#17211e]' => request()->routeIs('admin.articles.index'),
               'text-white/75 hover:bg-white/10 hover:text-white' => ! request()->routeIs('admin.articles.index'),
           ])>
            <svg aria-hidden="true" viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 5.5h16v13H4zM8 9h8m-8 4h8m-8 3h5"/></svg>
            Kelola berita
        </a>
        <a href="{{ route('admin.articles.create') }}"
           @class([
               'flex shrink-0 items-center gap-3 rounded-md px-3 py-2.5 text-sm font-semibold transition md:w-full',
               'bg-[#d9f279] text-[#17211e]' => request()->routeIs('admin.articles.create'),
               'text-white/75 hover:bg-white/10 hover:text-white' => ! request()->routeIs('admin.articles.create'),
           ])>
            <svg aria-hidden="true" viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 5v14M5 12h14"/></svg>
            Tambah berita
        </a>
        <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-3 rounded-md px-3 py-2.5 text-sm font-semibold text-white/75 transition hover:bg-white/10 hover:text-white md:w-full">
            <svg aria-hidden="true" viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 10.5 12 3l9 7.5M5.5 9v11h13V9M9 20v-6h6v6"/></svg>
            Lihat website
        </a>
        <form action="{{ route('logout') }}" method="POST" class="md:hidden">
            @csrf
            <button type="submit" class="flex min-h-10 shrink-0 items-center gap-2 rounded-md px-3 text-sm font-semibold text-white/75 hover:bg-white/10 hover:text-white">
                <svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 17l5-5-5-5m5 5H3m9-9h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7"/></svg>
                Keluar
            </button>
        </form>
    </nav>

    <div class="hidden border-t border-white/10 p-4 md:block">
        <p class="truncate text-xs font-semibold text-white/80">{{ auth()->user()->name }}</p>
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="flex w-full items-center gap-2 rounded-md px-2 py-2 text-left text-sm text-white/60 transition hover:bg-white/10 hover:text-white">
                <svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 17l5-5-5-5m5 5H3m9-9h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7"/></svg>
                Keluar
            </button>
        </form>
    </div>
</aside>
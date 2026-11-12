<!DOCTYPE html>
<html lang="id">
<head><title>Lentera — Scholarship Analytics Platform</title>@include('partials.head')</head>
<body class="text-forest-900 antialiased">

{{-- floating pill nav --}}
<div class="sticky top-4 z-20 px-4">
  <header class="max-w-5xl mx-auto bg-white/85 backdrop-blur border border-sand rounded-full pl-6 pr-2 py-2 flex items-center justify-between shadow-sm">
    @include('partials.logo')
    <nav class="hidden md:flex gap-8 text-sm font-medium text-forest-700">
      <a href="#fitur" class="hover:text-forest-950">Fitur</a><a href="#cara-kerja" class="hover:text-forest-950">Cara Kerja</a><a href="#preview" class="hover:text-forest-950">Preview</a>
    </nav>
    <div class="flex items-center gap-1">
      <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-semibold">Masuk</a>
      <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-semibold rounded-full bg-forest-900 text-white hover:bg-forest-700">Mulai Sekarang</a>
    </div>
  </header>
</div>

{{-- hero (centered) --}}
<section class="max-w-4xl mx-auto px-6 pt-20 pb-14 text-center">
  <span class="inline-flex items-center gap-2 text-sm font-semibold bg-lime/60 rounded-full px-4 py-1.5"><span class="w-2 h-2 rounded-full bg-forest-700"></span> Scholarship Analytics Platform</span>
  <h1 class="mt-8 font-display text-6xl md:text-8xl font-semibold tracking-tight leading-[0.95]">Every scholarship.<br><em class="text-forest-600 not-italic">One clear picture.</em></h1>
  <p class="mt-8 text-lg text-forest-700/80 max-w-2xl mx-auto leading-relaxed">Dari jumlah pendaftar sampai penerima beasiswa, semuanya jadi lebih mudah dipahami. Satu dashboard untuk memantau, menganalisis, dan mengambil keputusan.</p>
  <div class="mt-10 flex justify-center gap-3">
    <a href="{{ route('register') }}" class="px-8 py-4 rounded-full bg-forest-900 text-white font-semibold hover:bg-forest-700">Jelajahi Lentera →</a>
    <a href="#preview" class="px-8 py-4 rounded-full border border-forest-900/20 font-semibold hover:bg-white">Lihat Preview ↓</a>
  </div>
</section>

{{-- preview: bento --}}
<section id="preview" class="max-w-6xl mx-auto px-6 pb-24">
  <div class="rounded-[2rem] bg-forest-900 dots p-5 md:p-8 text-white shadow-2xl">
    <div class="flex items-center justify-between text-xs text-white/60 mb-5"><span>lentera / overview</span><span class="bg-white/10 rounded-full px-3 py-1">● Demo Data</span></div>
    <div class="grid md:grid-cols-4 gap-4">
      <div class="md:col-span-2 md:row-span-2 rounded-3xl bg-forest-800 p-7">
        <p class="text-white/60 text-sm">Total Pendaftar</p>
        <p class="font-display text-7xl font-semibold mt-2">1.750</p>
        <div class="mt-8 flex items-end gap-3 h-28">
          @foreach([100,62,48,78,40,55] as $h)<div class="flex-1 rounded-t-lg bg-lime/80" style="height: {{ $h }}%"></div>@endforeach
        </div>
      </div>
      <div class="rounded-3xl bg-lime text-forest-900 p-6"><p class="text-sm font-medium">Keterisian Kuota</p><p class="font-display text-5xl font-semibold mt-2">91,3%</p></div>
      <div class="rounded-3xl bg-forest-800 p-6"><p class="text-white/60 text-sm">Penerima</p><p class="font-display text-5xl font-semibold mt-2">410</p></div>
      <div class="rounded-3xl bg-forest-800 p-6"><p class="text-white/60 text-sm">Lolos Administrasi</p><p class="font-display text-4xl font-semibold mt-2">1.135</p></div>
      <div class="rounded-3xl bg-clay text-forest-950 p-6"><p class="text-sm font-medium">✦ AI-powered insights</p><p class="text-sm mt-2">Know more, decide better.</p></div>
    </div>
  </div>
</section>

{{-- marquee strip --}}
<section class="border-y border-sand bg-white/50 py-6 overflow-hidden">
  <div class="max-w-6xl mx-auto px-6 flex flex-wrap justify-between gap-4 text-sm font-semibold tracking-wide text-forest-700">
    <span>◈ SMART ANALYTICS</span><span>✧ AI INSIGHTS</span><span>⇄ AUTOMATION READY</span><span>▦ MULTI SCHOLARSHIPS</span>
  </div>
</section>

{{-- fitur --}}
<section id="fitur" class="max-w-6xl mx-auto px-6 py-24">
  <h2 class="font-display text-5xl font-semibold tracking-tight max-w-2xl">Semua yang dibutuhkan tim beasiswa.</h2>
  <div class="mt-12 grid md:grid-cols-3 gap-5">
    @foreach([['01','Dashboard Real-time','Pantau pendaftar, kelulusan, penerima, dan keterisian kuota dalam satu layar.'],['02','Selection Funnel','Lihat di tahap mana pendaftar berguguran, dari administrasi hingga penerima.'],['03','Kelola Data','Tambah, ubah, dan hapus program beasiswa langsung dari dashboard.']] as $f)
    <div class="rounded-3xl bg-white border border-sand p-8 hover:-translate-y-1 transition">
      <span class="font-display text-4xl text-forest-600/40">{{ $f[0] }}</span>
      <h3 class="mt-10 font-display text-2xl font-semibold">{{ $f[1] }}</h3><p class="mt-2 text-forest-700/80">{{ $f[2] }}</p>
    </div>@endforeach
  </div>
</section>

{{-- cara kerja --}}
<section id="cara-kerja" class="max-w-6xl mx-auto px-6 pb-24">
  <h2 class="font-display text-5xl font-semibold tracking-tight">Cara kerja</h2>
  <ol class="mt-12 grid md:grid-cols-3 gap-8 border-t border-forest-900/15 pt-8">
    @foreach([['Daftar & masuk','Buat akun Lentera dalam hitungan detik.'],['Input data beasiswa','Masukkan kuota, pendaftar, dan hasil seleksi tiap program.'],['Analisis & ekspor','Baca insight di dashboard lalu unduh laporan CSV.']] as $i => $s)
    <li><span class="w-10 h-10 rounded-full bg-lime flex items-center justify-center font-bold">{{ $i+1 }}</span><h3 class="mt-5 font-semibold text-lg">{{ $s[0] }}</h3><p class="text-forest-700/80 mt-1">{{ $s[1] }}</p></li>@endforeach
  </ol>
</section>

{{-- CTA --}}
<section class="max-w-6xl mx-auto px-6 pb-20">
  <div class="rounded-[2rem] bg-forest-900 dots text-white text-center py-16 px-6">
    <h2 class="font-display text-4xl md:text-5xl font-semibold">Siap melihat gambaran utuh beasiswa Anda?</h2>
    <a href="{{ route('register') }}" class="inline-block mt-8 px-8 py-4 rounded-full bg-lime text-forest-900 font-semibold">Buat akun gratis →</a>
  </div>
  <p class="mt-10 text-sm text-forest-700/60 text-center">Lentera © {{ date('Y') }}</p>
</section>
</body></html>

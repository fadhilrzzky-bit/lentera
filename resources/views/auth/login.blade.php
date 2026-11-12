<!DOCTYPE html>
<html lang="id"><head><title>Masuk — Lentera</title>@include('partials.head')</head>
<body class="text-forest-900">
@include('partials.auth-shell-top')
  @php $in = 'w-full px-5 py-3.5 rounded-full border border-sand bg-white outline-none focus:border-forest-600 focus:ring-4 focus:ring-lime/40'; @endphp
  <h2 class="font-display text-4xl font-semibold">Selamat datang kembali</h2>
  <p class="text-forest-700/70 mt-2 mb-7">Masuk untuk membuka dashboard Lentera.</p>
  @if(session('error'))<div class="mb-5 p-3 rounded-2xl bg-red-100 text-red-800 text-sm font-medium">{{ session('error') }}</div>@endif
  @if($errors->any())<div class="mb-5 p-3 rounded-2xl bg-red-100 text-red-800 text-sm font-medium">{{ $errors->first() }}</div>@endif
  <form method="POST" action="{{ route('login.process') }}" class="space-y-4">@csrf
    <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email" class="{{ $in }}">
    <input type="password" name="password" required placeholder="Kata sandi" class="{{ $in }}">
    <button class="w-full py-3.5 rounded-full bg-forest-900 text-white font-semibold hover:bg-forest-700">Masuk</button>
  </form>
  <p class="mt-6 text-sm text-center text-forest-700/70">Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-forest-900 underline">Daftar</a></p>
@include('partials.auth-shell-bottom')
</body></html>

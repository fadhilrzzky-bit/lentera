<!DOCTYPE html>
<html lang="id"><head><title>Daftar — Lentera</title>@include('partials.head')</head>
<body class="text-forest-900">
@include('partials.auth-shell-top')
  @php $in = 'w-full px-5 py-3.5 rounded-full border border-sand bg-white outline-none focus:border-forest-600 focus:ring-4 focus:ring-lime/40'; @endphp
  <h2 class="font-display text-4xl font-semibold">Buat akun</h2>
  <p class="text-forest-700/70 mt-2 mb-7">Mulai pantau program beasiswa Anda.</p>
  @if($errors->any())<div class="mb-5 p-3 rounded-2xl bg-red-100 text-red-800 text-sm font-medium space-y-1">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif
  <form method="POST" action="{{ route('register.process') }}" class="space-y-4">@csrf
    <input name="name" value="{{ old('name') }}" required placeholder="Nama lengkap" class="{{ $in }}">
    <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email" class="{{ $in }}">
    <input type="password" name="password" required minlength="8" placeholder="Kata sandi (min. 8 karakter)" class="{{ $in }}">
    <input type="password" name="password_confirmation" required placeholder="Konfirmasi kata sandi" class="{{ $in }}">
    <button class="w-full py-3.5 rounded-full bg-forest-900 text-white font-semibold hover:bg-forest-700">Daftar</button>
  </form>
  <p class="mt-6 text-sm text-center text-forest-700/70">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-forest-900 underline">Masuk</a></p>
@include('partials.auth-shell-bottom')
</body></html>

<!DOCTYPE html>
<html lang="id">
<head><title>@yield('title', 'Dashboard') — Lentera</title>@include('partials.head')</head>
<body class="text-forest-900 antialiased">
@php
  $nav = [['overview','Overview'],['scholarships','Scholarships'],['funnel','Selection Funnel'],['manage','Manage Data'],['assistant','AI Assistant']];
  $name = session('user_name', 'User');
@endphp
<header class="bg-forest-900 text-white">
  <div class="max-w-7xl mx-auto px-5 lg:px-10 h-20 flex items-center justify-between gap-6">
    <a href="{{ route('overview') }}">@include('partials.logo', ['light' => true])</a>
    <nav class="hidden lg:flex items-center gap-1 bg-white/10 rounded-full p-1.5">
      @foreach($nav as [$r, $label])
        <a href="{{ route($r) }}" class="px-5 py-2 rounded-full text-sm font-semibold {{ request()->routeIs($r) ? 'bg-lime text-forest-900' : 'text-white/75 hover:text-white' }}">
          {{ $label }}@if($r === 'assistant')<span class="ml-1.5 text-[9px] align-middle opacity-70">DEMO</span>@endif
        </a>
      @endforeach
    </nav>
    <div class="flex items-center gap-3">
      <span class="hidden xl:inline text-sm text-white/70">{{ $name }}</span>
      <span class="w-10 h-10 rounded-full bg-lime text-forest-900 font-bold flex items-center justify-center uppercase">{{ mb_substr($name, 0, 1) }}</span>
      <form method="POST" action="{{ route('logout') }}">@csrf<button class="px-4 py-2 rounded-full border border-white/25 text-sm font-semibold hover:bg-white/10">Keluar</button></form>
    </div>
  </div>
  {{-- mobile nav --}}
  <nav class="lg:hidden flex gap-2 overflow-x-auto no-scrollbar px-5 pb-4">
    @foreach($nav as [$r, $label])
      <a href="{{ route($r) }}" class="shrink-0 px-4 py-2 rounded-full text-sm font-semibold {{ request()->routeIs($r) ? 'bg-lime text-forest-900' : 'bg-white/10 text-white/80' }}">{{ $label }}</a>
    @endforeach
  </nav>
</header>

<main class="max-w-7xl mx-auto px-5 lg:px-10 py-10">
  @if(session('success'))<div class="mb-6 p-4 rounded-2xl bg-lime/60 font-semibold">{{ session('success') }}</div>@endif
  @if($errors->any())<div class="mb-6 p-4 rounded-2xl bg-red-100 text-red-800 font-semibold">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif
  @yield('content')
</main>
<footer class="max-w-7xl mx-auto px-5 lg:px-10 pb-10 text-sm text-forest-700/60">Lentera © {{ date('Y') }} · v0.3</footer>
</body></html>

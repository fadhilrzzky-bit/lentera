@extends('layouts.app')
@section('title','Overview')
@section('content')
@php
  $fmt = fn($n) => number_format($n, 0, ',', '.');
  $pctf = fn($n) => str_replace('.', ',', $n) . '%';
  $colors = ['#143828','#23684a','#c9f26b','#e8a54b','#6fa88a','#a8d64a','#0b1f17','#d9cfae'];
  $maxApp = max(1, $rows->max('applicants') ?? 1);
  $r = 54; $circ = 2 * pi() * $r; $off = $circ * (1 - min(100, $fill_pct) / 100);
@endphp
@include('partials.page-head', ['title'=>'Dashboard Overview','desc'=>'Pantau perkembangan dan performa program beasiswa.','filter'=>true])

<div class="grid lg:grid-cols-4 gap-5">
  {{-- Total pendaftar (besar) --}}
  <div class="lg:col-span-2 rounded-[2rem] bg-forest-900 dots text-white p-8">
    <p class="text-white/60 font-medium">Total Pendaftar</p>
    <p class="font-display text-8xl font-semibold mt-2 tracking-tight">{{ $fmt($applicants) }}</p>
    <p class="text-white/60 mt-2">Jumlah pendaftaran tercatat</p>
    <div class="mt-8 grid grid-cols-3 gap-3">
      <div class="rounded-2xl bg-white/10 p-4"><p class="text-xs text-white/60">Lolos Adm.</p><p class="font-display text-2xl font-semibold">{{ $fmt($admin) }}</p></div>
      <div class="rounded-2xl bg-white/10 p-4"><p class="text-xs text-white/60">Lolos Seleksi</p><p class="font-display text-2xl font-semibold">{{ $fmt($selection) }}</p></div>
      <div class="rounded-2xl bg-white/10 p-4"><p class="text-xs text-white/60">Penerima</p><p class="font-display text-2xl font-semibold">{{ $fmt($recipients) }}</p></div>
    </div>
  </div>

  {{-- Keterisian kuota (ring) --}}
  <div class="rounded-[2rem] bg-lime p-8 flex flex-col">
    <p class="font-semibold">Keterisian Kuota</p>
    <div class="relative w-40 h-40 mx-auto my-4">
      <svg viewBox="0 0 120 120" class="-rotate-90"><circle cx="60" cy="60" r="{{ $r }}" fill="none" stroke="#0f2a20" stroke-opacity=".15" stroke-width="12"/>
        <circle cx="60" cy="60" r="{{ $r }}" fill="none" stroke="#0f2a20" stroke-width="12" stroke-linecap="round" stroke-dasharray="{{ $circ }}" stroke-dashoffset="{{ $off }}"/></svg>
      <span class="absolute inset-0 flex items-center justify-center font-display text-3xl font-semibold">{{ $pctf($fill_pct) }}</span>
    </div>
    <p class="text-sm text-center">{{ $fmt($recipients) }} dari {{ $fmt($quota) }} kuota</p>
  </div>

  {{-- tingkat --}}
  <div class="flex flex-col gap-5">
    <div class="flex-1 rounded-[2rem] bg-white border border-sand p-6"><p class="text-forest-700/70 font-medium">Lolos Administrasi</p><p class="font-display text-4xl font-semibold mt-1">{{ $pctf($admin_pct) }}</p><p class="text-sm text-forest-700/60">dari pendaftar</p></div>
    <div class="flex-1 rounded-[2rem] bg-clay p-6"><p class="font-medium">Tingkat Penerimaan</p><p class="font-display text-4xl font-semibold mt-1">{{ $pctf($accept_pct) }}</p><p class="text-sm">dari pendaftar</p></div>
  </div>
</div>

{{-- distribusi: stacked bar + daftar --}}
<div class="mt-5 rounded-[2rem] bg-white border border-sand p-8">
  <div class="flex flex-wrap justify-between gap-2">
    <div><h3 class="font-display text-2xl font-semibold">Distribusi Pendaftar</h3><p class="text-forest-700/70">Persentase pendaftar berdasarkan program beasiswa.</p></div>
  </div>
  <div class="mt-6 flex h-6 rounded-full overflow-hidden bg-sand">
    @foreach($rows as $i => $row)<div title="{{ $row->name }}" style="width: {{ $pct($row->applicants, max(1,$applicants)) }}%; background: {{ $colors[$i % 8] }}"></div>@endforeach
  </div>
  <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-3">
    @foreach($rows as $i => $row)
    <div class="flex items-center gap-3 py-2 border-b border-sand/70"><span class="w-3 h-3 rounded-full" style="background: {{ $colors[$i % 8] }}"></span><span>{{ $row->name }}</span><span class="ml-auto font-bold">{{ $pctf($pct($row->applicants, max(1,$applicants))) }}</span></div>
    @endforeach
  </div>
</div>

{{-- pendaftar per program: kolom vertikal --}}
<div class="mt-5 rounded-[2rem] bg-white border border-sand p-8">
  <h3 class="font-display text-2xl font-semibold">Pendaftar per Program</h3>
  <p class="text-forest-700/70">Perbandingan jumlah pendaftar setiap beasiswa.</p>
  <div class="mt-8 flex items-end gap-4 h-64">
    @forelse($rows as $i => $row)
    <div class="flex-1 h-full flex flex-col justify-end items-center gap-2">
      <span class="font-bold text-sm">{{ $fmt($row->applicants) }}</span>
      <div class="w-full max-w-[72px] rounded-t-2xl" style="height: {{ max(3, round($row->applicants / $maxApp * 85)) }}%; background: {{ $colors[$i % 8] }}"></div>
      <span class="text-xs text-center text-forest-700/70 leading-tight h-8">{{ $row->name }}</span>
    </div>
    @empty <p class="text-forest-700/60">Belum ada data. Tambahkan lewat Manage Data.</p>
    @endforelse
  </div>
</div>
@endsection

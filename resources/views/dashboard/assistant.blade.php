@extends('layouts.app')
@section('title','AI Assistant')
@section('content')
@include('partials.page-head', ['title'=>'AI Assistant','desc'=>'Insight otomatis dari data Anda (mode demo, berbasis aturan sederhana).'])
@php
  $insights = [];
  $insights[] = "Tingkat penerimaan keseluruhan {$accept_pct}% dari {$applicants} pendaftar.";
  $insights[] = "Kuota terisi {$fill_pct}% ({$recipients} dari {$quota}).";
  $top = $rows->sortByDesc('applicants')->first();
  if ($top) $insights[] = "Program paling diminati: {$top->name} dengan {$top->applicants} pendaftar.";
  $tight = $rows->filter(fn($r) => $r->quota > 0 && $r->recipients / $r->quota < 0.8)->pluck('name')->all();
  if ($tight) $insights[] = 'Kuota belum terisi di atas 80%: ' . implode(', ', $tight) . '.';
@endphp
<div class="max-w-3xl rounded-[2rem] bg-white border border-sand p-6 md:p-8 space-y-4">
  <div class="flex justify-end"><div class="bg-forest-900 text-white rounded-3xl rounded-br-md px-5 py-3">Beri saya ringkasan performa beasiswa.</div></div>
  @foreach($insights as $t)
  <div class="flex gap-3"><span class="w-9 h-9 shrink-0 rounded-full bg-lime flex items-center justify-center">✦</span><div class="bg-cream rounded-3xl rounded-tl-md px-5 py-3">{{ $t }}</div></div>
  @endforeach
  <p class="text-sm text-forest-700/60 pt-2">Fitur ini masih demo. Nanti bisa disambungkan ke Claude API.</p>
</div>
@endsection

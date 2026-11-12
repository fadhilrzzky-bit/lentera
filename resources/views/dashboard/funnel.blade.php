@extends('layouts.app')
@section('title','Selection Funnel')
@section('content')
@php
  $steps = [['Pendaftar',$applicants,'#143828','text-white'],['Lolos Administrasi',$admin,'#23684a','text-white'],['Lolos Seleksi',$selection,'#c9f26b','text-forest-900'],['Penerima Beasiswa',$recipients,'#e8a54b','text-forest-900']];
  $top = max(1, $applicants);
@endphp
@include('partials.page-head', ['title'=>'Selection Funnel','desc'=>'Alur seleksi dari pendaftaran hingga penerima beasiswa.','filter'=>true])
<div class="rounded-[2rem] bg-white border border-sand p-8 md:p-12">
  <div class="space-y-3">
    @foreach($steps as $i => [$label,$val,$bg,$tx])
    <div class="mx-auto rounded-2xl px-6 py-5 flex items-center justify-between {{ $tx }}" style="background: {{ $bg }}; width: {{ max(28, round($val/$top*100)) }}%">
      <span class="font-semibold">{{ $label }}</span>
      <span><b class="font-display text-2xl">{{ number_format($val,0,',','.') }}</b> <span class="text-sm opacity-80">· {{ str_replace('.',',',$pct($val,$top)) }}%</span></span>
    </div>
    @if($i < 3)<p class="text-center text-xs text-forest-700/60">↓ {{ str_replace('.',',',$pct($steps[$i+1][1], max(1,$val))) }}% lanjut ke tahap berikutnya</p>@endif
    @endforeach
  </div>
</div>
@endsection

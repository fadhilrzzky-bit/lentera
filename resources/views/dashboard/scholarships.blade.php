@extends('layouts.app')
@section('title','Scholarships')
@section('content')
@include('partials.page-head', ['title'=>'Scholarships','desc'=>'Ringkasan setiap program beasiswa.'])
<div class="rounded-[2rem] bg-white border border-sand divide-y divide-sand overflow-hidden">
  @forelse($rows as $i => $r)
  @php $fill = $pct($r->recipients, $r->quota); @endphp
  <div class="p-6 md:p-8 grid md:grid-cols-[2fr_3fr_2fr] gap-6 items-center">
    <div class="flex items-center gap-4"><span class="font-display text-3xl text-forest-600/40 w-10">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
      <div><h3 class="font-display text-xl font-semibold">{{ $r->name }}</h3><p class="text-sm text-forest-700/60">Kuota {{ $r->quota }}</p></div></div>
    <div class="grid grid-cols-4 text-center gap-2">
      @foreach([['Pendaftar',$r->applicants],['Lolos Adm.',$r->passed_admin],['Lolos Seleksi',$r->passed_selection],['Penerima',$r->recipients]] as [$l,$v])
      <div><p class="font-display text-2xl font-semibold">{{ number_format($v,0,',','.') }}</p><p class="text-xs text-forest-700/60">{{ $l }}</p></div>@endforeach
    </div>
    <div><div class="flex justify-between text-sm mb-2"><span class="text-forest-700/70">Keterisian</span><b>{{ str_replace('.',',',$fill) }}%</b></div>
      <div class="h-3 rounded-full bg-sand"><div class="h-3 rounded-full bg-forest-600" style="width: {{ min(100,$fill) }}%"></div></div></div>
  </div>
  @empty <p class="p-8 text-forest-700/60">Belum ada program. Tambahkan lewat Manage Data.</p>
  @endforelse
</div>
@endsection

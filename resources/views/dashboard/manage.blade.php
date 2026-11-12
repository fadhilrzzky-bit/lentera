@extends('layouts.app')
@section('title','Manage Data')
@section('content')
@include('partials.page-head', ['title'=>'Manage Data','desc'=>'Tambah dan perbarui data program beasiswa (tersimpan di Supabase).'])
@php
  $cols = ['name'=>'Program','quota'=>'Kuota','applicants'=>'Pendaftar','passed_admin'=>'Lolos Adm.','passed_selection'=>'Lolos Seleksi','recipients'=>'Penerima'];
  $in = 'w-full px-4 py-2.5 rounded-full border border-sand bg-cream text-sm outline-none focus:border-forest-600';
@endphp
<div class="rounded-[2rem] bg-white border border-sand p-6 overflow-x-auto">
  <table class="w-full text-left">
    <thead><tr class="text-xs font-bold uppercase tracking-wider text-forest-700/60">@foreach($cols as $c)<th class="px-2 pb-3">{{ $c }}</th>@endforeach<th></th></tr></thead>
    <tbody class="divide-y divide-sand">
    @foreach($programs as $p)
      <tr>
        @foreach($cols as $k => $label)
          <td class="px-2 py-3"><input form="f{{ $p->id }}" name="{{ $k }}" value="{{ $p->$k }}" type="{{ $k=='name' ? 'text' : 'number' }}" min="0" required class="{{ $in }} {{ $k=='name' ? 'min-w-[180px]' : 'w-24' }}"></td>
        @endforeach
        <td class="px-2 py-3 whitespace-nowrap">
          <button form="f{{ $p->id }}" class="px-4 py-2 rounded-full bg-forest-900 text-white text-sm font-semibold">Simpan</button>
          <form method="POST" action="{{ route('manage.destroy', $p->id) }}" class="inline" onsubmit="return confirm('Hapus program ini?')">@csrf @method('DELETE')<button class="px-3 py-2 text-sm font-semibold text-red-600">Hapus</button></form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@foreach($programs as $p)
  <form id="f{{ $p->id }}" method="POST" action="{{ route('manage.update', $p->id) }}" class="hidden">@csrf @method('PUT')</form>
@endforeach

<h3 class="mt-10 mb-4 font-display text-2xl font-semibold">Tambah program baru</h3>
<form method="POST" action="{{ route('manage.store') }}" class="rounded-[2rem] bg-forest-900 dots text-white p-6 grid sm:grid-cols-3 xl:grid-cols-7 gap-4 items-end">@csrf
  @foreach($cols as $k => $label)
    <div class="{{ $k=='name' ? 'xl:col-span-2' : '' }}"><label class="block text-xs text-white/70 mb-1">{{ $label }}</label>
      <input name="{{ $k }}" value="{{ old($k, $k=='name' ? '' : 0) }}" type="{{ $k=='name' ? 'text' : 'number' }}" min="0" required class="{{ $in }} text-forest-900"></div>
  @endforeach
  <button class="py-2.5 rounded-full bg-lime text-forest-900 font-bold">Tambah</button>
</form>
<p class="mt-4 text-sm text-forest-700/60">Aturan: Pendaftar ≥ Lolos Administrasi ≥ Lolos Seleksi ≥ Penerima.</p>
@endsection

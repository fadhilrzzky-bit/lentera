<div class="mb-8">
  <p class="text-sm font-semibold text-forest-600">Halo, {{ session('user_name', 'User') }} 👋</p>
  <div class="flex flex-wrap items-end justify-between gap-4 mt-1">
    <div>
      <h1 class="font-display text-5xl font-semibold tracking-tight">{{ $title }}</h1>
      <p class="mt-2 text-forest-700/80">{{ $desc }}</p>
    </div>
    @if(!empty($filter))
      <a href="{{ route('export', array_filter(['program' => $selected])) }}" class="px-6 py-3 rounded-full bg-forest-900 text-white font-semibold hover:bg-forest-700">↓ Export Report</a>
    @endif
  </div>
  @if(!empty($filter))
  <div class="mt-6 flex flex-wrap gap-2">
    <a href="{{ url()->current() }}" class="px-4 py-2 rounded-full text-sm font-semibold border {{ !$selected ? 'bg-forest-900 text-white border-forest-900' : 'bg-white border-sand hover:border-forest-600' }}">Semua Beasiswa</a>
    @foreach($programs as $p)
      <a href="{{ url()->current() }}?program={{ $p->id }}" class="px-4 py-2 rounded-full text-sm font-semibold border {{ $selected == $p->id ? 'bg-forest-900 text-white border-forest-900' : 'bg-white border-sand hover:border-forest-600' }}">{{ $p->name }}</a>
    @endforeach
  </div>
  @endif
</div>

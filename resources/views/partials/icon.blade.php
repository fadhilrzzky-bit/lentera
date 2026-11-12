@php
$paths = [
  'grid'   => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>',
  'cap'    => '<path d="M22 10 12 5 2 10l10 5 10-5z"/><path d="M6 12v5c3 2 9 2 12 0v-5"/>',
  'funnel' => '<path d="M22 3H2l8 9.5V19l4 2v-8.5L22 3z"/>',
  'table'  => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/>',
  'spark'  => '<path d="M12 2l2.2 6.8L21 11l-6.8 2.2L12 20l-2.2-6.8L3 11l6.8-2.2L12 2z"/>',
  'users'  => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c0-3.6 2.9-6 6.5-6s6.5 2.4 6.5 6"/><path d="M16 4.5a3.5 3.5 0 010 7M18 14.5c2 .7 3.5 2.6 3.5 5.5"/>',
  'check'  => '<circle cx="12" cy="12" r="9"/><path d="m8 12 3 3 5-6"/>',
  'chart'  => '<path d="M3 3v18h18"/><path d="m7 15 4-4 3 3 5-6"/>',
  'down'   => '<path d="M12 4v12m0 0-5-5m5 5 5-5M5 20h14"/>',
];
@endphp
<svg class="{{ $c ?? 'w-5 h-5' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">{!! $paths[$n] ?? '' !!}</svg>

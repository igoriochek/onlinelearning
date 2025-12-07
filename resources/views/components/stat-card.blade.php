@props(['label', 'value', 'color'])
<div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center gap-4 hover:shadow-md transition">
  <div class="p-3 rounded-full bg-gray-100 text-{{ $color }}-600">
    {{ $slot }}
  </div>
  <div>
    <p class="text-sm text-gray-500">{{ $label }}</p>
    <p class="text-2xl font-bold text-gray-900">{{ $value }}</p>
  </div>
</div>
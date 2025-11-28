@if(session('success') || session('error'))
@php
$type = session('success') ? 'success' : 'error';
$message = session('success') ?? session('error');
@endphp
<div
  x-data="{ show: true }"
  x-show="show"
  x-init="setTimeout(() => show = false, 3000)"
  class="z-[9999] fixed top-10 right-10 flex items-center bg-white text-sm font-medium px-4 py-3 rounded-lg shadow-lg border border-gray-300">

  <div class="p-1 rounded-full mr-3">
    @if($type === 'success')
    ✅
    @else
    ❌
    @endif
  </div>

  <span class="text-sm text-gray-500 font-semibold">{{ $message }}</span>

  <button @click="show = false" class="ml-4 text-gray-500 hover:text-black">✕</button>
</div>
@endif
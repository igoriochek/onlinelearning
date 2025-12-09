@if(session('success') || session('error') || session('info'))
@php
$type = session('success') ? 'success' : (session('error') ? 'error' : 'info');
$message = session('success') ?? session('error') ?? session('info');
@endphp

<div
  x-data="{ show: true }"
  x-show="show"
  x-init="setTimeout(() => show = false, 3000)"
  class="z-[99] fixed top-10 right-20 flex items-center max-w-sm p-4 text-body bg-white text-sm font-medium px-4 py-3 rounded-md shadow-xs border border-default">

  <div class="p-1 mr-3 rounded-md 
      {{ $type === 'success' ? 'bg-green-100' : ($type === 'error' ? 'bg-red-100' : 'bg-blue-100') }}">

    @if($type === 'success')
    <x-lucide-check class="w-5 h-5 text-green-600" />
    <span class="sr-only">Check icon</span>
    @elseif($type === 'error')
    <x-lucide-x class="w-5 h-5 text-red-600" />
    <span class="sr-only">Error icon</span>
    @else
    <x-lucide-info class="w-5 h-5 text-blue-500" />
    <span class="sr-only">Info icon</span>
    @endif
  </div>

  <span class="ms-3 text-sm font-normal">{{ $message }}</span>

  <button @click="show = false"
    type="button"
    class="ms-auto flex items-center justify-center
           text-gray-400 hover:text-gray-600
           box-border border border-transparent
           bg-transparent hover:bg-gray-100
           font-medium leading-5 rounded text-sm
           h-8 w-8 focus:outline-none focus:ring-2 focus:ring-gray-600"
    aria-label="Close">
    <x-lucide-x class="w-5 h-5" />
    <span class="sr-only">Close</span>
  </button>
</div>
@endif
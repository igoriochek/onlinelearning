@if($user->avatar)
<img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-full w-10 h-10" />
@else
<div class="rounded-full w-10 h-10 flex items-center justify-center font-semibold {{ $placeholderColor() }}">
  {{ strtoupper(substr($user->name, 0, 1)) }}
</div>
@endif
@props(['users'])

<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
  <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('admin.recent_users') }}</h3>

  <ul class="divide-y divide-gray-100">
    @foreach ($users as $user)
    <li class="py-3 flex items-center gap-4">
      <x-avatar :user="$user" />

      <div class="flex-1">
        <p class="font-medium text-gray-900">{{ $user->name }}</p>
        <p class="text-sm text-gray-500">{{ $user->email }}</p>
      </div>

      <span class="text-sm text-gray-400">
        {{ $user->created_at->format('Y-m-d') }}
      </span>
    </li>
    @endforeach
  </ul>
  <div class="text-right">
    <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:underline">
      {{ __('admin.see_all_users') }}
    </a>
  </div>
</div>
@props(['users'])

<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
  <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Users</h3>

  <ul class="divide-y divide-gray-100">
    @foreach ($users as $user)
    <li class="py-3 flex items-center gap-4">
      <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-semibold">
        {{ strtoupper(substr($user->name, 0, 1)) }}
      </div>

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
      See all users
    </a>
  </div>
</div>
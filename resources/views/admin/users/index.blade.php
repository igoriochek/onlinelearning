<x-admin-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('admin.users_management') }}
    </h2>
  </x-slot>
  <div class="py-6" x-data="{ userId: null}">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="relative overflow-x-auto shadow rounded-lg border border-default">
        <table class="w-full text-sm text-left rtl:text-right">
          <thead class="bg-gray-50 text-gray-500 text-xs uppercase border-b font-medium ">
            <tr>
              <th class="px-6 py-3">
                {{ __('tables.name') }}
              </th>

              <th class="px-6 py-3">
                {{ __('tables.email') }}
              </th>

              <th class="px-6 py-3" data-sortable="text">
                <div class="flex items-center">
                  {{ __('tables.role') }}
                  <a href="#" id="sortRole">
                    <x-lucide-arrow-up-down class="w-4 h-4 ms-1" />
                  </a>
                </div>
              </th>

              <th class="px-6 py-3" data-sortable="text">
                <div class="flex items-center">
                  {{ __('tables.status') }}
                  <a href="#" id="sortStatus">
                    <x-lucide-arrow-up-down class="w-4 h-4 ms-1" />
                  </a>
                </div>
              </th>

              <th class="px-6 py-3">
                {{ __('tables.registration_date') }}
              </th>

              <th class="px-6 py-3">
                {{ __('tables.last_login') }}
              </th>

              <th class="px-6 py-3 text-right">
                {{ __('tables.actions') }}
              </th>

            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($users as $user)
            <tr class="border-b">
              <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <x-badge :type="$user->role">{{ __('roles.' . $user->role) }}</x-badge>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <x-badge :type="$user->account_status">{{ __('status.' . $user->account_status) }}</x-badge>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $user->created_at->format('Y-m-d') }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : __('tables.never') }}
              </td>
              <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center justify-end gap-2">

                <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                    <button class="flex p-1 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition"
                      title="{{ __('tables.change_role') }}">
                      <x-lucide-user class="w-5 h-5" />
                    </button>
                  </x-slot>

                  <x-slot name="content">
                    <form id="update-role-{{ $user->id }}" action="{{ route('admin.users.update-role', $user) }}" method="POST">
                      @csrf
                      @method('PATCH')
                      @foreach(['student','teacher','admin'] as $role)
                      <button type="submit" name="role" value="{{ $role }}"
                        class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 {{ $user->role === $role ? 'font-bold' : '' }}">
                        {{ __('roles.' . $role) }}
                      </button>
                      @endforeach
                    </form>
                  </x-slot>
                </x-dropdown>

                <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="inline">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="text-gray-500 flex items-center justify-center"
                    title="{{ $user->account_status === 'active' ? __('actions.block') : __('actions.unblock') }}">
                    @if($user->account_status === 'active')
                    <x-lucide-lock class="w-5 h-5 hover:text-red-600" />
                    @else
                    <x-lucide-unlock class="w-5 h-5 hover:text-green-600" />
                    @endif
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="mt-4">
        {{ $users->links() }}
      </div>
    </div>
  </div>
</x-admin-layout>
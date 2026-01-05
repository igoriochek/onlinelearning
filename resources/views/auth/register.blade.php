<x-guest-layout>
  @section('title',__('auth.register_title'))
  @section('meta_description', __('auth.register_meta_description'))
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
      <x-input-label for="name" :value="__('auth.name')" />
      <x-text-input
        id="name"
        class="mt-1 block w-full"
        type="text"
        name="name"
        :value="old('name')"
        required
        autofocus
        autocomplete="name" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
      <x-input-label for="email" :value="__('auth.email')" />
      <x-text-input
        id="email"
        class="mt-1 block w-full"
        type="email"
        name="email"
        :value="old('email')"
        required
        autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('auth.password')" />

      <x-text-input
        id="password"
        class="mt-1 block w-full"
        type="password"
        name="password"
        required
        autocomplete="new-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
      <x-input-label
        for="password_confirmation"
        :value="__('auth.confirm_password')" />

      <x-text-input
        id="password_confirmation"
        class="mt-1 block w-full"
        type="password"
        name="password_confirmation"
        required
        autocomplete="new-password" />

      <x-input-error
        :messages="$errors->get('password_confirmation')"
        class="mt-2" />
    </div>

    <!-- Role checkbox -->
    <div class="mt-4">
      <label class="inline-flex items-center">
        <input
          type="checkbox"
          name="is_teacher"
          value="1"
          class="form-checkbox" />
        <span class="ml-2 text-gray-700">{{ __('auth.teacher_checkbox') }}</span>
      </label>
    </div>

    <div class="mt-4 flex items-center justify-end">
      <a
        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900
					focus:outline-none focus:ring-2 focus:ring-indigo-500
					focus:ring-offset-2"
        href="{{ route('login') }}">
        {{ __('auth.already_registered') }}
      </a>

      <x-primary-button class="ms-4">
        {{ __('auth.register_button') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>
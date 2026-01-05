<x-app-layout>
  @section('title', __('courses.page_title'))
  @section('meta_description', __('courses.meta_description'))
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('courses.header') }}
    </h2>
  </x-slot>

  <div class="py-6 px-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">
      <aside class="hidden md:block w-1/5 bg-white shadow-sm rounded-lg p-4 h-60">
        <form method="GET" action="{{ route('courses.index') }}" class="space-y-2">
          <p class="font-semibold mb-2">{{ __('courses.sort_by') }}</p>
          <x-select-input name="sort" id="sort" onchange="this.form.submit()">
            <option value="">{{ __('courses.default') }}</option>
            <option value="newest" @selected(request('sort')==='newest' )>{{ __('courses.newest') }}</option>
            <option value="popular" @selected(request('sort')==='popular' )>{{ __('courses.popular') }}</option>
            <option value="best" @selected(request('sort')==='best' )>{{ __('courses.best') }}</option>
          </x-select-input>
          <p class="font-semibold mb-2">{{ __('courses.filter_by_level') }}</p>
          <div class="space-y-2">
            @foreach($levels as $value => $key)
            <label class="flex items-center gap-2">
              <input
                type="checkbox"
                name="level[]"
                value="{{ $value }}"
                @checked(in_array($value, request('level', [])))
                onchange="this.form.submit()"
                class="border-gray-300 focus:border-gray-800 focus:ring-gray-800 rounded shadow-sm h-5 w-5" />
              <span>{{ __('levels.' . $key) }}</span>
            </label>
            @endforeach
          </div>
        </form>
      </aside>
      <div class="md:hidden bg-white shadow rounded-lg p-4 mb-4">
        <form method="GET" action="{{ route('courses.index') }}">
          <div class="mb-4">
            <label for="sort_mobile" class="font-semibold block mb-1">{{ __('courses.sort_by') }}</label>
            <x-select-input name="sort" id="sort_mobile" onchange="this.form.submit()">
              <option value="">{{ __('courses.default') }}</option>
              <option value="newest" @selected(request('sort')==='newest' )>{{ __('courses.newest') }}</option>
              <option value="popular" @selected(request('sort')==='popular' )>{{ __('courses.popular') }}</option>
              <option value="best" @selected(request('sort')==='best' )>{{ __('courses.best') }}</option>
            </x-select-input>
          </div>

          <details class="border-t border-gray-200 pt-2">
            <summary class="font-semibold cursor-pointer mb-2">{{ __('courses.filter_by_level') }}</summary>
            <div class="mt-2 space-y-2">
              @foreach($levels as $value => $key)
              <label class="flex items-center gap-2">
                <input type="checkbox"
                  name="level[]"
                  value="{{ $value }}"
                  @checked(in_array($value, request('level', [])))
                  onchange="this.form.submit()"
                  class="border-gray-300 focus:border-gray-800 focus:ring-gray-800 rounded shadow-sm h-5 w-5" />
                <span>{{ __('levels.' . $key) }}</span>
              </label>
              @endforeach
            </div>
          </details>
        </form>
      </div>
      <div class="flex-1">
        <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($courses as $course)
          <x-course-card :course="$course" />
          @endforeach
        </div>
        <div class="mt-6">
          {{ $courses->links() }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
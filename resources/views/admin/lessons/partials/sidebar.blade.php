<aside class="hidden md:block md:col-span-1 overflow-y-auto">
  <nav class="bg-white border border-gray-200 rounded-lg p-4 space-y-2">
    @foreach ($course->sections as $sectionIndex => $section)
    <p class="font-semibold">
      <a href="{{ route('admin.courses.step.show', ['lesson' => $section->lessons->first()->id, 'position' => 1]) }}"
        class="block px-2 py-1.5 rounded-md text-gray-800 transition-colors duration-200 
                  hover:bg-gray-200 hover:text-gray-900 focus:outline-none">
        {{ $sectionIndex + 1 }}. {{ $section->title }}
      </a>
    </p>

    <ul class="ml-4 mt-1 space-y-1">
      @foreach ($section->lessons as $lessonIndex => $lessonItem)
      <li>
        <a href="{{ route('admin.courses.step.show', [$lessonItem->id, 1]) }}"
          class="flex items-center px-2 py-1.5 rounded-md transition-colors duration-200
          {{ $lesson->id === $lessonItem->id 
              ? 'bg-gray-200 text-gray-900 font-semibold' 
              : 'hover:bg-gray-200 hover:text-gray-900 focus:outline-none' }}">
          {{ $sectionIndex + 1 }}.{{ $lessonIndex + 1 }} {{ $lessonItem->title }}
        </a>
      </li>
      @endforeach
    </ul>
    @endforeach
  </nav>
</aside>
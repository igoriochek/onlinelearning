<div class="mx-auto max-w-7xl flex gap-2 py-2 overflow-x-auto">
  @foreach ($lesson->steps->sortBy('position') as $s)
  @php
  $isCompleted = !$isAuthor && in_array($s->id, $completedSteps);
  $isNotCompleted = !$isAuthor && in_array($s->id, $notCompletedSteps);
  if ($isAuthor) {
  $bg = 'bg-gray-200';
  $text = 'text-gray-700';
  } elseif ($isCompleted) {
  $bg = 'bg-green-500';
  $text = 'text-white';
  } elseif ($isNotCompleted) {
  $bg = 'bg-red-500';
  $text = 'text-white';
  } else {
  $bg = 'bg-gray-200';
  $text = 'text-gray-700';
  }
  @endphp
  <a
    href="{{ route('lessons.step.show', ['lesson' => $lesson->id, 'position' => $s->position]) }}"
    class="step-pin flex items-center justify-center w-10 h-10 rounded border-2
           {{ $step->id === $s->id ? 'border-black' : 'border-transparent' }}
           {{ $bg }} {{ $text }}"
    data-step-id="{{ $s->id }}">
    @switch($s->type)
    @case('video')
    <x-icons.video />

    @break
    @case('quiz_code')
    <x-icons.quiz-code />

    @break
    @case('quiz_single')
    @case('quiz_multiple')
    <x-icons.quiz />

    @break
    @case('text')
    <x-icons.text />

    @break
    @default
    @endswitch
  </a>
  @endforeach
</div>
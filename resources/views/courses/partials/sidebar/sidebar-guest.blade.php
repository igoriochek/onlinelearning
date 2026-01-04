<div class="rounded-lg bg-gray-50 p-4 border border-gray-200 space-y-4">
  <p class="text-2xl font-bold">@if($course->price == 0)
    Free
    @else
    ${{ $course->price }}
    @endif
  </p>

  <form action="{{ route('courses.enroll', $course) }}" method="POST">
    @csrf
    <x-primary-button class="w-full justify-center">Enroll</x-primary-button>
  </form>

  @auth
  <x-wishlist-button :course="$course" variant="full" />
  @endauth
</div>
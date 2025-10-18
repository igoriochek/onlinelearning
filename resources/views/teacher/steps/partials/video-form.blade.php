<x-input-label value="Video URL" />
<x-text-input
	type="text"
	name="content_video"
	value="{{ old('content_video') }}"
	class="w-full"
	placeholder="https://www.youtube.com/watch?v=..."
	x-bind:required="type==='video'"
/>
<x-input-error :messages="$errors->get('content_video')" class="mt-1" />

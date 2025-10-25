<x-input-label value="Video URL" />
<x-text-input
	type="text"
	name="content_video"
	x-bind:disabled="stepType !== 'video'"
	class="w-full"
	placeholder="https://www.youtube.com/watch?v=..."
	x-bind:required="stepType==='video'"
	pattern="https?://(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/.+"
/>
<x-input-error :messages="$errors->get('content_video')" class="mt-1" />

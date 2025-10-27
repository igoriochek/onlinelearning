<x-input-label value="Step Content" class="mb-1" />

<textarea
	name="content_text"
	id="content_text"
	class="editor border rounded px-3 py-2 w-full"
	rows="6"
	placeholder="Enter text here..."
	required
>
{{ old('content_text', $content ?? '') }}
</textarea>

<x-input-error :messages="$errors->get('content_text')" class="mt-1" />

<x-input-label value="Step Content" />
<textarea
	name="content_text"
	id="content_text"
	class="editor border rounded px-3 py-2 w-full"
	rows="5"
	placeholder="Enter text here..."
>
{{ old('content_text') }}</textarea
>
<x-input-error :messages="$errors->get('content_text')" class="mt-1" />

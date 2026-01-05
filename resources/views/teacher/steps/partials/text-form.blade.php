<x-input-label :value="__('teacher.step_content')" class="mb-1" />

<textarea
  name="content_text"
  id="content_text"
  class="editor border rounded px-3 py-2 w-full"
  rows="6"
  placeholder="{{ __('teacher.step_content_placeholder') }}"
  required>
{{ old('content_text', $content ?? '') }}
</textarea>

<x-input-error :messages="$errors->get('content_text')" class="mt-1" />
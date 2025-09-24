<div
	class="flex items-center"
	role="img"
	aria-label="{{ $value }} out of 5 stars"
>
	@for ($i = 1; $i <= 5; $i++)
		<x-star :filled="$i <= $value" :size="$size ?? 5" />
	@endfor
</div>

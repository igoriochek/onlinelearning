import Sortable from 'sortablejs';

export function stepReorder(reorderUrl) {
	return {
		init() {
			const el = this.$el;
			new Sortable(el, {
				animation: 150,
				handle: '.cursor-grab',
				onEnd: async () => {
					let order = [];
					el.querySelectorAll('div[data-id]').forEach((el, index) => {
						order.push({ id: el.dataset.id, position: index + 1 });
						const numberSpan = el.querySelector('span.font-semibold');
						if (numberSpan) numberSpan.textContent = '#' + (index + 1);
					});

					try {
						const res = await fetch(reorderUrl, {
							method: 'POST',
							headers: {
								'Content-Type': 'application/json',
								'X-CSRF-TOKEN': document.querySelector(
									"meta[name='csrf-token']",
								).content,
							},
							body: JSON.stringify({ order }),
						});

						if (!res.ok) throw new Error('Network response was not ok');
					} catch (err) {
						console.error('Step reorder failed:', err);
					}
				},
			});
		},
	};
}

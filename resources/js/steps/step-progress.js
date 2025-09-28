export function stepCompletion(stepId, autoCompleteDelay, isCompleted) {
	return {
		init() {
			if (!isCompleted && autoCompleteDelay > 0) {
				setTimeout(() => this.completeStep(), autoCompleteDelay * 1000);
			}
		},
		async completeStep() {
			try {
				const res = await fetch(`/steps/${stepId}/complete`, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
							.content,
						Accept: 'application/json',
					},
					body: JSON.stringify({}),
				});

				if (res.ok) {
					console.log('Step completed', stepId);
					document.dispatchEvent(
						new CustomEvent('stepCompleted', { detail: stepId }),
					);
				}
			} catch (e) {
				console.error(e);
			}
		},
	};
}
document.addEventListener('stepCompleted', (e) => {
	const stepId = e.detail;
	const stepEl = document.querySelector(`.step-pin[data-step-id='${stepId}']`);
	if (stepEl) {
		stepEl.classList.remove('bg-gray-200', 'text-gray-700');
		stepEl.classList.add('bg-green-500', 'text-white');
	}
});

import './bootstrap';

import Alpine from 'alpinejs';
import { stepCompletion } from './steps/step-progress';
import { stepReorder } from './steps/step-reorder';

Alpine.data('stepCompletion', stepCompletion);
Alpine.data('stepReorder', stepReorder);
window.Alpine = Alpine;

Alpine.start();

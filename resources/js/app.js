import './bootstrap';

import Alpine from 'alpinejs';
import { stepCompletion } from './steps/step-progress';

window.Alpine = Alpine;
window.stepCompletion = stepCompletion;

Alpine.start();

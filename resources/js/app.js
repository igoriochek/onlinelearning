import "./bootstrap";

import Alpine from "alpinejs";

import "./table/sort";
import { stepCompletion } from "./steps/step-progress";
import { reorderItems } from "./components/reorder";

Alpine.data("reorderItems", reorderItems);
Alpine.data("stepCompletion", stepCompletion);
window.Alpine = Alpine;

Alpine.start();

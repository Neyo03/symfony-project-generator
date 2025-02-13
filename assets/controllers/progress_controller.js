// assets/controllers/progress_controller.js
import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["step", "line"];
    static values = { currentStep: Number, totalSteps: Number };

    connect() {
        this.updateProgress();
    }

    updateProgress() {
        const currentStep = this.currentStepValue;

        this.stepTargets.forEach((step, index) => {
            const stepNumber = parseInt(step.dataset.step, 10);

            if (stepNumber < currentStep) {
                step.classList.remove("stepsNotCompleted", "stepsNotAccessible");
                step.classList.add("steps");
            } else if (stepNumber === currentStep) {
                step.classList.remove("steps", "stepsNotAccessible");
                step.classList.add("stepsNotCompleted");
            } else {
                step.classList.remove("steps", "stepsNotCompleted");
                step.classList.add("stepsNotAccessible");
            }
        });

        this.lineTargets.forEach((line, index) => {
            if (index < currentStep - 1) {
                line.classList.remove("lineNotCompleted", "lineNotAccessible");
                line.classList.add("line");
            } else if (index === currentStep - 1) {
                line.classList.remove("line", "lineNotAccessible");
                line.classList.add("lineNotCompleted");
            } else {
                line.classList.remove("line", "lineNotCompleted");
                line.classList.add("lineNotAccessible");
            }
        });
    }
}
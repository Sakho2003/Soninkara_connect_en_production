const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const submitBtn = document.querySelector("#submitBtn");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");

let formStepsNum = 0;

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    // Vérifiez la validité des champs avant de passer à l'étape suivante
    if (checkValidity()) {
      formStepsNum++;
      updateFormSteps();
      updateProgressbar();

      // Affichez ou masquez le bouton "Soumettre" en fonction de l'étape
      if (formStepsNum === formSteps.length - 1) {
        submitBtn.style.display = "inline-block";
      } else {
        submitBtn.style.display = "none";
      }
    }
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum--;
    updateFormSteps();
    updateProgressbar();

    // Assurez-vous que le bouton "Soumettre" est masqué lors du retour à une étape précédente
    submitBtn.style.display = "none";
  });
});

function checkValidity() {
  // Vérifie la validité des champs du formulaire de l'étape actuelle
  const currentFormStep = formSteps[formStepsNum];
  const inputFields = currentFormStep.querySelectorAll("input, select");

  for (const field of inputFields) {
    if (field.hasAttribute('required') && !field.value.trim()) {
      // Affichez un message d'erreur ou effectuez toute autre action nécessaire
      alert("Veuillez remplir tous les champs obligatoires.");
      return false;
    }
  }

  return true;
}


function updateFormSteps() {
  formSteps.forEach((step, index) => {
    if (index === formStepsNum) {
      step.classList.add("form-step-active");
    } else {
      step.classList.remove("form-step-active");
    }
  });
}

function updateProgressbar() {
  const progressWidth = (formStepsNum / (formSteps.length - 1)) * 100;
  progress.style.width = `${progressWidth}%`;

  progressSteps.forEach((step, index) => {
    if (index <= formStepsNum) {
      step.classList.add("progress-step-active");
    } else {
      step.classList.remove("progress-step-active");
    }
  });
}

function nextStep() {
  if (formStepsNum < formSteps.length - 1 && checkValidity()) {
    formStepsNum++;
    updateFormSteps();
    updateProgressbar();

    // Affichez ou masquez le bouton "Soumettre" en fonction de l'étape
    if (formStepsNum === formSteps.length - 1) {
      submitBtn.style.display = "inline-block";
    } else {
      submitBtn.style.display = "none";
    }
  }
}

function prevStep() {
  if (formStepsNum > 0) {
    formStepsNum--;
    updateFormSteps();
    updateProgressbar();

    // Assurez-vous que le bouton "Soumettre" est masqué lors du retour à une étape précédente
    submitBtn.style.display = "none";
  }
}

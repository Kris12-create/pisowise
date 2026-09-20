// step 1 form
const passToggleBtn = document.getElementById("togglePassword");
const confirmPassToggleBtn = document.getElementById("toggleConfirmPassword");
const password = document.getElementById("password");
const confirmPass = document.getElementById("confirmPassword");
const passwordRequirements = document.getElementById("password-requirements");
const nextBtn = document.getElementById("nextBtn");
const stepOne = document.getElementById("step1");
const stepTwo = document.getElementById("step2");
const backBtn = document.getElementById("backBtn");
const stepsOne = document.getElementById("stepsOne");
const stepsTwo = document.getElementById("stepsTwo");


passToggleBtn.addEventListener("click", () => {
    if (password.type === "password")
        password.type = "text";
    else
        password.type = "password";
});

confirmPassToggleBtn.addEventListener("click", () => {
    if (confirmPass.type === "password")
        confirmPass.type = "text";
    else
        confirmPass.type = "password";
});

password.addEventListener("focus", () => {
    passwordRequirements.classList.add("show");
});

password.addEventListener("blur", () => {
    passwordRequirements.classList.remove("show");
});

const reqLength = document.getElementById("reqLength");
const reqUpperCase = document.getElementById("reqUppercase");
const reqLowerCase = document.getElementById("reqLowercase");
const reqNumber = document.getElementById("reqNumber");
const reqSymbol = document.getElementById("reqSymbol");

function validatePassword() {
    const passValue = password.value;

    const requirements = [
        [/.{8,}/, reqLength],
        [/[A-Z]/, reqUpperCase],
        [/[a-z]/, reqLowerCase],
        [/[0-9]/, reqNumber],
        [/[!@#$%^&*(),.?":{}|<>]/, reqSymbol]
    ];

    requirements.forEach(([regex, element]) => {
        if (regex.test(passValue)) {
            element.style.color = "#2E7D32";
        } else {
            element.style.color = "#B3261E";
        }
    });
}

function confirmPassword(){
    if(confirmPass.value = password.value){
        
    }
}

password.addEventListener("input", ()=>{
    validatePassword();
});

// step 2 form
const monthlyInput = document.getElementById("monthlyBudget");
const weeklyInput = document.getElementById("weeklyBudget");
const dailyInput = document.getElementById("dailyBudget");

let weeklyTouched = false;
let dailyTouched = false;

weeklyInput.addEventListener("input", () => {
    weeklyTouched = weeklyInput.value !== "";
});

dailyInput.addEventListener("input", () => {
    dailyTouched = dailyInput.value !== "";
});

monthlyInput.addEventListener("input", () => {
    const monthly = parseFloat(monthlyInput.value || 0);

    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth();

    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const weeksInMonth = daysInMonth / 7;

    if (!dailyTouched) {
        dailyInput.value = (monthly / daysInMonth).toFixed(2);
    }
    if (!weeklyTouched) {
        weeklyInput.value = (monthly / weeksInMonth).toFixed(2);
    }
});

nextBtn.addEventListener("click", () => {
    stepOne.style.display = "none";
    stepTwo.style.display = "flex";
    stepsTwo.classList.add("active");
});

backBtn.addEventListener("click", () => {
    stepOne.style.display = "flex";
    stepTwo.style.display = "none";
    stepsTwo.classList.remove("active");
});


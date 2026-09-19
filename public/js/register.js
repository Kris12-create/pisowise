// step 1 form
const passToggleBtn = document.getElementById("togglePassword");
const confirmPassToggleBtn = document.getElementById("toggleConfirmPassword");
const password = document.getElementById("password");
const confirmPass = document.getElementById("confirmPassword");
const passwordRequirements = document.getElementById("password-requirements")

passToggleBtn.addEventListener("click", ()=>{
    if(password.type === "password")
        password.type = "text";
    else
        password.type = "password";
})

confirmPassToggleBtn.addEventListener("click", ()=>{
    if(confirmPass.type === "password")
        confirmPass.type = "text";
    else
        confirmPass.type = "password";
})

password.addEventListener("focus", () =>{
    passwordRequirements.style.display = "block";
});

password.addEventListener("focus", () => {
    passwordRequirements.classList.add("show");
});

password.addEventListener("blur", () => {
    passwordRequirements.classList.remove("show");
});

// step 2 form
const monthlyInput = document.getElementById("monthlyBudget");
const weeklyInput = document.getElementById("weeklyBudget");
const dailyInput = document.getElementById("dailyBudget");
const nextBtn = document.getElementById("nextBtn");
const stepOne = document.getElementById("step1");
const stepTwo = document.getElementById("step2");
const backBtn = document.getElementById("backBtn");

let weeklyTouched = false;
let dailyTouched = false;

weeklyInput.addEventListener("focus", () => { weeklyTouched = true; });
dailyInput.addEventListener("focus", () => { dailyTouched = true; });

monthlyInput.addEventListener("input", () => {
    const monthly = parseFloat(monthlyInput.value || 0);

    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth();

    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const weeksInMonth = daysInMonth/7;

    if (!dailyTouched) {
        dailyInput.value = (monthly / daysInMonth).toFixed(2);
    }   
    if (!weeklyTouched) {
        weeklyInput.value = (monthly / weeksInMonth).toFixed(2);
    }
});

nextBtn.addEventListener("click", () => {
    stepOne.style.display = "none";
    stepTwo.style.display = "flex";   // not "block"
});

backBtn.addEventListener("click", () => {
    stepOne.style.display = "flex";   // matches its CSS display type
    stepTwo.style.display = "none";
});


const stepsOne = document.getElementById("stepsOne");
const stepsTwo = document.getElementById("stepsTwo");

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




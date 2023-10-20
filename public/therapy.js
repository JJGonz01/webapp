function showHideList(listON, listOFF) {
    console.log("completed");
    const objOn = document.getElementById(listON);
    const objOff = document.getElementById(listOFF);
    
    objOn.style.display = "block";
    objOff.style.display = "none";
   
}

function buttonChangeClass(buttonPrimary, buttonSecondary){
    const btPrimary = document.getElementById(buttonPrimary);
    const btSecondary = document.getElementById(buttonSecondary);

    btPrimary.classList.remove("btn-secondary");
    btSecondary.classList.remove("btn-success");
    
    btPrimary.classList.add("btn-success");
    btSecondary.classList.add("btn-secondary");
}
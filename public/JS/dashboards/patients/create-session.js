window.onload = function(){
    selectOneRepeat();

    if(document.getElementById("date-start").content != "none");
        document.getElementById("fecha").value = document.getElementById("date-start").content;
}

function closePopup(){
    document.getElementById("popup").style="display:none;";
}

function selectOneRepeat(){
    var checkboxes = document.getElementsByName("checkbox_repeat");

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('click', function(){
            if(this.checked){
                checkboxes.forEach(function(cb){
                    if(cb !== checkbox){
                        cb.checked = false;
                    }
                });
            }
        });
        document.getElementById("checkbox-repeat").value=checkbox.value;
    });

    
}

function selectOption(selectedButton, buttonsName, inputId){
    var buttons = document.getElementsByName(buttonsName);
    buttons.forEach(button => {
            if(button !== selectedButton){
                button.className = "button-canceled";
            }
    });
    selectedButton.className = "button-selected";
    document.getElementById(inputId).value=selectedButton.value;
}

function closeTherapyPopup(){
    document.getElementById("popup-on").style="display:none;";
}

function openTherapyPopup(){
    document.getElementById("popup-on").style="display:fixed;";
}

function selectTherapy(id, tname){
    console.log(tname);
    document.getElementById("therapy-input").value=id;
    document.getElementById("therapy-name").value=tname;
    closeTherapyPopup();
}

function setCircle(option){
    if(option=="none")
        document.getElementById("blue-circle").className="circulo-negro text-col";
    else
        document.getElementById("blue-circle").className="circulo text-col";

}

function setHourPeriod(option){
    document.getElementById("reloj-hora").innerHTML = option;
}

function setTextPeriod(option){
    document.getElementById("reloj-periodo").innerHTML = option;
}
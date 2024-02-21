

function setEventListenerCheckbox(divId, checkboxId){
    var checkbox = document.getElementById(checkboxId);
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            selectCondition(divId);
        } else {
            deselectCondition(divId);
        }
    });

    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var ids = [];
    for(var i = 1; i < checkboxes.length; i++) {
        if(checkboxes[i].id.includes("ch-") || checkboxes[i].id == "checkbox-accion-secundaria"){
            var checkboxid = checkboxes[i].id;
            checkboxes[i].addEventListener('change', function(index) {
                return function() {
                    if (this.checked) {
                        selectCheckOptions(checkboxes[index].id);
                    } else {
                        deselectCheckOptions(checkboxes[index].id);
                    }
                };
            }(i));
        }
    }
}

function selectCondition(divId) {
    let div = document.getElementById(divId);
    div.className = "row rule-block container-selected";
    var checkboxes = div.querySelectorAll('input[type="checkbox"]');

    for(var i = 1; i < checkboxes.length; i++) {
        checkboxes[i].disabled = false;
        if(checkboxes[i].checked)
            selectCheckOptions(checkboxes[i].id);
        else
            deselectCheckOptions(checkboxes[i].id);
    }
}


function deselectCondition(divId) {
    let div = document.getElementById(divId);
    div.className = "row rule-block container-deselected";
    var checkboxes = div.querySelectorAll('input[type="checkbox"]');

    for(var i = 1; i < checkboxes.length; i++) {
        checkboxes[i].disabled = true;
        deselectCheckOptions(checkboxes[i].id);
    }

}

function deselectCheckOptions(checkid){
    let div = document.getElementById(checkid+"-div");
    var inputs = div.getElementsByTagName('input');
    var selects = div.getElementsByTagName('select');
    var buttons = div.getElementsByTagName('button');

    buttons[0].className = "button-selected";
    for(var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = true;
        buttons[i].className = "button-disabled";
    }

    
    for(var i = 0; i < inputs.length; i++) {
        if(!inputs[i].id.includes("checkbox")) {
            inputs[i].disabled = true;
        }
    }

    for(var i = 0; i < selects.length; i++) {
        selects[i].disabled = true;
    }
}

function selectCheckOptions(checkid){
    let div = document.getElementById(checkid+"-div");
    var inputs = div.getElementsByTagName('input');
    var selects = div.getElementsByTagName('select');
    var buttons = div.getElementsByTagName('button');

    
    for(var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = false;
        buttons[i].className = "button-canceled";
    }

    
    for(var i = 0; i < inputs.length; i++) {
        if(!inputs[i].id.includes("checkbox")) {
            inputs[i].disabled = false;
        }
    }

    for(var i = 0; i < selects.length; i++) {
        selects[i].disabled = false;
    }
}
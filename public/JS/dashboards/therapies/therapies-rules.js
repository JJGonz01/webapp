

function setEventListenerCheckbox(divId, checkboxId){
    var checkbox = document.getElementById(checkboxId);
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            selectCondition(divId);
            console.log('Checkbox is checked');
        } else {
            deselectCondition(divId);
            console.log('Checkbox is unchecked');
        }
    });
}

function selectCondition(divId) {
    let div = document.getElementById(divId);
    div.className = "row rule-block container-selected";
}


function deselectCondition(divId) {
   let div = document.getElementById(divId);
   div.className = "row rule-block container-deselected";
}
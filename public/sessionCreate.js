/*window.addEventListener('DOMContentLoaded', function() {
    const therapyContainer = document.querySelector('.therapy-container');
    booleanButtonClicked = false;
    therapyContainer.addEventListener('wheel', function(event) {
        event.preventDefault();
        therapyContainer.scrollBy(0, event.deltaY);
    });
});*/
var lastClickedButton;
var booleanButtonClicked;
var idSelection;

function selectTerapia(id){
   
    var inputTerapiaId=document.getElementById("terapia_seleccion");
    inputTerapiaId.value = id;
    var buttonstr = "button_"+id;
    setButtonAsSelected(buttonstr); 
    //console.log("hola"+button_id)
}

function setButtonAsSelected(buttonid){
    var div = document.getElementsByName('ther_select');
    var buttonClicked = document.getElementById(buttonid);
    if(booleanButtonClicked){
        lastClickedButton.style = "background-color: #6D9DC5";
    }
    else{
        booleanButtonClicked = true;
    }
    lastClickedButton = buttonClicked;
    buttonClicked.style = "background-color: #3f5e77";
}
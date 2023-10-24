

function navbarStart() {
    const navContainer = document.getElementById("vertical_nv");
        if(!localStorage["navbar"] || localStorage["navbar"]!="true"){//se abre
            localStorage["navbar"] = "false";
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
        }
        else{
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
        }
}  

function navbarButton(){
    const navContainer = document.getElementById("vertical_nv");

        if(localStorage["navbar"]!="true"){//se abre
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
            localStorage["navbar"]="true";
        }
        else{ // se sierra
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
            localStorage["navbar"] = "false";
        }
   
}

function smallNavBarButton(button){
    const navContainer = document.getElementById("vertical_nv");

        if(localStorage["navbar"] != "true"){//se abre
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
            localStorage["navbar"] = "true";
        }
        else{ // se sierra
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
            localStorage["navbar"] = "false";
        }
   
}



function navbarStart() {
    const navContainer = document.getElementById("vertical_nv");
        if(!localStorage["navbar"] || localStorage["navbar"]!="false"){//se abre
            localStorage["navbar"] = "true";
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
        }
        else{
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
        }
}  

function navbarButton(){
    const navContainer = document.getElementById("vertical_nv");
        if(localStorage["navbar"]=="true"){//se abre
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
            localStorage["navbar"]="false";
        }
        else{ // se sierra
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
            localStorage["navbar"] = "true";
        }
}

function smallNavBarButton(button){
    const navContainer = document.getElementById("vertical_nv");

        if(localStorage["navbar"] == "true"){//se abre
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
            localStorage["navbar"] = "false";
        }
        else{ // se sierra
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
            localStorage["navbar"] = "true";
        }
   
}

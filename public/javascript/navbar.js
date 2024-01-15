
function navbarStart() {
    var ids = ["nav_bar_home","nav_bar_patients","nav_bar_therapies","nav_bar_info"];
    var name;
    if( !localStorage["navbar"] || window.location.pathname == "/general" || window.location.pathname == "/HOME" ){
        localStorage["navbar"] = "0";
        name = "General";
    }else if(window.location.pathname == "/patients"){
        localStorage["navbar"] = "1";
        name = "Pacientes";
    }else if(window.location.pathname == "/therapies"){
        localStorage["navbar"] = "2";
        name = "Terapias";
    }else if(window.location.pathname == "/forum"){
        localStorage["navbar"] = "3";
        name = "Ayuda";
    }else if(localStorage["navbar"] == "true" || localStorage["navbar"] == false){
        localStorage["navbar"] = "0";
        name = "General";
    }

    var boton = document.getElementById(ids[parseInt(localStorage["navbar"])]);
    //document.getElementById("navbar_button").classList.add('navbar-menu-selector');
    boton.classList.add('navbar-vertical-selected-button');
    verticalNav = document.getElementById("vertical_nv");

    if(window.innerWidth < 981){
        verticalNav.classList.remove("navbar-vertical"); // Remove the visible class
        verticalNav.classList.add("navbar-vertical-hidden");    // Add the hidden class
        _on = false;
    }
}
    /*
    const navContainer = document.getElementById("vertical_nv");
    if(window.innerWidth >= 981){
        if(!localStorage["navbar"] || localStorage["navbar"]!="false"){//se abre
            localStorage["navbar"] = "true";
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
        }
        else{
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
        }
    }else{
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
            localStorage["navbar"] = "false";
    }
}  */

var _on = false;
function navbarButton(){
    verticalNav = document.getElementById("vertical_nv");
    if (_on) {
        verticalNav.classList.remove("navbar-vertical"); // Remove the visible class
        verticalNav.classList.add("navbar-vertical-hidden");    // Add the hidden class
        _on = false;
    } else {
        verticalNav.classList.remove("navbar-vertical-hidden"); // Remove the hidden class
        verticalNav.classList.add("navbar-vertical");   // Add the visible class
        _on = true;
    }
    
}
    /*
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
*/

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

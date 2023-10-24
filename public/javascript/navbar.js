

function navbarStart() {
    const navContainer = document.getElementById("vertical_nv");
        if(cookiesStr!="true"){//se abre
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
        }
        else{
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
        }
}  

/*
function widthMinStart(){
    const navContainer = document.getElementById("vertical_nv");
    const navButtonSmall = document.getElementById("navbar_button_hor");
    const navButtonBig= document.getElementById("navbar_button");
    
    navButtonSmall.style="display:block";
    navContainer.style="width:15%;display:none;";

    const navText1 = document.getElementById("navbar-1");
    const navText2 = document.getElementById("navbar-2");
    const navText3 = document.getElementById("navbar-3");
    const navText4 = document.getElementById("navbar-4");
    navText1.style="display:none";
    navText2.style="display:none";
    navText3.style="display:none";
    navText4.style="display:none";
    console.log("hasdasdasd")
}

function widthMaxStart(){
    var cookiesStr = getCookie('navbar');
    
    const navButtonSmall = document.getElementById("navbar_button_hor");
    navButtonSmall.style="display:none";

    const navContainer = document.getElementById("vertical_nv");
    const navText1 = document.getElementById("navbar-1");
    const navText2 = document.getElementById("navbar-2");
    const navText3 = document.getElementById("navbar-3");
    const navText4 = document.getElementById("navbar-4");

    const navButtonBig= document.getElementById("navbar_button");
    navButtonBig.style="display:block";


    if(cookiesStr!="true"){
        navContainer.style="width:15%;";

        navText1.style.display = "block";
        navText2.style.display = "block";
        navText3.style.display = "block";
        navText4.style.display = "block";
    }
    else{
        navContainer.style="width:3.5%;";
        navText1.style.display = "none";
        navText2.style.display = "none";
        navText3.style.display = "none";
        navText4.style.display = "none";
    }
    
}
*/

function navbarButton(){
    const navContainer = document.getElementById("vertical_nv");


        if(cookiesStr=="true"){//se abre
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
        }
        else{ // se sierra
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
        }
   
}

function smallNavBarButton(button){
    const navContainer = document.getElementById("vertical_nv");

        if(cookiesStr=="true"){//se abre
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
        }
        else{ // se sierra
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
        }
   
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  function getdivwidth(divElement){
    const divWidth = divElement.offsetWidth;
    return divWidth;
  }
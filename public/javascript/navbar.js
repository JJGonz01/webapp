

function navbarStart() {
    const navContainer = document.getElementById("vertical_nv");
        var cookiesStr = getCookie('navbar');
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
        var cookiesStr = getCookie('navbar');

        if(cookiesStr=="true"){//se abre
            eraseNavBarCookies();
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
        }
        else{ // se sierra
            setNavBarCookies();
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
        }
   
    console.log(getCookie('navbar'));
}

function smallNavBarButton(button){
    const screenWidth = window.innerWidth;
    const navContainer = document.getElementById("vertical_nv");
        var cookiesStr = getCookie('navbar');

        if(cookiesStr=="true"){//se abre
            eraseNavBarCookies();
            navContainer.classList.remove("navbar-vertical");
            navContainer.classList.add("navbar-vertical-closed");
        }
        else{ // se sierra
            setNavBarCookies();
            navContainer.classList.remove("navbar-vertical-closed");
            navContainer.classList.add("navbar-vertical");
        }
   
    console.log(getCookie('navbar'));
}
function eraseNavBarCookies() {
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure the request
    xhr.open('GET', 'cookies_erase.php', true);

    // Set up the callback function
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            //alert('Se comieron las galletas');
        }
    };

    // Send the request
    xhr.send();
}

function setNavBarCookies() {
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure the request
    xhr.open('GET', 'cookies_create.php', true);

    // Set up the callback function
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            //alert('Galletas creadas');
        }
    };

    // Send the request
    xhr.send();
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
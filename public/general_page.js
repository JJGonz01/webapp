var buttonClicked;

function setArticles(numberArt){

    var page_a = document.getElementById('pom_info');
    var page_b = document.getElementById('app_info');
    var page_c = document.getElementById('app_option');

    var btn1 = document.getElementById('btn_pom_info');
    var btn2 = document.getElementById('btn_app_info');
    var btn3 = document.getElementById('btn_nos_option');


    if(numberArt == 0){
        page_a.style = "display:block;";
        page_b.style = "display:none;";
        page_c.style = "display:none;";

        btn1.classList.remove("home-welcome-box-btn");
        btn2.classList.remove("home-welcome-box-btn-selected");
        btn3.classList.remove("home-welcome-box-btn-selected");

        btn1.classList.add("home-welcome-box-btn-selected");
        btn2.classList.add("home-welcome-box-btn");
        btn3.classList.add("home-welcome-box-btn");
    }
    else if(numberArt == 1){
        page_a.style = "display:none;";
        page_b.style = "display:block;";
        page_c.style = "display:none;";

        btn2.classList.remove("home-welcome-box-btn");
        btn1.classList.remove("home-welcome-box-btn-selected");
        btn3.classList.remove("home-welcome-box-btn-selected");

        btn2.classList.add("home-welcome-box-btn-selected");
        btn1.classList.add("home-welcome-box-btn");
        btn3.classList.add("home-welcome-box-btn");
    }else{
        page_a.style = "display:none;";
        page_b.style = "display:none;";
        page_c.style = "display:block;";

        btn3.classList.remove("home-welcome-box-btn");
        btn1.classList.remove("home-welcome-box-btn-selected");
        btn2.classList.remove("home-welcome-box-btn-selected");

        btn3.classList.add("home-welcome-box-btn-selected");
        btn1.classList.add("home-welcome-box-btn");
        btn2.classList.add("home-welcome-box-btn");
    }
}
var filterInd = 0;
function startFilter(){
    var input = document.getElementById("filter-input");
    if(input)
        input.addEventListener("input", filtrarPorNombre);
}
function filtrarPacientes(tipoFiltro) {
    var lista = document.querySelectorAll('.table-items-options tr:not(:first-child)');
    lista.forEach(function (paciente) {
        var datosPaciente = paciente.innerText.toLowerCase();

        // Mostrar u ocultar según el filtro
        if (tipoFiltro === '' || datosPaciente.includes(tipoFiltro.toLowerCase())) {
            paciente.style.display = 'table-row';
            document.getElementById("filter-input").value="";
        } else {
            paciente.style.display = 'none';
        }
    });
}

function sortTable(columnIndex) {
    setArticles(columnIndex);
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.querySelector('.table-items-options');
    switching = true;
    filterInd = columnIndex;
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < rows.length - 1; i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName('td')[columnIndex].textContent.toLowerCase();
            y = rows[i + 1].getElementsByTagName('td')[columnIndex].textContent.toLowerCase();
            if (x > y) {
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

function filtrarPorNombre() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("filter-input");
    filter = input.value.toUpperCase();
    table = document.querySelector('.table-items-options');
    tr = table.getElementsByTagName("tr");
    var all=false;

    if(filterInd == 0){
        all = true;
    }

    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[filterInd];
        
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }

        if(all){
            td2 = tr[i].getElementsByTagName("td")[1];
            td3 = tr[i].getElementsByTagName("td")[2];

            if (td2) {
                txtValue = td2.textContent || td2.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                }
            }

            if (td3) {
                txtValue = td3.textContent || td3.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                }
            }
        }
    }
    
}

var buttonClicked;

function setArticles(numberArt){
    var btn1 = document.getElementById('btn_pom_info');
    var btn2 = document.getElementById('btn_app_info');
    var btn3 = document.getElementById('btn_nos_option');
    
    if(numberArt == 0){
        btn1.classList.remove("home-welcome-box-btn");
        btn2.classList.remove("home-welcome-box-btn-selected");
        btn3.classList.remove("home-welcome-box-btn-selected");

        btn1.classList.add("home-welcome-box-btn-selected");
        btn2.classList.add("home-welcome-box-btn");
        btn3.classList.add("home-welcome-box-btn");
    }
    else if(numberArt == 1){
        console.log("haosda")

        btn2.classList.remove("home-welcome-box-btn");
        btn1.classList.remove("home-welcome-box-btn-selected");
        btn3.classList.remove("home-welcome-box-btn-selected");

        btn2.classList.add("home-welcome-box-btn-selected");
        btn1.classList.add("home-welcome-box-btn");
        btn3.classList.add("home-welcome-box-btn");
    }else{
        btn3.classList.remove("home-welcome-box-btn");
        btn1.classList.remove("home-welcome-box-btn-selected");
        btn2.classList.remove("home-welcome-box-btn-selected");

        btn3.classList.add("home-welcome-box-btn-selected");
        btn1.classList.add("home-welcome-box-btn");
        btn2.classList.add("home-welcome-box-btn");
    }
}

function setTabs(numberArt){

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


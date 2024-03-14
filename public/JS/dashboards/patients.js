function patientSelect(id, dvalor, select){
    let valor = dvalor;
    select.value = "";
    select.innerHtml = "Acciones";
    switch(valor){
        case 'b':
            deleteOpenPopUp(id);
            break;
        case 'e':
            document.getElementById("e"+id).submit();
            break;
    }
}

var idpatientremove; 
function deleteOpenPopUp(idpatient){
    idpatientremove = idpatient;
    document.getElementById("popup-delete").style = "display:fixed";
}

function closeDeletePopUp(){
    document.getElementById("popup-delete").style = "display:none";
}

function finaldelete(){
    document.getElementById("d"+idpatientremove).submit();
}

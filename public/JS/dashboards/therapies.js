function therapySelect(id, dvalor,select){
    let valor = dvalor;
    select.value = "";
    select.innerHtml = "Acciones";
    switch(valor){
        case 'b':
            deleteOpenPopUp(id);
            break;
        case 'e':
            console.log("e"+id)
            document.getElementById("e"+id).submit();
            break;
    }
}
var idremove; 
function deleteOpenPopUp(idther){
    idremove = idther;
    document.getElementById("popup-delete").style = "display:fixed";
}

function closeDeletePopUp(){
    document.getElementById("popup-delete").style = "display:none";
}

function finaldelete(){
    document.getElementById("d"+idremove).submit();
}
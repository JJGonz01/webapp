_permitir_salida = false;

function permitir_salida(bool){
    _permitir_salida = bool

}

window.addEventListener('beforeunload', function (e) {
    if(!_permitir_salida){
        e.preventDefault();
        e.returnValue = '';
        var mensaje = '¿Estás seguro de que deseas salir de la página? Los cambios no se guardarán';
        e.returnValue = mensaje;
        return mensaje;
    } 
  });


function askExitWithoutSave(formid){
    //SCRIPT QUE HACE QUE SALTE EL POPUP PARA CONFIRMAR (LO PONGO AQUI PARA NO CREAR MAS js)
    document.getElementById(formid).addEventListener("submit", (e) => {
        e.preventDefault();
        if(window.confirm("¿Seguro que quiere cerrar la pestaña? Los cambios no se guardarán")){
            document.getElementById(formid).submit();
        }else{
            return false;
        } 
    });
}
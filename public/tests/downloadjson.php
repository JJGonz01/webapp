<?php
   
    $jsonData = obtenerDatos(); // Reemplaza esto con tu lógica para obtener los datos

    $jsonData = json_encode($tests);

    $tempFolderPath = sys_get_temp_dir(); // Obtener el directorio temporal del servidor

    $filename = 'test_' . uniqid() . '.json'; // Generar un nombre de archivo único

    $file_path = $tempFolderPath . '/' . $filename; // Ruta completa hacia el archivo temporal

    if (file_put_contents($file_path, $jsonData) !== false) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        unlink($file_path); // Eliminar el archivo temporal después de la descarga
        exit;
    } else {
        http_response_code(500); // Cambia a un código de error apropiado si es necesario
        // Manejar el error de manera adecuada
    }

    // Función de ejemplo para obtener datos (reemplaza con tu lógica)
    function obtenerDatos() {
        $user = Auth::user();
        $userid = $user->id;
        $tests = Testdata::where('user_id', $userid)->get();
        $jsonData = json_encode($tests[0] ->actions);
        return $jsonData;
    }
?>

<?php
function busquedaestudiante($q) {
    $query = "SELECT * FROM tblresultado WHERE codestudiante LIKE '%$q%' ";
    return $query;
}

function busquedasalon($q) {
    $query = "SELECT * FROM tblconsultasalon WHERE NRC LIKE '%$q%' OR Nombreasignatura LIKE '%$q%'";
    return $query;
}
?>
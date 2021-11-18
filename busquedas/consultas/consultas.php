<?php
    function busquedaestudiante($q) {
        $query = "SELECT * FROM tblconsulta WHERE codestudiante LIKE '%$q%' OR nombreest LIKE '%$q%'";
        return $query;
    }

    function busquedasalon($q) {
        $query = "SELECT * FROM tblconsultasalon WHERE NRC LIKE '%$q%' OR Nombreasignatura LIKE '%$q%'";
        return $query;
    }
?>
<?php
    
    $conn=mysqli_connect ('localhost','root','','test');

    //$NRC=$_POST['NRC'];
    $NRC='8555';

    $activo=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(activoreflexivo) AS ACTIVO FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM tblconsulta WHERE NRC='$NRC') AND activoreflexivo='Activo'"));
    $reflexivo=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(activoreflexivo) AS REFLEXIVO FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM tblconsulta WHERE NRC='$NRC') AND activoreflexivo='Reflexivo'"));
    $sensorial=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(sensorialintuitivo) AS SENSORIAL FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM tblconsulta WHERE NRC='$NRC') AND sensorialintuitivo='Sensorial'"));
    $intuitivo=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(sensorialintuitivo) AS INTUITIVO FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM tblconsulta WHERE NRC='$NRC') AND sensorialintuitivo='Intuitivo'"));
    $visual=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(visualverbal) AS VISUAL FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM tblconsulta WHERE NRC='$NRC') AND visualverbal='Visual'"));
    $verbal=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(visualverbal) AS VERBAL FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM tblconsulta WHERE NRC='$NRC') AND visualverbal='Verbal'"));
    $secuencial=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(secuencialglobal) AS SECUENCIAL FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM tblconsulta WHERE NRC='$NRC') AND secuencialglobal='Secuencial'"));
    $global=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(secuencialglobal) AS GLOBAL FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM tblconsulta WHERE NRC='$NRC') AND secuencialglobal='Global'"));

    //$activo=mysqli_fetch_array(mysqli_query($conn,"CALL SP_REPORTE_AULA_AR('Activo','8555')"));
    //$reflexivo=mysqli_fetch_array(mysqli_query($conn,"CALL SP_REPORTE_AULA_AR('Reflexivo','8555')"));
    //$sensorial=mysqli_fetch_array(mysqli_query($conn,"CALL SP_REPORTE_AULA_SI('Sensorial','8555')"));
    //$intuitivo=mysqli_fetch_array(mysqli_query($conn,"CALL SP_REPORTE_AULA_SI('Intuitivo','8555')"));
    //$visual=mysqli_fetch_array(mysqli_query($conn,"CALL SP_REPORTE_AULA_VV('Visual','8555')"));
    //$verbal=mysqli_fetch_array(mysqli_query($conn,"CALL SP_REPORTE_AULA_VV('Verbal','8555')"));
    //$secuencial=mysqli_fetch_array(mysqli_query($conn,"CALL SP_REPORTE_AULA_SG('Secuencial','8555')"));
    //$global=mysqli_fetch_array(mysqli_query($conn,"CALL SP_REPORTE_AULA_SG('Global','8555')"));


    $data= array(
        array(
            'estilo'=>'Activo',
            'nstudiantes'=>$activo['ACTIVO']),
        array(
            'estilo'=>'Reflexivo',
            'nstudiantes'=>$reflexivo['REFLEXIVO']),
        array(
            'estilo'=>'Sensorial',
            'nstudiantes'=>$sensorial['SENSORIAL']),
        array(
            'estilo'=>'Intuitivo',
            'nstudiantes'=>$intuitivo['INTUITIVO']),
        array(
            'estilo'=>'Visual',
            'nstudiantes'=>$visual['VISUAL']),
        array(
            'estilo'=>'Verbal',
            'nstudiantes'=>$verbal['VERBAL']),
        array(
            'estilo'=>'Secuencial',
            'nstudiantes'=>$secuencial['SECUENCIAL']),
        array(
            'estilo'=>'Global',
            'nstudiantes'=>$global['GLOBAL']));

    echo json_encode($data);
?>

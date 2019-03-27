<?php
include ("functions.php");
//*******************************************************************************************
//********************************* FUNCIONES SELECT ****************************************
//*******************************************************************************************

function selectAlumnosCursoEquipo($DBcon, $cla_id)
{
  $stmt = $DBcon->prepare("SELECT ace.aluclaequ_id, ac.alucla_id, a.alu_id,
                          CONCAT(u.usu_apellido, ' ', u.usu_nombre) AS aluclaequ_nombre,
                          ace.equ_id, e.equ_nombre, ace.rolniv_id, r.rol_id,
                          (CASE
                            WHEN u.usu_genero = 'Masculino' THEN r.rol_nombre_masculino
                            WHEN u.usu_genero = 'Femenino' THEN r.rol_nombre_femenino
                            ELSE 'Sense Assignar'
                            END) AS rol_nombre,
                          n.niv_id, n.niv_nombre, ace.aluclaequ_PV, ace.aluclaequ_PD, ace.aluclaequ_PO,
                          ace.aluclaequ_PP, ace.aluclaequ_PP, ace.aluclaequ_FO, ace.aluclaequ_PO_acc,
                          IFNULL((SELECT p.pri_nombre
                            FROM privilegiosejecutados AS pe
                            INNER JOIN privilegios AS p ON p.pri_id = pe.pri_id
                            WHERE pe.prieje_tipo = 'comprado' AND pe.aluclaequ_id = ace.aluclaequ_id ORDER BY pe.prieje_fecha DESC LIMIT 1), 'Cap') AS aluclaequ_privilegio
                          FROM alumnosclasesequipos AS ace
                          INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                          INNER JOIN alumnos AS a ON a.alu_id = ac.alu_id
                          INNER JOIN usuarios AS u ON u.usu_id = a.usu_id
                          INNER JOIN equipos AS e ON e.equ_id = ace.equ_id
                          INNER JOIN rolesniveles AS rn ON rn.rolniv_id = ace.rolniv_id
                          INNER JOIN roles AS r ON r.rol_id = rn.rol_id
                          INNER JOIN niveles AS n ON n.niv_id = rn.niv_id
                          WHERE ace.aluclaequ_estado = 1 AND ace.alucla_id IN (SELECT alucla_id FROM alumnosclases WHERE cla_id = :cla_id)
                          ORDER BY CONCAT(u.usu_apellido, ' ', u.usu_nombre) ASC");

  $stmt->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);

  try
   {
       $stmt->execute();
   }
   catch(PDOException $e)
   {
       return "ERROR : ".$e->getMessage();
   }

   $datos = json_encode(utf8ize($stmt->fetchAll()));
   return $datos;

  $stmt->closeCursor();
  $stmt = null;
  $DBcon = null;
}

function selectInfoAlumno($DBcon, $aluclaequ_id)
{
  $stmt = $DBcon->prepare("SELECT ace.aluclaequ_id, ac.alucla_id, a.alu_id,
                          CONCAT(u.usu_apellido, ' ', u.usu_nombre) AS aluclaequ_nombre,
                          ace.equ_id, e.equ_nombre, ace.rolniv_id, r.rol_id,
                          (CASE
                            WHEN u.usu_genero = 'Masculino' THEN r.rol_nombre_masculino
                            WHEN u.usu_genero = 'Femenino' THEN r.rol_nombre_femenino
                            ELSE 'Sense Assignar'
                            END) AS rol_nombre,
                          n.niv_id, n.niv_nombre, ace.aluclaequ_PV, ace.aluclaequ_PD, ace.aluclaequ_PO,
                          ace.aluclaequ_PP, ace.aluclaequ_PP, ace.aluclaequ_FO, ace.aluclaequ_PO_acc,
                          IFNULL((SELECT p.pri_nombre
                            FROM privilegiosejecutados AS pe
                            INNER JOIN privilegios AS p ON p.pri_id = pe.pri_id
                            WHERE pe.prieje_tipo = 'comprado' AND pe.aluclaequ_id = ace.aluclaequ_id ORDER BY pe.prieje_fecha DESC LIMIT 1), 'Cap') AS aluclaequ_privilegio
                          FROM alumnosclasesequipos AS ace
                          INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                          INNER JOIN alumnos AS a ON a.alu_id = ac.alu_id
                          INNER JOIN usuarios AS u ON u.usu_id = a.usu_id
                          INNER JOIN equipos AS e ON e.equ_id = ace.equ_id
                          INNER JOIN rolesniveles AS rn ON rn.rolniv_id = ace.rolniv_id
                          INNER JOIN roles AS r ON r.rol_id = rn.rol_id
                          INNER JOIN niveles AS n ON n.niv_id = rn.niv_id
                          WHERE ace.aluclaequ_estado = 1 AND ace.aluclaequ_id = :aluclaequ_id");

  $stmt->bindParam(':aluclaequ_id', $aluclaequ_id, PDO::PARAM_INT);

  try
   {
       $stmt->execute();
   }
   catch(PDOException $e)
   {
       return "ERROR : ".$e->getMessage();
   }

   $datos = json_encode(utf8ize($stmt->fetchAll()));
   return $datos;

  $stmt->closeCursor();
  $stmt = null;
  $DBcon = null;
}

function selectNivelPP($DBcon, $PP)
{
  $stmt = $DBcon->prepare("SELECT niv_id, niv_nombre
                          FROM niveles AS n
                          WHERE n.niv_PP <=  :niv_PP
                          ORDER BY niv_id DESC
                          LIMIT 1");

  $stmt->bindParam(':niv_PP', $PP, PDO::PARAM_INT);

  try
   {
       $stmt->execute();
   }
   catch(PDOException $e)
   {
       return "ERROR : ".$e->getMessage();
   }

   $datos = json_encode(utf8ize($stmt->fetchAll()));
   return $datos;

  $stmt->closeCursor();
  $stmt = null;
  $DBcon = null;
}

//*******************************************************************************************
//********************************* FUNCIONES INSERT ****************************************
//*******************************************************************************************
function insertLogProfesor($DBcon, $aluclaequ_id, $log_tipo, $log_PV, $log_PD, $log_PO, $log_PP, $log_FO, $log_descripcion)
{
  $stmt = $DBcon->prepare("INSERT INTO logprofesor (aluclaequ_id, log_tipo, log_PV, log_PD, log_PO, log_PP, log_FO, log_descripcion)
                            VALUES(:aluclaequ_id, :log_tipo, :log_PV, :log_PD, :log_PO, :log_PP, :log_FO, :log_descripcion);");
                            $stmt->bindParam(':log_PV', $log_PV, PDO::PARAM_INT);
                            $stmt->bindParam(':log_PD', $log_PD, PDO::PARAM_INT);
                            $stmt->bindParam(':log_PO', $log_PO, PDO::PARAM_INT);
                            $stmt->bindParam(':log_PP', $log_PP, PDO::PARAM_INT);
                            $stmt->bindParam(':log_FO', $log_FO, PDO::PARAM_INT);
                            $stmt->bindParam(':log_descripcion', $log_descripcion, PDO::PARAM_STR);
                            $stmt->bindParam(':log_tipo', $log_tipo, PDO::PARAM_STR);
                            $stmt->bindParam(':aluclaequ_id', $aluclaequ_id, PDO::PARAM_INT);

  if ($stmt->execute()) {
    return "true";
  } else {
    return "false";
  }

  $stmt->closeCursor();
  $stmt = null;
  $DBcon = null;
}

function insertLogProfesorEquipo($DBcon, $log_tipo, $log_PV, $log_PD, $log_PO, $log_PP, $log_FO, $log_descripcion, $equ_id)
{
  $stmt = $DBcon->prepare("INSERT INTO logprofesor (aluclaequ_id, log_tipo, log_PV, log_PD, log_PO, log_PP, log_FO, log_descripcion)
                            SELECT ace.aluclaequ_id, :log_tipo, :aluclaequ_equPV, :aluclaequ_equPD, :aluclaequ_equPO, :aluclaequ_equPP, :aluclaequ_equFO, :log_descripcion
                            FROM alumnosclasesequipos AS ace
                            INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                            INNER JOIN alumnos AS a ON a.alu_id = ac.alu_id
                            INNER JOIN usuarios AS u ON u.usu_id = a.usu_id
                            INNER JOIN equipos AS e ON e.equ_id = ace.equ_id
                            WHERE ace.aluclaequ_estado = 1 AND ace.equ_id = :equ_id;");

  $stmt->bindParam(':log_tipo', $log_tipo, PDO::PARAM_STR);
  $stmt->bindParam(':aluclaequ_equPV', $log_PV, PDO::PARAM_STR);
  $stmt->bindParam(':aluclaequ_equPD', $log_PD, PDO::PARAM_STR);
  $stmt->bindParam(':aluclaequ_equPO', $log_PO, PDO::PARAM_STR);
  $stmt->bindParam(':aluclaequ_equPP', $log_PP, PDO::PARAM_STR);
  $stmt->bindParam(':aluclaequ_equFO', $log_FO, PDO::PARAM_STR);
  $stmt->bindParam(':log_descripcion', $log_descripcion, PDO::PARAM_STR);
  $stmt->bindParam(':equ_id', $equ_id, PDO::PARAM_INT);;

  if ($stmt->execute()) {
    return "true";
  } else {
    return "false";
  }

  $stmt->closeCursor();
  $stmt = null;
  $DBcon = null;
}

function insertLogHistorialPuntos($DBcon, $aluclaequ_id)
{
  $stmt = $DBcon->prepare("INSERT INTO logprofesor (aluclaequ_id, log_tipo, log_PV, log_PD, log_PO, log_PP, log_FO)
                            SELECT aluclaequ_id, 'historialpuntos', aluclaequ_PV, aluclaequ_PD, aluclaequ_PO, aluclaequ_PP, aluclaequ_FO
                            FROM alumnosclasesequipos
                            WHERE aluclaequ_id = :aluclaequ_id;");
                            $stmt->bindParam(':aluclaequ_id', $aluclaequ_id, PDO::PARAM_INT);

  if ($stmt->execute()) {
    return "true";
  } else {
    return "false";
  }

  $stmt->closeCursor();
  $stmt = null;
  $DBcon = null;
}

function insertActuacionesEjecutadas($DBcon, $act_id, $aluclaequ_id)
{
  $stmt = $DBcon->prepare("INSERT INTO actuacionesejecutadas (act_id, aluclaequ_id)
                          VALUES(:act_id, :aluclaequ_id)");

                          $stmt->bindParam(':aluclaequ_id', $aluclaequ_id, PDO::PARAM_STR);
                          $stmt->bindParam(':act_id', $act_id, PDO::PARAM_STR);

  if ($stmt->execute()) {
    return 'true';
  } else {
    return 'false';
  }

  $stmt->closeCursor();
  $stmt = null;
  $DBcon = null;
}

//*******************************************************************************************
//********************************* FUNCIONES UPDATE ****************************************
//*******************************************************************************************
function sumarPuntosAlumno($DBcon, $aluclaequ_aluPV, $aluclaequ_aluPD, $aluclaequ_aluPO, $aluclaequ_aluPP, $aluclaequ_aluFO, $aluclaequ_id)
{
  $stmt = $DBcon->prepare("UPDATE alumnosclasesequipos
                            SET
                                aluclaequ_PV = CASE
                                                    WHEN  (aluclaequ_PV + :aluclaequ_aluPV) < 0 THEN 0
                                                    WHEN  (aluclaequ_PV + :aluclaequ_aluPV) > 100 THEN 100
                                                    ELSE (aluclaequ_PV + :aluclaequ_aluPV)
                                                    END,
                                aluclaequ_PD = CASE
                                                    WHEN  (aluclaequ_PD + :aluclaequ_aluPD) < 0 THEN 0
                                                    WHEN  (aluclaequ_PD + :aluclaequ_aluPD) > 100 THEN 100
                                                    ELSE (aluclaequ_PD + :aluclaequ_aluPD)
                                                    END,
                                aluclaequ_PO = CASE
                                                    WHEN  (aluclaequ_PO + :aluclaequ_aluPO) < 0 THEN 0
                                                    ELSE (aluclaequ_PO + :aluclaequ_aluPO)
                                                    END,
                                aluclaequ_PP = CASE
                                                    WHEN  (aluclaequ_PP + :aluclaequ_aluPP) < 0 THEN 0
                                                    ELSE (aluclaequ_PP + :aluclaequ_aluPP)
                                                    END,
                                aluclaequ_FO = CASE
                                                    WHEN  (aluclaequ_FO + :aluclaequ_aluFO) < 0 THEN 0
                                                    ELSE (aluclaequ_FO + :aluclaequ_aluFO)
                                                    END,
                                aluclaequ_PO_acc = CASE
                                                    WHEN :aluclaequ_aluPO > 0 THEN (aluclaequ_PO_acc + :aluclaequ_aluPO)
                                                    ELSE aluclaequ_PO_acc
                                                    END
                            WHERE aluclaequ_id = :aluclaequ_id;");

                            $stmt->bindParam(':aluclaequ_aluPV', $aluclaequ_aluPV, PDO::PARAM_INT);
                            $stmt->bindParam(':aluclaequ_aluPD', $aluclaequ_aluPD, PDO::PARAM_INT);
                            $stmt->bindParam(':aluclaequ_aluPO', $aluclaequ_aluPO, PDO::PARAM_INT);
                            $stmt->bindParam(':aluclaequ_aluPP', $aluclaequ_aluPP, PDO::PARAM_INT);
                            $stmt->bindParam(':aluclaequ_aluFO', $aluclaequ_aluFO, PDO::PARAM_INT);
                            $stmt->bindParam(':aluclaequ_id', $aluclaequ_id, PDO::PARAM_INT);

  if ($stmt->execute()) {
    return 'true';
  } else {
    return 'false';
  }

  $stmt->closeCursor();
  $stmt = null;
  $DBcon = null;
}

function sumarPuntosEquipo($DBcon, $aluclaequ_equPV, $aluclaequ_equPD, $aluclaequ_equPO, $aluclaequ_equPP, $aluclaequ_equFO, $equ_id)
{
  $stmt = $DBcon->prepare("UPDATE alumnosclasesequipos
                            SET aluclaequ_PV = CASE
                                                    WHEN  (aluclaequ_PV + :aluclaequ_equPV) < 0 THEN 0
                                                    WHEN  (aluclaequ_PV + :aluclaequ_equPV) > 100 THEN 100
                                                    ELSE (aluclaequ_PV + :aluclaequ_equPV)
                                                    END,
                                aluclaequ_PD = CASE
                                                    WHEN  (aluclaequ_PD + :aluclaequ_equPD) < 0 THEN 0
                                                    WHEN  (aluclaequ_PD + :aluclaequ_equPD) > 100 THEN 100
                                                    ELSE (aluclaequ_PD + :aluclaequ_equPD)
                                                    END,
                                aluclaequ_PO = CASE
                                                    WHEN  (aluclaequ_PO + :aluclaequ_equPO) < 0 THEN 0
                                                    ELSE (aluclaequ_PO + :aluclaequ_equPO)
                                                    END,
                                aluclaequ_PP = CASE
                                                    WHEN  (aluclaequ_PP + :aluclaequ_equPP) < 0 THEN 0
                                                    ELSE (aluclaequ_PP + :aluclaequ_equPP)
                                                    END,
                                aluclaequ_FO = CASE
                                                    WHEN  (aluclaequ_FO + :aluclaequ_equFO) < 0 THEN 0
                                                    ELSE (aluclaequ_FO + :aluclaequ_equFO)
                                                    END
                            WHERE aluclaequ_estado = 1 AND equ_id = :equ_id;");

                            $stmt->bindParam(':aluclaequ_equPV', $aluclaequ_equPV, PDO::PARAM_STR);
                            $stmt->bindParam(':aluclaequ_equPD', $aluclaequ_equPD, PDO::PARAM_STR);
                            $stmt->bindParam(':aluclaequ_equPO', $aluclaequ_equPO, PDO::PARAM_STR);
                            $stmt->bindParam(':aluclaequ_equPP', $aluclaequ_equPP, PDO::PARAM_STR);
                            $stmt->bindParam(':aluclaequ_equFO', $aluclaequ_equFO, PDO::PARAM_STR);
                            $stmt->bindParam(':equ_id', $equ_id, PDO::PARAM_INT);

  if ($stmt->execute()) {
    return 'true';
  } else {
    return 'false';
  }

  $stmt->closeCursor();
  $stmt = null;
  $DBcon = null;
}

function updatePP($DBcon, $aluclaequ_PP, $aluclaequ_id)
{
  $stmt = $DBcon->prepare("UPDATE alumnosclasesequipos
                            SET aluclaequ_PP = :aluclaequ_PP
                            WHERE aluclaequ_id = :aluclaequ_id;");

                            $stmt->bindParam(':aluclaequ_PP', $aluclaequ_PP, PDO::PARAM_INT);
                            $stmt->bindParam(':aluclaequ_id', $aluclaequ_id, PDO::PARAM_INT);

  if ($stmt->execute()) {
    return 'true';
  } else {
    return 'false';
  }

  $stmt->closeCursor();
  $stmt = null;
  $DBcon = null;
}

function updateNivelAlumno($DBcon, $aluclaequ_id, $rol_id, $niv_id)
{
  $stmt = $DBcon->prepare("UPDATE alumnosclasesequipos ace,
                                    (SELECT rolniv_id, rolniv_PV, rolniv_PD, rolniv_PO, rolniv_PP, rolniv_FO
                                      FROM rolesniveles
                                      WHERE rol_id = :rol_id AND niv_id = :niv_id) rn
                                  SET ace.rolniv_id = rn.rolniv_id
                                  WHERE ace.aluclaequ_id = :aluclaequ_id ");

  $stmt->bindParam(':aluclaequ_id', $aluclaequ_id, PDO::PARAM_STR);
  $stmt->bindParam(':rol_id', $rol_id, PDO::PARAM_STR);
  $stmt->bindParam(':niv_id', $niv_id, PDO::PARAM_STR);

  if ($stmt->execute()) {
    return 'true';
  } else {
    return 'false';
  }

  $stmt->closeCursor();
  $stmt = null;
  $DBcon = null;
}
?>

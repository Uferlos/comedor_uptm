<?php
include '../config.php';

class Asistencia{
	private $fecha;
	private $carnet;
	private $ced;
	private $db;

	public function __construct($fecha, $carnet, $ced, $db){
		$this->fecha = $fecha;
		$this->carnet = $carnet;
		$this->ced = $ced;
		$this->db = $db;
	}

	public function Add(){
		date_default_timezone_set('America/Caracas');
		$week = date('W');
		$month = date('m');
		$aday = date('l');

		$sideQ = "SELECT * FROM registro WHERE carnet = '$this->carnet'";
		$sideRes = $this->db->query($sideQ);

		$sideRow = $sideRes->fetch_assoc();
		$dia = explode(' - ', $sideRow['dias']);
		$arr = array();
		
		for($i = 0; $i < count($dia); $i++){
			if($dia[$i] == 'lunes'){$arr[$i] = 'Monday';}
			elseif($dia[$i] == 'martes'){$arr[$i] = 'Tuesday';}
			elseif($dia[$i] == 'miercoles'){$arr[$i] = 'Wednesday';}
			elseif($dia[$i] == 'jueves'){$arr[$i] = 'Thursday';}
			elseif($dia[$i] == 'viernes'){$arr[$i] = 'Friday';}
		}
		
		for($j = 0; $j < count($arr); $j++){
			if($aday == $arr[$j]){
				$grant = 1;
				break;
			}
			else{
				$grant = 0;
			}
		}
		
		if($sideRes->num_rows && $grant == 1):
			
			$query = "INSERT INTO asistencia VALUES(null, '$this->carnet', '$this->fecha', '$week', '$month')";
			if($this->db->query($query)): ?>
				<script>
					alert('¡Registrado!')
				</script><?php
			else: ?>
				<script>
					alert("Error <?php echo $this->db->error; ?>")
				</script><?php
			endif;
		elseif($sideRes->num_rows && $grant == 0): ?>
			<script>
				alert('El estudiante no tiene acceso al comedor el dia de hoy')
			</script><?php
		else: ?>
			<script>
				alert('El estudiante no esta registrado en el servicio del comedor')
			</script><?php
		endif;		
	}

	public function AddC(){
		date_default_timezone_set('America/Caracas');
		$week = date('W');
		$month = date('m');
		$aday = date('l');

		$sideQ = "SELECT * FROM registroC WHERE ced = '$this->ced'";
		$sideRes = $this->db->query($sideQ);

		$sideRow = $sideRes->fetch_assoc();
		$dia = explode(' - ', $sideRow['dias']);
		$arr = array();
		
		for($i = 0; $i < count($dia); $i++){
			if($dia[$i] == 'lunes'){$arr[$i] = 'Monday';}
			elseif($dia[$i] == 'martes'){$arr[$i] = 'Tuesday';}
			elseif($dia[$i] == 'miercoles'){$arr[$i] = 'Wednesday';}
			elseif($dia[$i] == 'jueves'){$arr[$i] = 'Thursday';}
			elseif($dia[$i] == 'viernes'){$arr[$i] = 'Friday';}
		}
		
		for($j = 0; $j < count($arr); $j++){
			if($aday == $arr[$j]){
				$grant = 1;
				break;
			}
			else{
				$grant = 0;
			}
		}
		
		if($sideRes->num_rows && $grant == 1):
			
			$query = "INSERT INTO asistenciaC VALUES(null, '$this->ced', '$this->fecha', '$week', '$month')";
			if($this->db->query($query)): ?>
				<script>
					alert('¡Registrado!')
				</script><?php
			else: ?>
				<script>
					alert("Error <?php echo $this->db->error; ?>")
				</script><?php
			endif;
		elseif($sideRes->num_rows && $grant == 0): ?>
			<script>
				alert('El docente no tiene acceso al comedor el dia de hoy')
			</script><?php
		else: ?>
			<script>
				alert('El docente no esta registrado en el servicio del comedor')
			</script><?php
		endif;		
	}
}

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
	echo $db->connect_error;
	exit();
}

$fecha = isset($_POST['dd']) ? $_POST['dd'] : '';
$carnet = isset($_POST['ct']) ? $_POST['ct'] : '';
$ced = isset($_POST['ced']) ? $_POST['ced'] : '';
$orden = isset($_POST['orden']) ? $_POST['orden'] : '';

$obj = new Asistencia($fecha, $carnet, $ced, $db);

switch ($orden) {
	case 'add':
		$obj->Add();
		break;
	case 'addC':
		$obj->AddC();
		break;
	default:
		echo "Sin orden";
		break;
}
?>
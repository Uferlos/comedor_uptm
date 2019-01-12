<?php
include '../config.php';

class Main{
	private $pnfN;
	private $pnfCT;
	private $days;
	private $carnet;
	private $ced;
	private $aux;
	private $db;

	public function __construct($pnfN, $pnfCT, $days, $carnet, $ced, $aux, $db){
		$this->pnfN = $pnfN;
		$this->pnfCT = $pnfCT;
		$this->days = implode(' - ', $days);
		$this->carnet = $carnet;
		$this->ced = $ced;
		$this->aux = $aux;
		$this->db = $db;
	}

	public function AddPnf(){
		$query = "INSERT INTO pnf VALUES(null, '$this->pnfN', '$this->pnfCT')";
		if($this->db->query($query)): ?>
			<script>
				alert('¡PNF registrado con exito!')
				$('#main').click()
			</script>
		<?php else: ?>
			<script>
				alert("Error al registrar <?php echo $this->db->error ?>")
			</script>
		<?php endif;
	}

	public function addReg(){
		$query = "INSERT INTO registro VALUES(null, '$this->carnet', '$this->days', 0)";
		
		if($this->db->query($query)): ?>
			<script>
				alert('¡Usuario registrado con exito!')
			</script>
		<?php 
		$qr = "UPDATE estudiante SET reg = 'si' WHERE carnet = '$this->carnet'";
		$this->db->query($qr);
		else: ?>
			<script>
				alert("Error al registrar <?php echo $this->db->error ?>")
			</script>
		<?php endif;
	}

	public function addRegC(){
		$query = "INSERT INTO registroC VALUES(null, '$this->ced', '$this->days', 0)";
		
		if($this->db->query($query)): ?>
			<script>
				alert('¡Usuario registrado con exito!')
			</script>
		<?php 
		$qr = "UPDATE docente SET reg = 'si' WHERE ced = '$this->ced'";
		$this->db->query($qr);
		else: ?>
			<script>
				alert("Error al registrar <?php echo $this->db->error ?>")
			</script>
		<?php endif;
	}

	public function delPnf(){
		$query = "DELETE FROM pnf WHERE id = '$this->aux'";
		if($this->db->query($query)): ?>
			<script>
				alert('¡PNF eliminado!')
			</script>
		<?php else: ?>
			<input type="hidden" id="err_cod" value="<?php echo $this->db->errno ?>">
      <script>
        if (document.getElementById('err_cod').value === '1062'){
          alert ('¡Ya existe un PNF con este nombre!');
        }else{
					alert("Error al eliminar <?php echo $this->db->error ?>")
				}
			</script><?php
		endif;
	}

	public function editPnf(){
		$query = "UPDATE pnf SET nom = '$this->pnfN', cterm = '$this->pnfCT' WHERE id = '$this->aux'";
		if($this->db->query($query)): ?>
			<script>
				alert('¡PNF actualizado con exito!')
			</script>
		<?php else: ?>
			<script>
				alert("Error al actualizar <?php echo $this->db->error ?>")
			</script>
		<?php endif;
	}

	public function editRegDays(){
		$query = "UPDATE registro SET dias = '$this->days' WHERE id = '$this->aux'";
		if($this->db->query($query)): ?>
			<script>
				alert('¡Días actualizados con exito!')
			</script>
		<?php else: ?>
			<script>
				alert("Error al actualizar <?php echo $this->db->error ?>")
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

$pnfN = isset($_POST['pnfNom']) ? $_POST['pnfNom'] : '';
$pnfCT = isset($_POST['cterm']) ? $_POST['cterm'] : '';
$days = isset($_POST['days']) ? $_POST['days'] : array('' => '');
$carnet = isset($_POST['carnet']) ? $_POST['carnet'] : '';
$ced = isset($_POST['ced']) ? $_POST['ced'] : '';
$aux = isset($_POST['aux']) ? $_POST['aux'] : '';
$orden = isset($_POST['orden']) ? $_POST['orden'] : '';

$obj = new Main($pnfN, $pnfCT, $days, $carnet, $ced, $aux, $db);

switch ($orden) {
	case 'addPnf':
		$obj->addPnf();
		break;
	case 'updPnf':
		$obj->editPnf();
		break;
	case 'delPnf':
		$obj->delPnf();
		break;
	case 'addReg':
		$obj->addReg();
		break;
	case 'addRegC':
		$obj->addRegC();
		break;
	case 'updRegEst':
		$obj->editRegDays();
		break;
	default:
		echo "No hay orden";
		break;
}
?>
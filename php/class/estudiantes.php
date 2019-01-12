<?php
include '../config.php';

class Estudiantes{
	private $nom;
	private $ape;
	private $ci;
	private $carnet;
	private $pnf;
	private $nac;
	private $seccion;
	private $trayecto;
	private $db;
	private $aux;

	public function __construct($nom, $ape, $ci, $carnet, $pnf, $nac, $seccion, $trayecto, $db, $aux){
		$this->nom = $nom;
		$this->ape = $ape;
		$this->ci = $ci;
		$this->carnet = $carnet;
		$this->pnf = $pnf;
		$this->nac = $nac;
		$this->seccion = $seccion;
		$this->trayecto = $trayecto;
		$this->db = $db;
		$this->aux = $aux;
	}

	public function Insert(){
		$query = "INSERT INTO estudiante VALUES('$this->nom', '$this->ape', '$this->ci', '$this->nac', '$this->carnet', '$this->pnf', '$this->trayecto', '$this->seccion', 'no')";
		if($this->db->query($query)): ?>
			<script type="text/javascript">
				alert('¡Registro Exitoso!')
			</script><?php
		else: ?>
			<input type="hidden" value="<?php echo $this->db->errno ?>" id="codigo">
	    <script type="text/javascript">
    		if(document.getElementById('codigo').value === '1062') {
    			alert('¡El estudiante que intenta registrar ya existe en el sistema!')
    		}else{
					alert("¡Error al registrar! <?php echo $this->db->error; ?>")
    		}
			</script><?php
		endif;
	}

	public function Delete(){
    $query = "DELETE FROM estudiante WHERE cedula = '$this->aux'";
    if ($this->db->query($query)): ?>
      <script>
        alert('Registro Borrado');
      </script>
    <?php else : ?>
      <script>
        alert("Error al Borrar <?php echo $this->db->error; ?>");
      </script>
    <?php endif;
  }

  public function Update(){
  	$query = "UPDATE estudiante SET
  	 nombre = '$this->nom',
  	 apellido = '$this->ape',
  	 cedula = '$this->ci',
  	 nacionalidad = '$this->nac',
  	 carnet = '$this->carnet',
  	 carrera = '$this->pnf',
  	 trayecto = '$this->trayecto',
  	 seccion = '$this->seccion'
  	 WHERE cedula = '$this->aux'";

  	 if($this->db->query($query)): ?>
  	 	<script>
  	 		alert('¡Datos actualizados!')
  	 	</script>
  	<?php else: ?>
  		<script>
  			alert("Error <?php echo $this->db->error; ?>");
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

$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$ape = isset($_POST['ape']) ? $_POST['ape'] : '';
$ci = isset($_POST['ci']) ? $_POST['ci'] : '';
$carnet = isset($_POST['carnet']) ? $_POST['carnet'] : '';
$pnf = isset($_POST['pnf']) ? $_POST['pnf'] : '';
$nac = isset($_POST['nac']) ? $_POST['nac'] : '';
$seccion = isset($_POST['secc']) ? $_POST['secc'] : '';
$trayecto = isset($_POST['tray']) ? $_POST['tray'] : '';
$aux = isset($_POST['aux']) ? $_POST['aux'] : '';
$orden = isset($_POST['orden']) ? $_POST['orden'] : '';

$obj = new Estudiantes($nom, $ape, $ci, $carnet, $pnf, $nac, $seccion, $trayecto, $db, $aux);

switch ($orden) {
	case 'add':
		$obj->Insert();
		break;
	case 'del':
		$obj->Delete();
		break;
	case 'upd':
		$obj->Update();
		break;
	default:
		echo "No hay orden a ejecutar";
		break;
}
?>
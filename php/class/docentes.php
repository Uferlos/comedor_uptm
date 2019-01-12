<?php
include '../config.php';

class Docentes{
	private $nom;
	private $ape;
	private $ci;
	private $tlf;
	private $db;
	private $aux;

	public function __construct($nom, $ape, $ci, $tlf, $db, $aux){
		$this->nom = $nom;
		$this->ape = $ape;
		$this->ci = $ci;
		$this->tlf = $tlf;
		$this->db = $db;
		$this->aux = $aux;
	}

	public function Insert(){
		$query = "INSERT INTO docente VALUES('$this->nom', '$this->ape', '$this->ci', '$this->tlf', 'no')";
		if($this->db->query($query)): ?>
			<script type="text/javascript">
				alert('¡Registro Exitoso!')
			</script><?php
		else: ?>
			<input type="hidden" value="<?php echo $this->db->errno ?>" id="codigo">
	    <script type="text/javascript">
    		if(document.getElementById('codigo').value === '1062') {
    			alert('¡El docente que intenta registrar ya existe en el sistema!')
    		}else{
					alert("¡Error al registrar! <?php echo $this->db->error; ?>")
    		}
			</script><?php
		endif;
	}

	public function Delete(){
    $query = "DELETE FROM docente WHERE ced = '$this->aux'";
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
  	$query = "UPDATE docente SET
  	 nom = '$this->nom',
  	 ape = '$this->ape',
  	 ced = '$this->ci',
  	 tlf = '$this->tlf'
  	 WHERE ced = '$this->aux'";

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
$tlf = isset($_POST['tlf']) ? $_POST['tlf'] : '';
$aux = isset($_POST['aux']) ? $_POST['aux'] : '';
$orden = isset($_POST['orden']) ? $_POST['orden'] : '';

$obj = new Docentes($nom, $ape, $ci, $tlf, $db, $aux);

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
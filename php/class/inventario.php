<?php
include '../config.php';

class Inventario{
	private $nom;
	private $cant;
	private $fecha;
	private $con;
	private $id_inv;
	private $aux;
	private $db;

	public function __construct($nom, $cant, $fecha, $con, $id_inv, $aux, $db){
		$this->nom = $nom;
		$this->cant = $cant;
		$this->fecha = $fecha;
		$this->con = $con;
		$this->id_inv = $id_inv;
		$this->aux = $aux;
		$this->db = $db;
	}

	public function Insert(){
    $rg = 0;
    for($c = 0; $c < $this->con; $c++):
      $query = "INSERT INTO inventario VALUES(null, '{$this->nom[$c]}', '{$this->cant[$c]}', '$this->fecha')";
  		if($this->db->query($query)): 
        $rg++;
      else : ?>
        <input type="hidden" id="err_cod" value="<?php echo $this->db->errno ?>">
        <script>
          if (document.getElementById('err_cod').value === '1062'){
            alert ('Ya Registro este ingrediente');
          }else{
            alert("Error al procesar <?php echo $this->db->error ?>")
          }
        </script>
      <?php endif;
    endfor; ?>
    <script>
      alert('<?php echo $rg; ?> Ingredientes registrados')
    </script><?php
	}

	public function Update(){
  	$query = "UPDATE inventario SET
  	 nom = '$this->nom',
  	 cant = '$this->cant'
  	 WHERE id = '$this->aux'";

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

  public function Delete(){
    $query = "DELETE FROM inventario WHERE id = '$this->aux'";
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

  public function toUse(){
  	$rg = 0;
    for($c = 0; $c < $this->con; $c++):
      $select = "SELECT nom, cant FROM inventario WHERE id = '{$this->id_inv[$c]}'";
      $res = $this->db->query($select);
      $row = $res->fetch_assoc();
      if(intval($row['cant']) < $this->cant[$c]): ?>
        <script>
          alert('No hay suficiente cantidad de <?php echo $row["nom"] ?> en inventario, disponible <?php echo $row["cant"] ?>');
          $('#cant_'+<?php echo $c ?>).val('').focus();
        </script><?php
        exit();
      else:
        $query = "INSERT INTO usoInventario VALUES(null,
        '{$this->cant[$c]}', now(), '{$this->id_inv[$c]}')";
        
        if($this->db->query($query)): 
          $rg++;
          $trigger = "UPDATE inventario SET cant = (inventario.cant - '{$this->cant[$c]}') WHERE id = '{$this->id_inv[$c]}'";
          $this->db->query($trigger);
        else : ?>
          <script>
            alert("Error al procesar <?php echo $this->db->error ?>");
          </script>
        <?php endif;
      endif;
    endfor; ?>
    <script>
      alert('<?php echo $rg; ?> Ingredientes registrados')
	    window.location.reload()
    </script><?php
  }
}

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
	echo $db->connect_error;
	exit();
}

$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$cant = isset($_POST['cant']) ? $_POST['cant'] : array('', '');;
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$aux = isset($_POST['aux']) ? $_POST['aux'] : '';
$orden = isset($_POST['orden']) ? $_POST['orden'] : '';
$con = isset($_POST['count']) ? $_POST['count'] : 0;
$id_inv = isset($_POST['id_inv']) ? $_POST['id_inv'] : array('', '');;

$obj = new Inventario($nom, $cant, $fecha, $con, $id_inv, $aux, $db);

switch ($orden) {
	case 'insert':
		$obj->Insert();
		break;
	case 'upd':
		$obj->Update();
		break;
	case 'del':
		$obj->Delete();
		break;
	case 'dis':
		$obj->toUse();
		break;
	default:
		echo "Sin orden";
		break;
}
?>
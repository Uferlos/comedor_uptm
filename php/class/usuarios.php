<?php 
include '../config.php';

class Usuario{

	private $pass;
	private $nusu;
	private $nom;
	private $ape;
	private $tlf;
	private $mail;
	private $tipo;
	private $ask;
	private $res;
	private $oldP;
	private $currP;
	private $rPass;
	private $aux;
	private $db;

	public function __construct($pass, $nusu, $nom, $ape, $tlf, $mail, $tipo, $ask, $res, $oldP, $currP, $rPass, $aux, $db){

		$this->pass = $pass;
		$this->nusu = $nusu;
		$this->nom = $nom;
		$this->ape = $ape;
		$this->tlf = $tlf;
		$this->mail = $mail;
		$this->tipo = $tipo;
		$this->ask = $ask;
		$this->res = $res;
		$this->oldP = MD5($oldP);
		$this->currP = $currP;
		$this->rPass = $rPass;
		$this->aux = $aux;
		$this->db = $db;

	}

	public function Add(){
    if(strlen($this->pass) < 8): ?>
      <script>
        alert('La clave debe tener minimo 8 caracteres')
        $('#rPass').val('')
        $('#pass').val('').focus()
      </script><?php 
    elseif($this->pass != $this->rPass): ?>
      <script>
        alert('La clave no coincide')
        $('#rPass').val('')
        $('#pass').val('').focus()
      </script>
    <?php else:
      $query = "INSERT INTO usuarios VALUES(null, md5('$this->pass'), '$this->nusu', '$this->nom', 
      '$this->ape', '$this->tlf', '$this->mail', '$this->tipo', '$this->ask', '$this->res')";
      
      if($this->db->query($query)): ?>
        <script>
          alert('¡Registro Exitoso!');
          $('#main').click()
        </script>
      <?php else : ?>
        <input type="hidden" id="errno" value="<?php echo $this->db->errno; ?>">
        <script>
          if(document.getElementById('errno').value === '1062'){
            alert('La clave ya esta en uso por otro usuario, utilize otra')
              $('#rPass').val('')
              $('#pass').val('').focus()
          }else{
            alert("Error al registrar <?php echo $this->db->error ?>")
              window.location.reload()
          }
        </script><?php
      endif;
    endif;
  }

  public function Destroy(){
    $query = "DELETE FROM usuarios WHERE id = '$this->aux'";

    if ($this->db->query($query)): ?>
      <script>
        alert('Registro Borrado')
      </script>
    <?php else : ?>
      <script>
        alert("Error al Borrar <?php echo $this->db->error ?>")
      </script>
    <?php endif;
  }

  public function Update(){
    if(strlen($this->pass) < 8): ?>
      <script>
        alert('La clave debe tener minimo 8 caracteres')
        $('#rPass').val('')
        $('#pass').val('').focus()
      </script><?php 
    elseif($this->pass != $this->rPass): ?>
      <script>
        alert('La clave no coincide')
        $('#rPass').val('')
        $('#pass').val('').focus()
      </script>
    <?php elseif($this->currP != $this->oldP): ?>
      <script>
        alert('La clave actual no coincide');
        $('#oldP').val('').focus();
      </script>
    <?php else:
      $query = "UPDATE usuarios SET clave = md5('$this->pass') WHERE id = '$this->aux'";

      if($this->db->query($query)) : ?>
        <script>
          alert('¡clave actualizada!')
          $('#main').click()
        </script>
      <?php else : ?>
        <script>
          alert("Error al actualizar <?php echo $this->db->error ?>")
          window.location.reload()
        </script>
      <?php endif;
    endif;
  }

  public function Restore(){
    $query = "SELECT * FROM usuarios WHERE nusu = '$this->nom' AND ask = '$this->ask' AND res = '$this->res'";
    if($res = $this->db->query($query)):
        if($res->num_rows):
        $row = $res->fetch_assoc();
        $arr = array(
          'valida' => 1,
          'id' => $row['id'],
          'pass' => $row['clave']
        );
        echo json_encode($arr);
      else:
        $arr = array('valida' => 0);
        echo json_encode($arr);
      endif;
    endif;
  }

  public function RestorePass(){
    if(strlen($this->pass) < 8): ?>
      <script>
        alert('La clave debe tener minimo 8 caracteres')
        $('#rPass').val('')
        $('#pass').val('').focus()
      </script><?php 
    elseif($this->pass != $this->rPass): ?>
      <script>
        alert('La clave no coincide')
        $('#rPass').val('')
        $('#pass').val('').focus()
      </script>
    <?php else:
      $query = "UPDATE usuarios SET clave = md5('$this->pass') WHERE id = '$this->aux' and clave = '$this->currP'";

      if ($this->db->query($query)): ?>
        <script>
          alert('¡clave actualizada!');
          $('#main').click()
        </script>
      <?php else : ?>
        <script>
          alert("Error al actualizar <?php echo $this->db->error ?>")
        </script>
      <?php endif;
    endif;
  }
}

$db = new mysqli (host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_errror;
  exit();
}

$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
$nusu = isset($_POST['nusu']) ? $_POST['nusu'] : '';
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$ape = isset($_POST['ape']) ? $_POST['ape'] : '';
$tlf = isset($_POST['tlf']) ? $_POST['tlf'] : '';
$mail = isset($_POST['email']) ? $_POST['email'] : '';
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$ask = isset($_POST['ask']) ? $_POST['ask'] : '';
$res = isset($_POST['res']) ? $_POST['res'] : '';
$aux = isset($_POST['aux']) ? $_POST['aux'] : '';
$orden = isset($_POST['orden']) ? $_POST['orden'] : '';
$oldP = isset($_POST['oldP']) ? $_POST['oldP'] : '';
$currP = isset($_POST['currP']) ? $_POST['currP'] : '';
$rPass = isset($_POST['rPass']) ? $_POST['rPass'] : '';

$obj = new Usuario($pass, $nusu, $nom, $ape, $tlf, $mail, $tipo, $ask, $res, $oldP, $currP, $rPass, $aux, $db);

switch ($orden) {
  case 'add':
    $obj->Add();
    break;
  case 'destroy':
    $obj->Destroy();
    break;
  case 'editar':
    $obj->Update();
    break;
  case 'recu':
    $obj->Restore();
    break;
  case 'cla_recu':
    $obj->RestorePass();
    break;
  default:
    echo "Algo malo paso!";
    break;
}
?>
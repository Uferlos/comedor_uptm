<?php
$id = $_POST['aux'];
$current = $_POST['oldP'];
?>

<form id="recovery" autocomplete="off">
  <div class="form-row">
    <div class="form-group col">
      <label for="pass">Clave</label>
      <input type="password" class="form-control" id="pass" name="pass" aria-describedby="passDesc" required>
      <small id="passDesc" class="form-text text-muted">Nueva clave de acceso</small>
    </div>
    <div class="form-group col">
      <label for="rPass">Confirmar clave</label>
      <input type="password" class="form-control" id="rPass" name="rPass" aria-describedby="rPassDesc" required>
      <small id="rPassDesc" class="form-text text-muted">Confirmar la nueva clave de acceso</small>
    </div>
  </div>

  <input type="hidden" name="orden" value="cla_recu">
  <input type="hidden" name="aux" value="<?php echo $id ?>">
  <input type="hidden" name="currP" value="<?php echo $current ?>">

  <button type="submit" class="btn btn-primary">Procesar</button>
  <button type="button" class="btn btn-secondary" id="index">Cancelar</button>
</form>
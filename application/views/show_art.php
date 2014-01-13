<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>bootstrap/css/bootstrap.css" />
</head>
<body>
		<button data-toggle="modal" href="#example" class="btn btn-primary btn-large" value="2" onclick="preview(this.value);">Abrir ventana modal</button>
		<div id="example" class="modal hide fade in" style="display: none;">
			<div class="modal-header">
				<a data-dismiss="modal" class="close">×</a>
				<h3>Cabecera de la ventana</h3>
			</div>
			<div id="midiv" class="modal-body">
				<!-- inicio conetenido -->     
				este es un contenido          
				<!-- fin conetenido -->               
		        <?php echo $output; ?>
		    </div>
		    <div class="modal-footer">
		        <button id="btn_enviar" class="btn btn-success" value="0" onclick="enviarmail(this.value);">Guardar</button>
		        <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
		    </div>
		</div>	
	<script type="text/javascript" src="<?php echo base_url() . 'assets/'; ?>bootstrap/js/bootstrap-modal.js"></script>
</body>
</html>
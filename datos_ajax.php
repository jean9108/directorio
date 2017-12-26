<?php

        include 'conexion.php';
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		include 'pagination.php'; //incluir el archivo de paginación

		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 21; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;

		//Cuenta el número total de filas de la tabla*/
                $query = "SELECT count(*) AS numrows FROM empresas"; 
		$count_query   = mysql_query($query,$link);
		if ($row= mysql_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'index.php';
		//consulta principal para recuperar los datos
                $query = mysql_query("SELECT * FROM empresas where Estado = 1 order by NombreEmpresa LIMIT $offset,$per_page",$link);
  if ($numrows>0){
?>
<div class="row col-sm-12 col-xs-12">
    <div class="table-pagination pull-right">
	 <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
    </div> 
</div>
<div class="row">
<?php
    
    while($row = mysql_fetch_array($query)){
        
        $id=$row["EmpresaID"];
        ?>
        <div class="col-sm-4 col-xs-4 view">
            <div class="frameExpositor">
            <div class="col-sm-3 col-xs-12 img-des">
                <img src="<?php echo 'http://72.29.73.35/~sgesecurityfair/SGE/pafyc/uploads/'.$row['UrlLogo'];?>" alt="<?php echo $row['NombreEmpresa'];?>" class="imgDirectorio">
            </div>
            <div class="col-sm-9 col-xs-12">
                <h4 class="tituloDirectorio"><br/><br/><?php echo $row['NombreEmpresa'];?></h4>
            </div>        
          </div> 
          <div class="box col-sm-12 col-xs-12">
            <h5>STAND #: <?php echo $row['Stand'];?></h5>
            <p>     
             <?php echo substr(strip_tags($row['Descripcion']),0,350).'...';?> 
           </p>       
          </div>  
            <div class="col-sm-12 col-xs-12">
            <h6 style="font-weight:bold;">
            <a href="<?php echo $row['Web'];?>" target="_blank">WEBSITE</a> &nbsp;|&nbsp; 
            <a href="<?php echo $row['VideoPresentacion'];?>" target="_blank">VIDEO</a> </h6>
          </div>
        </div>  
         


<?php 
      }
      }
      ?>
<div class="row col-sm-12 col-xs-12">

		<div class="table-pagination pull-right">
			<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
		</div>
</div>
		
			<?php
			
		} else {
			?>
			<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}
	
?>
</div>       
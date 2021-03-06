<?php

        include("../jpgraph/jpgraph.php");
        include("../jpgraph/jpgraph_bar.php");
        include("../../plantilla/db_configuration.php");
        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }else{



        $consulta="SELECT u.nombre as nombre,count(codpedido) as cantidad from usuarios u join pedidos pe on u.codusuario=pe.codusuario group by u.codusuario;";
        $result=$connection->query($consulta);

               while($obj=$result->fetch_object()){

                 $datos[]=$obj->cantidad;
                  $label[]=$obj->nombre;;
                }

   $grafico = new Graph(1200,500,"auto");
 	$grafico->SetScale("textlin");
   $grafico->xaxis->title->Set("CATEGORIA");

   $grafico->xaxis->SetTickLabels($label);
   $grafico->yaxis->title->Set("CANTIDAD");



 	$barplot1=new BarPlot($datos);
 	$barplot1->SetFillGradient("black","#E3CEF6",GRAD_HOR);
 	$barplot1->SetWidth(80);

 	$grafico->Add($barplot1);
$barplot1->value->Show();
 $grafico->Stroke();

 }
  ?>

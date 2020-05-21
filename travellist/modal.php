<?php

$viagem= $_GET['via'];
$roteiro= $_GET['rot'];
$proxdta=0;
$ardoc=array();

//echo $viagem;
//echo $roteiro;
include_once ("conexao.php");

try {

    $pdo=conexao();

    //busca o codigo da viagem
    $execsql=$pdo->prepare("SELECT DISTINCT a.str_tb_via_nome,"
                                          ."a.str_tb_via_foto_2,                 "
                                          ."a.int_tb_via_foto_2,                 "
                                          ."a.str_tb_via_foto_3,                 "
                                          ."a.int_tb_via_foto_3,                 "
                                          ."a.str_tb_via_foto_4,                 "
                                          ."a.int_tb_via_foto_4,                 "
                                          ."a.str_tb_via_foto_5,                 "
                                          ."a.int_tb_via_foto_5,                 "
                                          ."a.str_tb_via_foto_6,                 "
                                          ."a.int_tb_via_foto_6,                 "
                                          ."b.str_tb_rot_data_viagem,                 "
                                          ."b.str_tb_rot_roteiro,	             "
                                          ."b.str_tb_rot_incluso,	             "
                                          ."b.str_tb_rot_nincluso,	             "
                                          ."b.str_tb_rot_datahora_embarque,	     "
                                          ."b.str_tb_rot_datahora_desembarque,	 " 
                                          ."b.str_tb_rot_local_embarque,	     "
                                          ."b.str_tb_rot_local_desembarque,	     "
                                          ."b.int_tb_rot_parceiro,	             "
                                          ."b.str_tb_rot_nmepar,	             "
                                          ."b.int_tb_rot_pos, "
                                          ."b.str_tb_rot_cod_pol,                   "
                                          ."c.str_tb_pre_hospedagem_1,           "
                                          ."c.dec_tb_pre_hospedagem_1,           "
                                          ."c.str_tb_pre_desc_1,                 "
                                          ."c.str_tb_pre_hospedagem_2,           "
                                          ."c.dec_tb_pre_hospedagem_2,           "
                                          ."c.str_tb_pre_desc_2,                 "
                                          ."c.str_tb_pre_hospedagem_3,           "
                                          ."c.dec_tb_pre_hospedagem_3,           "
                                          ."c.str_tb_pre_desc_3,                 "
                                          ."c.str_tb_pre_hospedagem_4,           "
                                          ."c.dec_tb_pre_hospedagem_4,           "
                                          ."c.str_tb_pre_desc_4,                 "
                                          ."c.str_tb_pre_hospedagem_5,           "
                                          ."c.dec_tb_pre_hospedagem_5,           "
                                          ."c.str_tb_pre_desc_5,                 "
                                          ."c.str_tb_pre_hospedagem_6,           "
                                          ."c.dec_tb_pre_hospedagem_6,           "
                                          ."c.str_tb_pre_desc_6,                 "
                                          ."c.str_tb_pre_hospedagem_7,           "
                                          ."c.dec_tb_pre_hospedagem_7,           "
                                          ."c.str_tb_pre_desc_7,                 "
                                          ."c.str_tb_pre_hospedagem_8,           "
                                          ."c.dec_tb_pre_hospedagem_8,           "
                                          ."c.str_tb_pre_desc_8,                 "
                                          ."c.str_tb_pre_hospedagem_9,           "
                                          ."c.dec_tb_pre_hospedagem_9,           "
                                          ."c.str_tb_pre_desc_9,                 "
                                          ."c.str_tb_pre_hospedagem_10,          "
                                          ."c.dec_tb_pre_hospedagem_10,	         "
                                          ."c.str_tb_pre_desc_10	             "
                        ."   FROM   tb_roteiro AS b				                                   "
                        ."   INNER JOIN tb_preco as c on c.int_tb_via_cod=b.int_tb_via_cod AND  "
                        ."                               c.int_tb_rot_cod=b.int_tb_rot_cod         "
                        ."   INNER JOIN tb_viagem as a on a.int_tb_via_cod=b.int_tb_via_cod        "
                        ."   WHERE a.int_tb_via_cod = :codvia AND                                  "
                        ."         b.int_tb_rot_cod = :codrot                                      "
                        ."   ORDER BY b.str_tb_rot_data_viagem");
                        
    $execsql->bindValue(':codvia'          ,$viagem,PDO::PARAM_INT);
    $execsql->bindValue(':codrot'          ,$roteiro,PDO::PARAM_INT);

    $execsql->execute();
    
    $data = $execsql->fetchAll(PDO::FETCH_ASSOC);
    
    if ($execsql->rowCount() != 0){
        
        foreach ($data as $row) {
            $strnmevia=$row['str_tb_via_nome'];
            $strviaft2="../img/".$viagem."/".$row['str_tb_via_foto_2'];
            $intviaft2="../img/".$viagem."/".$row['int_tb_via_foto_2'];
            $strviaft3="../img/".$viagem."/".$row['str_tb_via_foto_3'];
            $intviaft3="../img/".$viagem."/".$row['int_tb_via_foto_3'];
            $strviaft4="../img/".$viagem."/".$row['str_tb_via_foto_4'];
            $intviaft4="../img/".$viagem."/".$row['int_tb_via_foto_4'];
            $strviaft5="../img/".$viagem."/".$row['str_tb_via_foto_5'];
            $intviaft5="../img/".$viagem."/".$row['int_tb_via_foto_5'];
            $strviaft6="../img/".$viagem."/".$row['str_tb_via_foto_6'];
            $intviaft6="../img/".$viagem."/".$row['int_tb_via_foto_6'];

            $dtaviagem=$row['str_tb_rot_data_viagem'];	  

            $strdesrot=$row['str_tb_rot_roteiro'];	  
            $strrotinc=$row['str_tb_rot_incluso'];	   
            $strrotninc=$row['str_tb_rot_nincluso'];	   
            $strrotdtaemb=$row['str_tb_rot_datahora_embarque'];	   
            $strrotdtademb=$row['str_tb_rot_datahora_desembarque'];	   
            $strrotlocemb=$row['str_tb_rot_local_embarque'];	   
            $strrotlocdemb=$row['str_tb_rot_local_desembarque'];   
            $strrotpar=$row['int_tb_rot_parceiro'];	   
            $strrotnmepar=$row['str_tb_rot_nmepar'];   
            $strrotpos=$row['int_tb_rot_pos'];
            $strprehos1=$row['str_tb_pre_hospedagem_1'];
            $intprehos1=$row['dec_tb_pre_hospedagem_1'];
            $strprepag1=$row['str_tb_pre_desc_1'];
            $strprehos2=$row['str_tb_pre_hospedagem_2'];
            $intprehos2=$row['dec_tb_pre_hospedagem_2'];
            $strprepag2=$row['str_tb_pre_desc_2'];
            $strprehos3=$row['str_tb_pre_hospedagem_3'];
            $intprehos3=$row['dec_tb_pre_hospedagem_3'];
            $strprepag3=$row['str_tb_pre_desc_3'];
            $strprehos4=$row['str_tb_pre_hospedagem_4'];
            $intprehos4=$row['dec_tb_pre_hospedagem_4'];
            $strprepag4=$row['str_tb_pre_desc_4'];
            $strprehos5=$row['str_tb_pre_hospedagem_5'];
            $intprehos5=$row['dec_tb_pre_hospedagem_5'];
            $strprepag5=$row['str_tb_pre_desc_5'];
            $strprehos6=$row['str_tb_pre_hospedagem_6'];
            $intprehos6=$row['dec_tb_pre_hospedagem_6'];
            $strprepag6=$row['str_tb_pre_desc_6'];
            $strprehos7=$row['str_tb_pre_hospedagem_7'];
            $intprehos7=$row['dec_tb_pre_hospedagem_7'];
            $strprepag7=$row['str_tb_pre_desc_7'];
            $strprehos8=$row['str_tb_pre_hospedagem_8'];
            $intprehos8=$row['dec_tb_pre_hospedagem_8'];
            $strprepag8=$row['str_tb_pre_desc_8'];
            $strprehos9=$row['str_tb_pre_hospedagem_9'];
            $intprehos9=$row['dec_tb_pre_hospedagem_9'];
            $strprepag9=$row['str_tb_pre_desc_9'];
            $strprehos10=$row['str_tb_pre_hospedagem_10'];
            $intprehos10=$row['dec_tb_pre_hospedagem_10'];	   
            $strprepag10=$row['str_tb_pre_desc_10'];
            $strcoddoc=$row['str_tb_rot_cod_pol'];
        }; // fim do select dos dados de viagem

        //separa os códigos das politicas e retorna os documentos do arquivo
        //
        if (strlen($strcoddoc) > 0) {
            $strcoddoc1=substr($strcoddoc,0,strlen($strcoddoc)-1);
            
            //seleciona os documentos referentes aquela viagem
            $execsql=$pdo->query("SELECT DISTINCT str_tb_doc_nme_doc,	     "
                                ."                int_tb_doc_cod"
                                ."   FROM   tb_doc		"
                                ."   WHERE int_tb_doc_cod IN (".$strcoddoc1.") AND"
                                . "        bol_tb_doc_ativo = 0             "
                                ."   ORDER BY dta_tb_doc_data_inclusao");

            $datadoc = $execsql->fetchAll(PDO::FETCH_ASSOC);

            $ctllin=0;
                        
            if ($execsql->rowCount() != 0){
                foreach ($datadoc as $row) {
                    $ctlvia=1;
                    $ardoc[$ctllin][$ctlvia]=$row["str_tb_doc_nme_doc"];
                    $ctlvia=2;
                    $ardoc[$ctllin][$ctlvia]=$row['int_tb_doc_cod'];
                    $ctllin++;
                    };
            };
        };//fim da carga de documentos
        
        //Verifica se há outras datas da mesma viagem
        $execsql=$pdo->prepare("SELECT DISTINCT b.str_tb_rot_data_viagem	     "
                            ."   FROM   tb_roteiro AS b				                                   "
                            ."   WHERE b.str_tb_rot_data_viagem > :dtaviagem AND                           "
                            ."         b.int_tb_via_cod = :codvia AND                                  "
                            ."         b.int_tb_rot_cod = :codrot                                     "
                            ."   ORDER BY b.str_tb_rot_data_viagem");

        $execsql->bindValue(':codvia'          ,$viagem,PDO::PARAM_INT);
        $execsql->bindValue(':codrot'          ,$roteiro,PDO::PARAM_INT);
        $execsql->bindValue(':dtaviagem'       ,$dtaviagem,PDO::PARAM_STR);

        $execsql->execute();

        $data = $execsql->fetchAll(PDO::FETCH_ASSOC);

        $ctllin=0;

        if ($execsql->rowCount() != 0){
            $ardtafutura=array();

            $qtdvia=$execsql->rowCount();
            //$qtdlin=$qtdvia/3;
            
            foreach ($data as $row) {
                $ardtafutura[$ctllin]=$row['str_tb_rot_data_viagem'];
                $ctllin++;
                $proxdta=1;
            };
        };//fim do select de proximas viagens
    };
}
catch (Exception $erro)
{
    echo 'passei por aqui 1<br>';
    return 'Erro:'.$erro->getMessage();
    //var_dump($erro);
}

catch (PDOException $erro) 
{
    //echo 'passei por aqui 3<br>';
    return 'Erro:'.$execsql->errorInfo();
    //var_dump($erro);
}
            
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Oswald:400,300,700|Lato:400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <div class="container">

     <div class="col-lg-6 col-lg-offset-3">
      <!-- ===== vCard Navigation ===== -->
      <div class="row">
        <div class="col-md-8">
          <ul class="nav nav-tabs">
            <br>
            <li class="active"><a href="#roteiro" data-toggle="tab">Roteiro</a></li>
            <li><a href="#valores" data-toggle="tab">Valores</a></li>
            <li><a href="#embarque" data-toggle="tab">Embarque</a></li>
            <li><a href="#fotos" data-toggle="tab">Fotos</a></li>
            <li><a href="#politicas" data-toggle="tab">Políticas</a></li>            
<?php       if ($proxdta==1)   {?>  
            <li><a href="#dtafutura" data-toggle="tab">Próximas Datas</a></li> <?php
            }?>
          </ul>
        </div>
        <!-- col-md-8 -->
      </div>
        <!-- ===== vCard Content ===== -->
        <div class="col-md-8">
         <div class="tab-content">
         <!-- ===== First Tab ===== -->
            <div class="tab-pane active" id="roteiro">



              <h3><?php echo $strnmevia ?></h3>
              <hr>
              <p><?php echo $strdesrot ?></p>
              <br>
              <h3>Incluso</h3>
              <p><?php echo nl2br($strrotinc) ?></p>
              <br>
              <h3>Não Incluso</h3>
              <p><?php echo nl2br($strrotninc) ?></p>
              
            </div>
            <!-- tab roteiro -->

            <!-- ===== Second Tab ===== -->
            <div class="tab-pane" id="valores">
              <?php ?>
                
              <h3><?php echo $strprehos1 ?></h3>
              <br>
              <p><?php echo "R$".number_format($intprehos1,2,',','.') ?></p>
              <p><?php echo $strprepag1 ?></p>
              <br>

              <h3><?php echo $strprehos2 ?></h3>
              <br>
              <p><?php echo ($intprehos2 != 0 ? "R$".number_format($intprehos2,2,',','.') : '') ?></p>
              <p><?php echo $strprepag2 ?></p>
              <br>

              <h3><?php echo $strprehos2 ?></h3>
              <br>
              <p><?php echo ($intprehos3 != 0 ? "R$".number_format($intprehos3,2,',','.') : '') ?></p>
              <p><?php echo $strprepag3 ?></p>
              <br>

              <h3><?php echo $strprehos4 ?></h3>
              <br>
              <p><?php echo ($intprehos4 != 0 ? "R$".number_format($intprehos4,2,',','.') : '') ?></p>
              <p><?php echo $strprepag4 ?></p>
              <br>

              <h3><?php echo $strprehos5 ?></h3>
              <br>
              <p><?php echo ($intprehos5 != 0 ? "R$".number_format($intprehos5,2,',','.') : '') ?></p>
              <p><?php echo $strprepag5 ?></p>
              <br>

              <h3><?php echo $strprehos6 ?></h3>
              <br>
              <p><?php echo ($intprehos6 != 0 ? "R$".number_format($intprehos6,2,',','.') : '') ?></p>
              <p><?php echo $strprepag6 ?></p>
              <br>

              <h3><?php echo $strprehos7 ?></h3>
              <br>
              <p><?php echo ($intprehos7 != 0 ? "R$".number_format($intprehos7,2,',','.') : '') ?></p>
              <p><?php echo $strprepag7 ?></p>
              <br>

              <h3><?php echo $strprehos8 ?></h3>
              <br>
              <p><?php echo ($intprehos8 != 0 ? "R$".number_format($intprehos8,2,',','.') : '') ?></p>
              <p><?php echo $strprepag8 ?></p>
              <br>

              <h3><?php echo $strprehos9 ?></h3>
              <br>
              <p><?php echo ($intprehos9 != 0 ? "R$".number_format($intprehos9,2,',','.') : '') ?></p>
              <p><?php echo $strprepag9 ?></p>
              <br>

              <h3><?php echo $strprehos10 ?></h3>
              <br>
              <p><?php echo ($intprehos10 != 0 ? "R$".number_format($intprehos10,2,',','.') : '') ?></p>
              <p><?php echo $strprepag10 ?></p>
              <br>

              <!-- Tab Valores -->
            </div>
            
            <!-- ===== Third Tab ===== -->
            <div class="tab-pane" id="embarque">
              <h3>Embarque</h3>
              <hr>
              <p><?php echo date('d/m/Y H:i:s',strtotime($strrotdtaemb))  ?></p>
              <br>
              <h3>Local</h3>
              <p><?php echo $strrotlocemb  ?></p>
              <br>
              <h3>Desembarque</h3>
              <hr>
              <p><?php echo date('d/m/Y H:i:s',strtotime($strrotdtademb))  ?></p>
              <br>
              <h3>Local</h3>
              <br>
              <p><?php echo $strrotlocdemb  ?></p>
            </div>
            <!-- /Tab Embarque -->

            <!-- ===== Fourth Tab ===== -->
           <div class="tab-pane" id="fotos">
              <h3>Galeria</h3>
              <hr>
              <div class="row">
                <div class="col-xs-6 centered">
                    <img class="img-responsive" src="<?php echo $strviaft2 ?>" alt="">
                </div>
                <!-- col-xs-6 -->

                <div class="col-xs-6">
                    <img class="img-responsive" src="<?php echo $strviaft3 ?>" alt="">
                </div>
                <!-- col-xs-6 -->
              </div>
              <!-- row -->
              <div class="row">
                <div class="col-xs-6">
                    <img class="img-responsive" src="<?php echo $strviaft4 ?>" alt="">
                </div>
                <!-- col-xs-6 -->

                <div class="col-xs-6">
                    <img class="img-responsive" src="<?php echo $strviaft5 ?>" alt="">
                </div>
                <!-- col-xs-6 -->

                <div class="col-xs-6">
                    <img class="img-responsive" src="<?php echo $strviaft6 ?>" alt="">
                </div>
                <!-- col-xs-6 -->

              </div>
            </div>
            <!-- Tab Fotos -->

            <!-- ===== Fifth Tab ===== -->
            <div class="tab-pane" id="politicas">
              <h3>Termos e Políticas da viagem</h3>
              <hr>
              <?php for ($i=0;$i < count($ardoc);$i++) {?>
                  <a href="show_file.php?file=<?php echo $ardoc[$i][2]?>" target=\"_blank\"><?php echo $ardoc[$i][1]  ?></a>
                  <br><?php
                }; 
              
?>            </div>
            <!-- /Tab politica -->
            
            <!-- ===== Sixth Tab ===== -->
<?php       if ($proxdta==1)   {?>  
            <div class="tab-pane" id="dtafutura">
                <h3>Outras Datas</h3>
                <hr>
<?php           for ($i=0;$i < count($ardtafutura);$i++) {?>
                <p> <?php echo $ardtafutura[$i] ?> </p>
                <br><?php
                }; ?> 
            </div>
<?php       }; ?>
            <!-- /Tab proximas datas -->
         </div>
          <!-- Tab Content -->
        </div>
        <!-- col-md-8 -->
    </div>
    <!-- col-lg-6 -->
  </div>
  <!-- /.container -->

  <!-- JavaScript Libraries -->
  <script src="../lib/jquery/jquery-3.4.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script> 
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>


<div class="row" >

<?php

include_once ("conexao.php");

try {

    $pdo=conexao();

    //busca o codigo da viagem
    $execsql=$pdo->query("SELECT * FROM lis_pro_via");
    $data = $execsql->fetchAll(PDO::FETCH_ASSOC);
    
    if ($execsql->rowCount() != 0){
        $ctllin=1;
        $ctlvia=1;
        
        $qtdvia=$execsql->rowCount();
        //$qtdlin=$qtdvia/3;
?>
        <h1>Próximas Viagens</h1>

<?php
        foreach ($data as $row) {
            $intcodvia=$row['int_tb_via_cod'];
            $strnmevia=$row['str_tb_via_nome'];
            $intcodrot=$row['int_tb_rot_cod'];
	    $strviaft1="img/".$intcodvia."/".$row['str_tb_via_foto_1'];
            $intviaft1="img/".$intcodvia."/".$row['int_tb_via_foto_1'];
           
            $strrotdtavia=$row['str_tb_rot_data_viagem'];
            $strrotdtademb=$row['str_tb_rot_datahora_desembarque'];
?>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
                <div class="thumbnail">
                    <img class="img-responsive" src="<?php echo $strviaft1 ?>" style="width:100%;height:225px;" alt="">
                    <div class="caption">
                        <a href="travellist/modal.php?via=<?php echo $intcodvia ?>&rot=<?php echo $intcodrot ?>" data-fancybox data-small-btn="true" data-options='{"type" : "iframe", "iframe" : {"preload" : false, "css" : {"width" : "700px"}}}'>
                          <h3><?php
                                if (date('d/m/Y',strtotime($strrotdtavia)) == date('d/m/Y',strtotime($strrotdtademb))){
                                    echo $strnmevia." - ".date('d/m/Y',strtotime($strrotdtavia));
                                } else {
                                    echo $strnmevia." - ".date('d/m/Y',strtotime($strrotdtavia))." a ".date('d/m/Y',strtotime($strrotdtademb));
                                    }?></h3></a>
                    </div>
                </div>
        </div> <!--col-lg-4 -->

<?php
        $ctlvia++;
        //echo $ctllin;
        //echo $ctlvia;
        if ($ctlvia>3){
            $ctlvia=1;
            $ctllin++;
?>            
        </div> <!--fecha row-->
        <div class="row" >            
<?php
        };
        
        };
    } else{
?>

            <h1><strong><?php echo "Estamos atualizando nossa programação de viagens. Acompanhe nossa página.";?></strong></h1>
<?php
    }

}
catch (Exception $erro)
{
    //echo 'passei por aqui 1<br>';
    //var_dump($erro);
    return 'Erro:'.$erro->getMessage();

}

catch (PDOException $erro) 
{
    //echo 'passei por aqui 3<br>';
    //var_dump($erro);
    return 'Erro:'.$execsql->errorInfo();

}


?>

        </div> <!--fecha row-->

        

  

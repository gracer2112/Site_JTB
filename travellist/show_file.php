<?php

include_once ("conexao.php");

try {
    if(isset($_GET['file'])){

        $pdo=conexao();

        $intfile=$_GET['file'];

        $execsql=$pdo->query("SELECT DISTINCT str_tb_doc_documento"
                            ."   FROM   tb_doc		"
                            ."   WHERE int_tb_doc_cod = ".$intfile." AND"
                            . "        bol_tb_doc_ativo = 0");

        $datadoc = $execsql->fetchAll(PDO::FETCH_ASSOC);

        if ($execsql->rowCount() != 0){
            foreach ($datadoc as $row) {
                header("content-type: application/pdf");
                echo $row['str_tb_doc_documento'];
            };
        };
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

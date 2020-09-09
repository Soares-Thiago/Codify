<?php
    require_once("Codify.class.php");
    session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Thiago Pontes Soares</title>
    </head>
    <body>
        <?php
        
        $codigo = $_POST["codigo"];
        $hash_computado = $_POST["hash"];
        
        $validate = Codify::comparar_hash( $hash_computado,
                                            $codigo,
                                            $_SESSION["security_session_key"]
                                            );
        
        if($validate==1){
            print 'Você esta tentando alterar os dados de forma inválida';
            
        }else{
            print 'Tudo certo';
        }
        ?>
    </body>
</html>

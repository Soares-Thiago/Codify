<?php
    require_once("Codify.class.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Thiago Pontes Soares</title>
    </head>
    <body>
        <?php
        $param = $_GET["p"];
        $ret = Codify::Decodifica_Url($param,
                                      ["codigo","funcao"],
                                      2);
        //print_r($ret);
        
        $codigo = 0;
        if ( $ret["codigo"] != 0 ) {
            $codigo = $ret["codigo"];
        }
        
        $funcao = "";
        if ( $ret["funcao"] != "" ) {
            $funcao = $ret["funcao"];
        }
       
        
        print "Funcao: $funcao <br> Código: $codigo"
        ?>
    </body>
</html>

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
            print "HREF do link: exemplo_recebe.php parametros GET: funcao=Texto codigo=2 <br>";
            $codifica = "?p=".Codify::Codificar("codigo=2 &funcao=Texto",2);
            $url = 'exemplo_recebe.php'.$codifica.'';
            print '<a href="'.$url.'">ENVIAR</a>';
        ?>
    </body>
</html>

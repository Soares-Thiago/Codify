<?php
//Exemplo de uso da funcionalidade de criptografia, pode ser usada para impedir o usuário de alterar dados do formulario
require_once("Codify.class.php");

session_start();

$key = Codify::gera_key_sessao();
$_SESSION["security_session_key"] = $key;

$codigo = 2;
$hash   = Codify::hash_hmac_codigo($_SESSION["security_session_key"],$codigo);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form
            enctype="multipart/form-data"
            action="exemplo_hash_recebe.php" 
            method="post">
            <input type="text"  id="codigo" name="codigo" value="<?php print $codigo ?>" readonly >
            <input type="hidden" id="hash" name="hash" value="<?php print $hash ?>">
            <button type="submit">Enviar</button>
        </form> 
    </body>
</html>    
    

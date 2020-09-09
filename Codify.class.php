<?php
/*
 * ******************************************************************************
 * Descrição..........: 
 *      Classe com funções de codificação de URL's e criptografia de dados               
 *         !--------------------IMPORTANTE--------------------!
 * A funções de codifciação e decodificação recebem um parametro "$qtd_vezes"
 * que indica a quantidade de vezes que o script vai codificar ou decodificar 
 * o padrão é três (3) porém deve ser igual para a codificação e decodificação
 * de uma mesma URL.
 * 
 * As funções de HASH precisam da chave, ela é gerada no início de cada sessão,
 * e deve ser valida enquanto a sesao existir 
 *                  
 * -----------------------------------------------------------------------------*
 * Criado por.........: Thiago Pontes Soares                                    *
 * Data de criação....: 24/04/2020                                              *
 * ******************************************************************************
 */
require_once "random_compat-master/lib/random.php";

class Codify {
    /**
     * Método responsável por codificar a Url<br>
     * Modificações:<br>
     *
     * @param str = string da URL
     * @param qtd_vezes = numero de vzes que será aplicado a codificação (padrão 3)
     * @return String
     *
     * @author Thiago Pontes
     * @version 1.0
     * @date 24/04/2020
     */
    static function Codificar( $str, 
                        $qtd_vezes = 3) {
        $prfx = array('AFVxaIF', 'Vzc2ddS', 'ZEca3d1', 'aOdhlVq', 'QhdFmVJ', 'VTUaU5U',
                      'QRVMuiZ', 'lRZnhnU', 'Hi10dX1', 'GbT9nUV', 'TPnZGZz', 'ZGiZnZG',
                      'dodHJe5', 'dGcl0NT', 'Y0NeTZy', 'dGhnlNj', 'azc5lOD', 'BqbWedo',
                      'bFmR0Mz', 'Q1MFjNy', 'ZmFMkdm', 'dkaDIF1', 'hrMaTk3', 'aGVFsbG');
        for($i=0; $i<$qtd_vezes; $i++) {
          $str = $prfx[array_rand($prfx)].strrev(base64_encode($str));
        }
        $str = strtr($str,
                     "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",
                     "a8rqxPtfiNOlYFGdonMweLCAm0TXERcugBbj79yDVIWsh3Z5vHS46pQzKJ1Uk2");

        return $str;
    }
    
    /**
     * Método responsável por decodificar a Url<br>
     * Modificações:<br>
     *
     * @param str = string da URL Codificada pelo método {Codificar}
     * @param qtd_vezes = numero de vzes que será aplicado a decodificação (padrão 3)
     *              'lembre-se o número de vezes da decodif tem que ser igual ao da codif'
     * @return String
     *
     * @author Thiago Pontes
     * @version 1.0
     * @date 24/04/2020
     */
     static function Decodificar( $str,
                          $qtd_vezes = 3) {
        $str = strtr($str,
                     "a8rqxPtfiNOlYFGdonMweLCAm0TXERcugBbj79yDVIWsh3Z5vHS46pQzKJ1Uk2",
                     "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789");
        for($i=0; $i<$qtd_vezes; $i++) {
          $str = base64_decode(strrev(substr($str,7)));
        }
        return $str;
    }
    
    /**
     * Método responsável por seprar os valores a Url<br>
     * Modificações:<br>
     *
     * @param $param = string da URL Decodificada pelo método {Decodificar}
     *              'lembre-se o número de vezes da decodif tem que ser igual ao da codif'
     * @return String
     *
     * @author Thiago Pontes
     * @version 1.0
     * @date 24/04/2020
     */
     static function Separar_Parametros($param) {
        return explode('&',$param);
    }
    
    /**
     * Método responsável por separar os valores da Url<br>
     * Modificações:<br>
     *
     * @param str = string da URL decodificada pelo método {Decodificar}
     *              'lembre-se o número de vezes da decodif tem que ser igual ao da codif'
     * @return String
     *
     * @author Thiago Pontes
     * @version 1.0
     * @date 24/04/2020
     */
     static function Separar_Valor($opcao) {
        return explode('=',$opcao);
    }
    
    /**
     * Método responsável por Decodificar os valores da Url em uma única função<br>
     * Modificações:<br>
     *
     * @param Url = string da URL codificada pelo método {Codificar}
     * @param nome_param = nomes dos index's (chaves) do array que será retornado p/ cada valor  
     * @param qtd_vezes = numero de vzes que será aplicado a decodificação (padrão 3)
     *              'lembre-se o número de vezes da decodif tem que ser igual ao da codif'
     * @return String
     *
     * @author Thiago Pontes
     * @version 1.0
     * @date 24/04/2020
     */
    static function Decodifica_Url($url,
                            $nome_param = array(),
                            $qtd_vezes = 3){
        $ret = array();
        
        $parametros = Codify::Separar_Parametros(Codify::Decodificar($url,
                                                                     $qtd_vezes));
        $cont = 0;
        foreach($parametros as $opcao) {
            $valor = Codify::Separar_Valor($opcao);
            $ret[$nome_param[$cont]] = $valor[1];
            $cont++;    
        }

        return $ret;
    }
    
    /**
     * Método responsável por gerar hash sha512 apartir de uma chave<br>
     * Modificações:<br>
     *
     * @param par_key = chave usada
     * @param par_param = parametro a ser codificado  
     * @return String
     *
     * @author Thiago Pontes
     * @version 1.0
     * @date 27/04/2020
     */
    static function hash_hmac_codigo($par_key,
                              $par_param){
        $ret = "";
        $ret = hash_hmac('sha512', $par_param, $par_key);
        
        return $ret;
    }
    
    /**
     * Método responsável por gerar chave<br>
     * É chamado no início da Sessão e armazenado nela
     * Modificações:<br>
     *
     * @return String
     *
     * @author Thiago Pontes
     * @version 1.0
     * @date 27/04/2020
     */
    static function gera_key_sessao(){
        $key = "";
        $key = unpack('H*', random_bytes(32))[1];
        
        return $key;
    }
    
    /**
     * Método responsável por compar hash computado com o enviado pelo usuário<br>
     * Modificações:<br>
     *
     * @param par_hash = hash computado
     * @param par_param = parametro a ser codificado 
     * @param par_key = chave gerada na sessão
     * 
     * @return 0->válido||1->inválido
     *
     * @author Thiago Pontes
     * @version 1.0
     * @date 27/04/2020
     */
    static function comparar_hash($par_hash,
                                  $par_param,
                                  $par_key){
        
        $isHMACValido = "";
        $isHMACValido = hash_equals(hash_hmac('sha512', $par_param, $par_key),
                                    $par_hash);
        
        if(!$isHMACValido){
            return 1;
        }
        
        return 0;
    }
}

?>
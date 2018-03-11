<?php

/*
 * campo.inc
 * manipula o comportamento de dados
 * @author      wlung
 * @since       18/06/2003
 * @version     1.0
 * (C) Opus Comunica��o de Dados, 2003.
 */
 

/** flag que indica que o campo eh obrigatorio no preenchimento */
$CAMPO_OBRIGATORIO=0;
/** flag que indica que o campo opcional no preenchimento */
$CAMPO_OPCIONAL=1;

/** variaveis constantes utilizado para representacao do tipo de dados */
$NUM=0;
$ALPHA=1;
$DATE=2;
$MONEY=3;
$CEP=4;
$ESTADO=5;
$PERCENTUAL=6;
$NUMINTEIRO=7;

/**
 * Confere se o valor passado � do tipo NUM 
 */
function isNUM($valor){
	return is_numeric($valor);
}


/**
 * Confere se o valor passado � do tipo ALPHA 
 */
function isALPHA($valor){
	return (!is_numeric($valor));
}


/** 
 * Confere se o valor passado � do tipo DATE (dd/mm/aaaa). 
 */
function isDATE($valor){   
	if (strlen($valor)!=10)
		return false;
				
	if (!preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',$valor))
		return false;
	
	$dataVenc = explode ('/', $valor);	
	if ( !checkdate($dataVenc[1], $dataVenc[0], $dataVenc[2]) ) 
		return false;

	return true;
}


/**
 * Confere se o valor de data passado esta dentro do limite permitido
 */
Function isDateAllowed($valor){
	global $DATA_BASE_NUM, $DATA_MAX_PERMITIDA_NUM;
    	
    	$dataVenc = explode ('/', $valor);
    	$dataTmp = $dataVenc[2] . $dataVenc[1] . $dataVenc[0];   // aaaammdd    	
	
	$DATA_MIN_PERMITIDA_NUM = 20030101;   //date('Ymd', time());
    
    	return ($dataTmp>=$DATA_MIN_PERMITIDA_NUM && $dataTmp>=$DATA_BASE_NUM && $dataTmp<=$DATA_MAX_PERMITIDA_NUM);
}



/**
 * Confere se o valor passado � do tipo MONEY (#.##9,99 ou #9,99) 
 */
function isMONEY($valor){
	//formato #9,99 ou formato #.###.##9,99
	if(!preg_match('/^[0-9]+,[0-9]{2}$/',$valor) && !preg_match('/^[0-9]{1,3}(\.[0-9]{3})*,[0-9]{2}$/',$valor) )
		return false;
	
	return true;
}

/**
 * Confere se o valor passado � do Num�rico inteiro ( sem ponto ) 1234567890
 */
function isNUMINTEIRO($valor){
	
	if(!preg_match('/^[0-9]+$/',$valor) )
		return false;
	
	return true;
}


/**
 * Confere se o valor passado � do tipo PERCENTUAL (0,2 , 22,50) 
 */
function isPERCENTUAL($valor){

	if(!preg_match('/^[0-9]{1,2},[0-9]{1,2}$/',$valor) )
		return false;
	
	return true;
}

/** 
 * Confere se o cep passado � do tipo CEP (99999-999) 
 */
function isCEP($valor)
{
    return preg_match('/^[0-9]{5}-[0-9]{3}$/', $valor);
}


/**
 * Confere se a sigla do estado passado � do tipo ESTADO definido (SP,MG,RG,....) 
 */
function isESTADO($valor) {
	global $SIGLA_ESTADO;
	return in_array(strtoupper($valor),$SIGLA_ESTADO);
}

 

/**
 * Preenche com o caractere desejado � esquerda uma string.
 *
 * Caso o comprimento da string seja maior que o comprimento
 * final dela, a pr�pria string ser� retornada.
 */
function fillWithCharLeft ($str1, $ch, $len) {
	$strOut = '';
	$tamStr = strlen($str1);
	for ($i = $tamStr ; $i < $len ; $i++) $strOut .= $ch;
	return $strOut . $str1;
}


/**
 * Preenche com o caractere desejado � direita uma string.
 *
 * Caso o comprimento da string seja maior que o comprimento
 * final dela, a pr�pria string ser� retornada.
 */
function fillWithCharRight ($str1, $ch, $len) {
	$strOut = '';
	$tamStr = strlen($str1);
	for ($i = $tamStr ; $i < $len ; $i++) $strOut .= $ch;
	return $str1 .$strOut;
}


/** 
 * Metodo que remove caracteres alfa de um dado 
 */
function stripNotNumber($valor){
	return preg_replace('/[^0123456789]/', '', $valor);
}


/**
 * Confere se o valor passado confere com o tipo do campo.
 */
function checkCampo($valor, $campoPP, $tipo, $tamanho, $isMandatory) {
	global $NUM, $ALPHA, $DATE, $MONEY, $CEP, $ESTADO, $NUMINTEIRO, $PERCENTUAL, $CAMPO_OBRIGATORIO;

        // considere erro desconhecido se o valor passado for nulo.
	if (!isset($valor) && $isMandatory == $CAMPO_OBRIGATORIO) {
		die ('ERRO: Arquivo de configuração com formato inválido. Verifique se o campo '.$campoPP.' está definido no arquivo.');
	}
        
        $len = strlen($valor);
        if ($isMandatory == $CAMPO_OBRIGATORIO && $len<1)
        	die('ERRO: '.$campoPP.'01'.$valor.'Tamanho do campo inválido'); 
        
	$retorno = $valor;
	if ($len>$tamanho)
		die('ERRO: '.$campoPP.'01'.$valor.'Tamanho do campo inválido');                  

        switch ($tipo) {
            case $NUM: 
                    if (!isNUM($valor))
                        die('ERRO: '.$campoPP.'03'.$valor.'Caractere alfa n�o esperado');
                    break;
            case $ALPHA:
                    break;
            case $DATE:
                    if ($len!=$tamanho) 
                        die('ERRO: '.$campoPP.'01'.$valor.'Tamanho do campo inv�lido');                        
                    
                    if (!isDATE($valor))
                        die('ERRO: '.$campoPP.'04'.$valor.'Data inv�lida');

		    if (!isDateAllowed($valor))
			die('ERRO: '.$campoPP.'05'.$valor.'Data fora do limite permitido');
			
                    break;
            case $MONEY:
                    if ($len<4) 
                        die('ERRO: '.$campoPP.'01'.$valor.'Tamanho do campo inv�lido');                        

                    if (!isMONEY($valor))
                        die('ERRO: '.$campoPP.'03'.$valor.'Caractere alfa n�o esperado');
                    
                    if(preg_match('/^[0-9]+,[0-9]{2}$/',$valor)) { //sem separador de milhar
                    	$aux = strlen($valor)-3;
                    	$retorno = number_format(substr($valor,0,$aux), 0, ',', '.') . substr($valor,$aux);
                    }
                    break;
            case $CEP:
                    if ($len > 1 && $len < 8)  
                        die('ERRO: '.$campoPP.'01'.$valor.'Tamanho do campo inv�lido');                        
		    
		    if ($len==8)
			$retorno = substr($valor,0,5).'-'.substr($valor,5);

                    if ($len > 0 && !isCEP($retorno))
                        die('ERRO: '.$campoPP.'01'.$valor.'Tamanho do campo inv�lido');
                    break;
            case $ESTADO:    // SP,MG,.....
                    if ($len!=2)
                        die('ERRO: '.$campoPP.'01'.$valor.'Tamanho do campo inv�lido');
                    if (!isESTADO($valor))
                        die('ERRO: '.$campoPP.'06'.$valor.'Conte�do inv�lido');                        
                    $retorno = strtoupper($valor);
                    break;
            case $PERCENTUAL: //0,2 , 22,50, ...
                    if ($len<2)                     
                        die('ERRO: '.$campoPP.'01'.$valor.'Tamanho do campo inv�lido');                        

                    if (!isPERCENTUAL($valor))
                        die('ERRO: '.$campoPP.'06'.$valor.'Conte�do inv�lido');
                    break;
            case $NUMINTEIRO: 
		    if (!isNUMINTEIRO($valor))
		        die('ERRO: '.$campoPP.'03'.$valor.'Caractere alfa n�o esperado');
    		    break;
    		    
            default: break;
        }
        
        return $retorno;
}
?>
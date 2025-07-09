<?
/**
 * armazenar todos dados necessarios para gerar codigo de barra
 * @author      wlung
 * @since       18/06/2003
 * @version     1.0
 * @modified    25/08/2005 dbordini
 * (C) Opus Comunica��o de Dados, 2003.
 */

/** incluir os valores constantes **/
include './includes/const.inc';

/** carregar as propriedades do arquivo de configuracao  **/
include './WEB-INF/BoletoWebCaixa.ini';

/** checar os dados do arquivo de configuracao  **/
include './includes/campo.inc';
$msg_sacado = array ($msg_sacado1,$msg_sacado2,$msg_sacado3,$msg_sacado4,$msg_sacado5,
		     $msg_sacado6,$msg_sacado7,$msg_sacado8,$msg_sacado9,$msg_sacado10);

checkCampo($nome_cedente,"10",$ALPHA,40,$CAMPO_OBRIGATORIO);
checkCampo($cod_cedente,"11",$NUM,6,$CAMPO_OBRIGATORIO);
checkCampo($agencia_vinculacao,"12",$NUM,4,$CAMPO_OBRIGATORIO);

if (preg_match('/^0+$/',$cod_cedente))
	die('ERRO: 1199Campo inv�lido');
if (preg_match('/^0+$/',$agencia_vinculacao))
	die('ERRO: 1299Campo inv�lido');

if (isset($multa) && trim($multa)!="") 	
	$multa = checkCampo(trim($multa),"15",$PERCENTUAL,5,$CAMPO_OPCIONAL);
	
if (isset($juros_dia) && trim($juros_dia)!="")
	$juros_dia = checkCampo(trim($juros_dia),"14",$PERCENTUAL,5,$CAMPO_OPCIONAL);
for ($i=0; $i<sizeof($msg_sacado); $i++)
	checkCampo($msg_sacado[$i],"13",$ALPHA,70,$CAMPO_OPCIONAL);

//preenchimento de ZEROS nos campos cod_cedente e agencia
$cod_cedente = fillWithCharLeft($cod_cedente, '0', 6);
$agencia_vinculacao = fillWithCharLeft($agencia_vinculacao,'0', 4);


/** Makes available those super global arrays that are made available in versions of PHP after v4.1.0. **/
if (isset ($HTTP_POST_VARS)) $_POST = &$HTTP_POST_VARS;

/** obter dados do formulario do cliente que sao mais frequentemente alterados **/
$sNome      = $_POST["sacadoNome"];
$sCNPJ      = $_POST["sacadoCNPJ"];
$sEndereco  = $_POST["sacadoEndereco"];
$sCEP       = $_POST["sacadoCep"];
$sCidade    = $_POST["sacadoCidade"];
$sEstado    = $_POST["sacadoEstado"];
$vencimento = $_POST["dataVencimento"];
$nosso_num  = $_POST["nossoNumero"];
$num_doc    = $_POST["numDocumento"];
$valor      = $_POST["valor"];
$valor_multa= $_POST["multa"];
$msg_compensacao = array($_POST["msgCompensacao1"],$_POST["msgCompensacao2"],
			 $_POST["msgCompensacao3"],$_POST["msgCompensacao4"]);

//Adiciona o valor da multa ao valor do boleto original
$valor = number_format((float)str_replace(",", ".", str_replace(".", "", $valor)) + (float)str_replace(",", ".", str_replace(".", "", $valor_multa)) + (float)str_replace(",", ".", str_replace(".", "", $despesa_bancaria)), 2, ",", ".");

/** checar os dados do formulario vindo do cliente  **/
checkCampo($sNome,"01",$ALPHA,40,$CAMPO_OBRIGATORIO);
checkCampo($sEndereco,"02",$ALPHA,40,$CAMPO_OBRIGATORIO);
$sCEP = checkCampo($sCEP,"05",$CEP,9,$CAMPO_OBRIGATORIO);  // 12345-678

if ($sCEP == "00000-000")
	die("ERRO: 0506Conteudo inv�lido");

checkCampo($sCidade,"03",$ALPHA,25,$CAMPO_OBRIGATORIO);
$sEstado = checkCampo($sEstado,"04",$ESTADO,2,$CAMPO_OBRIGATORIO);

if ($vencimento!="00/00/0000")
	checkCampo($vencimento,"06",$DATE,10,$CAMPO_OBRIGATORIO); // dd/mm/yyyy

checkCampo($nosso_num,"07",$NUMINTEIRO,15,$CAMPO_OBRIGATORIO);
checkCampo($num_doc,"08",$ALPHA,11,$CAMPO_OPCIONAL); 

if (preg_match('/^0+$/',$nosso_num)) 
	die("ERRO: 0799Campo inválido");
else $nosso_num = fillWithCharLeft($nosso_num, "0", 15);
if (preg_match('/^0+$/',trim($num_doc)))
	die("ERRO: 0899Campo inválido");
else $num_doc = fillWithCharRight($num_doc, " ", 11);

$valor = checkCampo($valor,"09",$MONEY,13,$CAMPO_OBRIGATORIO); //no maximo 10 algarismos numericos: 12.345.678,90
if ($valor == "0,00")
	die("ERRO: 0906Conteudo inv�lido");

for ($i=0; $i<sizeof($msg_compensacao); $i++)
	checkCampo($msg_compensacao[$i],"17",$ALPHA,60,$CAMPO_OPCIONAL);


?>
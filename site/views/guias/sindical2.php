<?php

use yii\widgets\MaskedInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<script language="JavaScript" type="text/javascript" src='BoletoWebCaixa/js/form.js'></script>

<h1>Contribuição Sindical</h1>

<?php
$form = ActiveForm::begin([
            'action' => ['boleto'],
            'method' => 'post',
            'id' => 'boleto-form',
            'options' => ['class' => 'form-horizontal', 'onsubmit' => 'return Consiste(this)'],
            'enableClientValidation' => true,
        ])
?>
<input type="hidden" name="msgCompensacao1" size="60" maxlength="60" value="Contribuição sindical">
<input type="hidden" name="msgCompensacao2" size="60" maxlength="60" value="">
<input type="hidden" name="msgCompensacao3" size="60" maxlength="60" value="">
<input type="hidden" name="msgCompensacao4" size="60" maxlength="60" value="Após vencimento, pagável apenas nas agências da Caixa">
<input type="hidden" name="gerar" value="true">
<table border="1" cellspacing="0" cellpadding="4" width="100%">
    <tr>
        <td align="left" valign="middle" colspan="2" bgcolor="#FFFFFF">
            <p align="center"><font color="#0000FF"> <font color="#000000"><b>Informa&ccedil;&otilde;es sobre o Sacado</b></font> </font> </td>
    </tr>
    <tr>
        <td align="left" valign="middle" width="36%"><strong>Nome da Empresa ou Empregado:</strong> </td>
        <td align="left" width="64%"> <div align="left">
                <input type="text" name="sacadoNome" size="70" maxlength="70" value="">
            </div></td>
    </tr>
    <tr>
        <td align="left" valign="middle" width="36%"><strong>CNPJ ou CPF:</strong> </td>
        <td align="left" width="64%"> <div align="left">
                <input type="text" name="sacadoCNPJ" size="70" maxlength="18" value="">
            </div></td>
    </tr>
    <tr>
        <td align="left" valign="middle" width="36%"><strong>Endere&ccedil;o:</strong> </td>
        <td align="left" width="64%"> <div align="left">
                <input type="text" name="sacadoEndereco" size="40" maxlength="40" value="">
            </div></td>
    </tr>
    <tr>
        <td align="left" valign="middle" width="36%"><strong>Cep:</strong>
        </td>
        <td align="left" width="64%"> <div align="left"> <strong>
                    <input type="text" name="sacadoCep" size="10" maxlength="8" value="">
                </strong> </div></td>
    </tr>
    <tr>
        <td align="left" valign="middle" width="36%" height="39"><b>Cidade: </b></td>
        <td align="left" width="64%" height="39"> 
            <div align="left">
                <input type="text" name="sacadoCidade" size="25" maxlength="25" value="Porto Alegre">
                <strong> Estado:</strong>
                <select name="sacadoEstado" size="1">
                    <option value="SP">SP</option>
                    <option value="AC">AC</option>
                    <option value="AL">AL</option>
                    <option value="AM">AM </option>
                    <option value="AP">AP</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MG">MG </option>
                    <option value="MS">MS</option>
                    <option value="MT">MT</option>
                    <option value="PA">PA</option>
                    <option value="PB">PB</option>
                    <option value="PE">PE</option>
                    <option value="PI">PI</option>
                    <option value="PR">PR</option>
                    <option value="RJ">RJ </option>
                    <option value="RN">RN</option>
                    <option value="RO">RO</option>
                    <option value="RR">RR</option>
                    <option value="RS" selected="selected">RS</option>
                    <option value="SC">SC</option>
                    <option value="SE">SE</option>
                    <option value="SP">SP</option>
                    <option value="TO">TO </option>
                </select>
            </div>
        </td>
    </tr>
    <tr>
        <td width="36%" height="2"><font size="3"><b><font size="3">Valor do Boleto :</font></b></font></td>
        <td align="left" width="64%" height="2"> <div align="left">
                <strong>
                    <input type="text" name="valor" size="18" maxlength="13" value="" onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);">
                </strong> </div></td>
    </tr>
    <tr>
        <td width="36%" height="2"><b>Data de Venc.:</b></td>
        <td align="left" width="64%" height="2"> <input type="text" name="dataVencimento" size="18" value="" maxlength="10" onblur="javascript:formataDataDigitada(this);" onkeyup="javascript:formataDataDigitada(this);">
        </td>
    </tr>
    <tr>
        <td width="36%" height="2"><b>Competência:</b></td>
        <td align="left" width="64%" height="2"> <input type="text" name="dataCompetencia" size="18" value="" maxlength="7">
        </td>
    </tr>
    <tr>
        <td width="36%" height="2"><b>Multa/Juros (R$):</b></td>
        <td align="left" width="64%" height="2"> <input type="text" name="multa" size="18" value="" maxlength="10" onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);"th="10" />
        </td>
    </tr>
    <tr>
        <td width="36%" height="2"><b>Despesas bancárias (R$):</b></td>
        <td align="left" width="64%" height="2"> <input type="text" name="despesas" size="18" value="R$ 6,00" readonly="readonly" />
        </td>
    </tr>
    <!--tr>
    <td width="36%" height="40"><b><font size="3">N&uacute;mero do Documento</font>
      :</b></td>
    <td align="left" width="64%"> <input type="text" name="numDocumento" size="18" maxlength="11" value=""> </td>
    </tr-->

</table>
<br><br>
<div class="row">
    <div class="form-group">
        <?= Html::submitButton('Gerar  Boleto', [ 'class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
<!--script>document.BoletoWebCaixa.sacadoNome.focus()</script-->
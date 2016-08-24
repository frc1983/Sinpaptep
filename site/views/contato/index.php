<?php
/* @var $this yii\web\View */

use yii\widgets\MaskedInput
?>
<h1>Contato</h1>

<p class="first justify">Para falar conosco você pode preencher o formulário ou 
    entrar em contato através de nosso telefone e e-mail abaixo.</p>
<br />
<div class="left col-md-5">
    <p><b>Fone/Fax:</b>(51) 3361.2495</p>
    <p><b>E-mail:</b><a href="mailto: contato@sindicatopublicitariosrs.com.br"> 
            contato@sindicatopublicitariosrs.com.br</a>
    </p>
    <p>
        <b>NOSSO ENDEREÇO:</b><br>
        Av. João Wallig, 518<br>
        Bairro Passo D’Areia <br>
        Porto Alegre, RS<br>
        CEP: 91340-000
    </p>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.728136331381!2d-51.16672698430695!3d-30.015961736914086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x951977768f319573%3A0x3b7347e2bcd36ed7!2sSINPAPTEP+-+RS!5e0!3m2!1spt-BR!2sbr!4v1456774048145" width="280" height="240" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<div class="left col-md-7">
    <form class="form" name="contato" method="post" action="">

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone:</label>

            <?php
            echo MaskedInput::widget([
                'name' => 'telefone',
                'mask' => '(99)9999-99999',
                'options' => [
                    'class' => 'form-control', 
                    'required' => '', 
                    'minlength' => '13', 
                    'type' => 'tel', 
                    'title' => 'Tamanho']
            ]);
            ?>
        </div>

        <div class="form-group">
            <label for="mensagem">Mensagem:</label>
            <textarea class="form-control" name="mensagem" id="mensagem" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

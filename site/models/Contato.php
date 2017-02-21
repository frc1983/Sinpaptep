<?php

namespace app\models;

use Yii;

class Contato extends \yii\base\Model
{
    public $nome;
    public $email;
    public $telefone;
    public $mensagem;
    
    public function rules()
    {
        return [
            [['nome', 'email', 'telefone'], 'required'],
            ['email', 'email'],
        ];
    }
}
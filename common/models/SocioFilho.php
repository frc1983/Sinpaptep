<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "socio_filho".
 *
 * @property int $Id
 * @property int $Id_Socio
 * @property string $Nome
 * @property string $DataNascimento
 */
class SocioFilho extends ActiveRecord
{
    public static function tableName()
    {
        return 'Socio_Filho';
    }

    public function rules()
    {
        return [
            [['Nome', 'DataNascimento'], 'required'],
            [['Id_Socio'], 'integer'],
            [['DataNascimento'], 'date', 'format' => 'php:Y-m-d'],
            [['Nome'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Id_Socio' => 'Sócio',
            'Nome' => 'Nome do Filho',
            'DataNascimento' => 'Data de Nascimento',
        ];
    }
} 
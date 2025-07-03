<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Anunciante extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $bannerFile;

    public static function tableName()
    {
        return 'anunciante';
    }

    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome', 'banner', 'url'], 'string', 'max' => 255],
            [['bannerFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }
} 
<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "campos".
 *
 * @property int $id
 * @property string|null $nombre
 * @property int|null $aforo
 * @property float|null $precio
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string|null $tipo
 * @property string|null $foto
 * @property float|null $rate
 *
 * @property Alquileres[] $alquileres
 */
class Campos extends ActiveRecord
{
    /**
     * Define a property to hold the uploaded file.
     * This is not a database field.
     *
     * @var UploadedFile
     */
    public $archivo;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'campos';
    }

    /**
     * {@inheritdoc}
     */
public function rules()
{
    return [
        [['id'], 'required'],
        [['id', 'aforo'], 'integer'],
        [['precio'], 'number'],
        [['nombre'], 'string', 'max' => 300],
        [['direccion'], 'string', 'max' => 400],
        [['telefono'], 'string', 'max' => 20],
        [['tipo'], 'string', 'max' => 200],
        [['archivo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
        [['rate'], 'default', 'value' => 0],
    ];
}
/**
 * Calculate the average rate based on the data in the `rates` table.
 *
 * @return float|null The average rate or null if there are no rates available.
 */


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'aforo' => 'Aforo',
            'precio' => 'Precio',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
            'tipo' => 'Tipo',
            'foto' => 'Foto',
        ];
    }

    /**
     * Gets query for [[Alquileres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlquileres()
    {
        return $this->hasMany(Alquileres::class, ['idCampo' => 'id']);
    }
    
    public function getVotes()
    {
        return $this->hasMany(Rates::class, ['idCampo' => 'id']);
    }
 public function getAverage()
    {
          // Retrieve the sum of the 'rate' column for rows matching the condition
    $totalRate = (float) Rates::find()->where(['idCampo' => $this->id])->sum('rate');
    
    // Retrieve the count of rows matching the condition
    $rowCount = (int) Rates::find()->where(['idCampo' => $this->id])->count();

    if ($rowCount > 0) {
        // Calculate the average rate and round it to 1 decimal place
        $averageRate = round($totalRate / $rowCount, 1);

        return $averageRate;
    }
    }

    /**
     * Save the uploaded photo file to the server and store the file path in the 'foto' attribute.
     *
     * @return bool whether the photo file was saved successfully
     */
   public function subirArchivo(): bool
    {
        $this->archivo->saveAs('imgs/campos/' . $this->id . $this->archivo->name);
        return true;
    }
       public function beforeValidate()
    {
        // si he seleccionado un archivo en el formulario
        if (isset($this->archivo)) {
            $this->archivo = UploadedFile::getInstance($this, 'archivo');
        }

        return true;
    }
        public function afterValidate()
    {
        // compruebo si he seleccionado un archivo en el formulario
        if (isset($this->archivo)) {
            $this->subirArchivo();
            $this->foto = $this->id . $this->archivo->name;
        }

        return true;
    }
       /**
     * metodo que se ejecuta despues de guardar el registro 
     * en la bbdd
     * 
     * @param mixed $insert este argumento es true si estas insertando un registro y false si es una actualizacion
     * @param array $atributosAnteriores tengo todos los datos de la tabla antes de actualizar
     * @return void
     */
    public function afterSave($insert, $atributosAnteriores)
    {
        // pregunto si es una actualizacion
        if (!$insert) {
            // pregunto si he seleccionado un archivo en el formulario
            if (isset($this->archivo)) {
                // compruebo si existia foto anteriormente en la noticia
                if (isset($atributosAnteriores["foto"])) {
                    // elimino la imagen vieja del servidor
                    unlink('imgs/campos/' . $atributosAnteriores["foto"]);
                }
            }
        }
    }
public function afterDelete()
{
    // Check if the file exists before attempting to delete it
    $filePath = 'imgs/campos/' . $this->foto;
    if (!$this->foto=="") {
        unlink($filePath);
    }
    
    return parent::afterDelete();
}

    /**
     * 
     *
     * @return \yii\db\ActiveQuery
     */

}
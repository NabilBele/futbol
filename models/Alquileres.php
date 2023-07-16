<?php

namespace app\models;

use DateInterval;
use DateTime;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "alquileres".
 *
 * @property int $id
 * @property int|null $idSocio
 * @property int|null $idCampo
 * @property string $fechaHora
 * @property int|null $horas
 * @property int|null $personas
 * @property float|null $precioTotal
 *
 * @property Campos $idCampo0
 * @property Socios $idSocio0
 */
class Alquileres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alquileres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idSocio', 'idCampo', 'horas', 'personas'], 'integer'],
            [['fechaHora'], 'safe'],
            [['precioTotal'], 'number'],
            [['idSocio', 'idCampo', 'fechaHora'], 'unique', 'targetAttribute' => ['idSocio', 'idCampo', 'fechaHora']],
            [['id'], 'unique'],
            [['idCampo'], 'exist', 'skipOnError' => true, 'targetClass' => Campos::class, 'targetAttribute' => ['idCampo' => 'id']],
            [['idSocio'], 'exist', 'skipOnError' => true, 'targetClass' => Socios::class, 'targetAttribute' => ['idSocio' => 'id']],
            [['idCampo', 'fechaHora'], 'validateReservation'],
            ['horas', 'calculatePrecioTotal'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idSocio' => 'Id Socio',
            'idCampo' => 'Id Campo',
            'fechaHora' => 'Fecha Hora',
            'horas' => 'Horas',
            'personas' => 'Personas',
            'precioTotal' => 'Precio Total',
        ];
    }

    /**
     * Gets query for [[IdCampo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdCampo0()
    {
        return $this->hasOne(Campos::class, ['id' => 'idCampo']);
    }

    /**
     * Gets query for [[IdSocio0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdSocio0()
    {
        return $this->hasOne(Socios::class, ['id' => 'idSocio']);
    }

    /**
     * Custom validation rule to check for duplicate reservations.
     */
public function validateReservation($attribute, $params)
{
    if (!$this->hasErrors()) {
        $existingReservation = self::find()
            ->where(['idCampo' => $this->idCampo])
            ->andWhere(['fechaHora' => $this->fechaHora])
             ->andWhere(['horas' => $this->horas])
            ->one();

        if ($existingReservation !== null) {
            $this->addError($attribute, 'A reservation already exists for the selected campo, date, and period.');
        } else {
            if ($this->horas == 2) {
                $nextHour = new DateTime($this->fechaHora.":00:00");
                $nextHour->add(new DateInterval('PT1H'));

                $existingReservationNextHour = self::find()
                    ->where(['idCampo' => $this->idCampo])
                    ->andWhere(['fechaHora' => $nextHour->format('Y-m-d H:i:s')])
                    ->one();

                if ($existingReservationNextHour !== null) {
                    $this->addError($attribute, 'A reservation already exists for the selected campo and one hour later.');
                }
            }else{
                $lastHour = new DateTime($this->fechaHora . ":00:00");
                $lastHour->sub(new DateInterval('PT1H'));

                $existingReservationLastHour=self::find()
                ->where(['idCampo' => $this->idCampo])
                ->andWhere(['fechaHora' => $lastHour->format('Y-m-d H:i:s')])
                ->andWhere(["horas"=>2])
                ->one();

                if ($existingReservationLastHour !== null) {
                    $this->addError($attribute, 'Last Resrervation has 2 hours try to reserve 1 hour later.');
                }
            }
        }
    }
}
public function calculatePrecioTotal($attribute, $params)
{
    $campo = $this->idCampo0; // Access the linked Campo model
    $precio = $campo->precio;
    $this->precioTotal = $this->horas * $precio;
}




    /**
     * Retrieves a list of available campos for dropdown.
     *
     * @return array
     */
    public function getCampos()
    {
        $campos = Campos::find()->all();
        return ArrayHelper::map($campos, 'id', 'nombre');
    }

    /**
     * Retrieves a list of available socios for dropdown.
     *
     * @return array
     */
    public function getSocios()
    {
        $socios = Socios::find()->all();
        return ArrayHelper::map($socios, 'id', 'nombre');
    }
}
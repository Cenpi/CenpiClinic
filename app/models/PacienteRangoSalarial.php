<?php



class PacienteRangoSalarial extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idRangoSalarial;

    /**
     *
     * @var string
     */
    public $nombreRangoSalarial;

    /**
     *
     * @var string
     */
    public $porcentaje;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("paciente_rango_salarial");
        $this->hasMany('idRangoSalarial', 'Paciente', 'rangoSalarial', ['alias' => 'Paciente']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'paciente_rango_salarial';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PacienteRangoSalarial[]|PacienteRangoSalarial|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PacienteRangoSalarial|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

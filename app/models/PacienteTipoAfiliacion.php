<?php


class PacienteTipoAfiliacion extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idTipoAfiliacion;

    /**
     *
     * @var string
     */
    public $nombreTipoAfiliacion;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("");
        $this->setSource("paciente_tipo_afiliacion");
        $this->hasMany('idTipoAfiliacion', 'Paciente', 'tipoAfiliacion', ['alias' => 'Paciente']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'paciente_tipo_afiliacion';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PacienteTipoAfiliacion[]|PacienteTipoAfiliacion|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PacienteTipoAfiliacion|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

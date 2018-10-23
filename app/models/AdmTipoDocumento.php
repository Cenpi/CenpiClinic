<?php



class AdmTipoDocumento extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idTipoDocumento;

    /**
     *
     * @var string
     */
    public $nombreTipoDocumento;

    /**
     *
     * @var string
     */
    public $iniciales;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("adm_tipo_documento");
        $this->hasMany('idTipoDocumento', 'Paciente', 'tipoDocumento', ['alias' => 'Paciente']);
        $this->hasMany('idTipoDocumento', 'Usuario', 'tipoDocumento', ['alias' => 'Usuario']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'adm_tipo_documento';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmTipoDocumento[]|AdmTipoDocumento|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmTipoDocumento|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

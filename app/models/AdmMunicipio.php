<?php



class AdmMunicipio extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idMunicipio;

    /**
     *
     * @var string
     */
    public $nombreMunicipio;

    /**
     *
     * @var integer
     */
    public $provincia;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("adm_municipio");
        $this->hasMany('idMunicipio', 'Paciente', 'municipio', ['alias' => 'Paciente']);
        $this->belongsTo('provincia', 'AdmProvincia', 'idProvincia', ['alias' => 'AdmProvincia']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'adm_municipio';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmMunicipio[]|AdmMunicipio|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmMunicipio|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

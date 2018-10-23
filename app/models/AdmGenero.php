<?php



class AdmGenero extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idGenero;

    /**
     *
     * @var string
     */
    public $nombreGenero;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("adm_genero");
        $this->hasMany('idGenero', 'Paciente', 'genero', ['alias' => 'Paciente']);
        $this->hasMany('idGenero', 'Usuario', 'genero', ['alias' => 'Usuario']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'adm_genero';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmGenero[]|AdmGenero|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmGenero|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

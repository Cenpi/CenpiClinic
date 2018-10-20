<?php



class AdmEps extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idEps;

    /**
     *
     * @var string
     */
    public $nitEps;

    /**
     *
     * @var string
     */
    public $nombreEps;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("adm_eps");
        $this->hasMany('idEps', '\Paciente', 'eps', ['alias' => 'Paciente']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'adm_eps';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmEps[]|AdmEps|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmEps|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

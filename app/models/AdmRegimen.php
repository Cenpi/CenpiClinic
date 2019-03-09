<?php



class AdmRegimen extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idRegimen;

    /**
     *
     * @var string
     */
    public $nombreRegimen;

    /**
     *
     * @var string
     */
    public $descRegimen;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("adm_regimen");
        $this->hasMany('idRegimen', 'Paciente', 'regimen', ['alias' => 'Paciente']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'adm_regimen';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmRegimen[]|AdmRegimen|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmRegimen|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

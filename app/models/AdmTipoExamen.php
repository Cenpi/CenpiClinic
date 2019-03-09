<?php

class AdmTipoExamen extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idTipoExamen;

    /**
     *
     * @var string
     */
    public $nombreExamen;

    /**
     *
     * @var string
     */
    public $descTipoExamen;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("adm_tipoExamen");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'adm_tipoExamen';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmTipoExamen[]|AdmTipoExamen|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmTipoExamen|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

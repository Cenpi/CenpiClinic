<?php



class PacienteParentezco extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idParentezco;

    /**
     *
     * @var string
     */
    public $nombreParentezco;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("paciente_parentezco");
        $this->hasMany('idParentezco', 'Paciente', 'parentezco', ['alias' => 'Paciente']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'paciente_parentezco';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PacienteParentezco[]|PacienteParentezco|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PacienteParentezco|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

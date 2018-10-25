<?php



class UsuarioEstado extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idEstado;

    /**
     *
     * @var string
     */
    public $nombreEstado;

    /**
     *
     * @var string
     */
    public $descEstado;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("usuario_estado");
        $this->hasMany('idEstado', 'Usuario', 'estado', ['alias' => 'Usuario']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'usuario_estado';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UsuarioEstado[]|UsuarioEstado|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UsuarioEstado|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

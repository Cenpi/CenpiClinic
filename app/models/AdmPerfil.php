<?php



class AdmPerfil extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idPerfil;

    /**
     *
     * @var string
     */
    public $nombrePerfil;

    /**
     *
     * @var string
     */
    public $descPerfil;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("adm_perfil");
        $this->hasMany('idPerfil', 'AdmPermiso', 'perfil', ['alias' => 'AdmPermiso']);
        $this->hasMany('idPerfil', 'Usuario', 'perfil', ['alias' => 'Usuario']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'adm_perfil';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmPerfil[]|AdmPerfil|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdmPerfil|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

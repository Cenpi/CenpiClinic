<?php


Use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class Usuario extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idUsuario;

    /**
     *
     * @var integer
     */
    public $tipoDocumento;

    /**
     *
     * @var string
     */
    public $documento;

    /**
     *
     * @var string
     */
    public $primerNombre;

    /**
     *
     * @var string
     */
    public $segundoNombre;

    /**
     *
     * @var string
     */
    public $primerApellido;

    /**
     *
     * @var string
     */
    public $segundoApellido;

    /**
     *
     * @var string
     */
    public $direccion;

    /**
     *
     * @var integer
     */
    public $genero;

    /**
     *
     * @var string
     */
    public $correo;

    /**
     *
     * @var string
     */
    public $telefono;

    /**
     *
     * @var string
     */
    public $contrasena;

    /**
     *
     * @var string
     */
    public $fechaNacimiento;

    /**
     *
     * @var integer
     */
    public $estado;

    /**
     *
     * @var integer
     */
    public $perfil;

    /**
     *
     * @var string
     */
    public $fechaCreacion;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("usuario");
        $this->hasMany('idUsuario', 'Asistencial', 'usuario', ['alias' => 'Asistencial']);
        $this->belongsTo('tipoDocumento', 'AdmTipoDocumento', 'idTipoDocumento', ['alias' => 'AdmTipoDocumento']);
        $this->belongsTo('genero', 'AdmGenero', 'idGenero', ['alias' => 'AdmGenero']);
        $this->belongsTo('estado', 'UsuarioEstado', 'idEstado', ['alias' => 'UsuarioEstado']);
        $this->belongsTo('perfil', 'AdmPerfil', 'idPerfil', ['alias' => 'AdmPerfil']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'usuario';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Usuario[]|Usuario|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Usuario|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

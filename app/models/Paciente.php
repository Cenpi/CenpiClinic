<?php



use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class Paciente extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idPaciente;

    /**
     *
     * @var integer
     */
    public $tipoDocumento;

    /**
     *
     * @var string
     */
    public $fechaNacimiento;

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
     * @var integer
     */
    public $genero;

    /**
     *
     * @var string
     */
    public $direccion;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $telefono;

    /**
     *
     * @var string
     */
    public $celular;

    /**
     *
     * @var integer
     */
    public $eps;

    /**
     *
     * @var integer
     */
    public $municipio;

    /**
     *
     * @var integer
     */
    public $zona;

    /**
     *
     * @var integer
     */
    public $regimen;

    /**
     *
     * @var integer
     */
    public $tipoAfiliacion;

    /**
     *
     * @var integer
     */
    public $parentezco;

    /**
     *
     * @var integer
     */
    public $rangoSalarial;

    /**
     *
     * @var string
     */
    public $fechaIngreso;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cenpiclinic");
        $this->setSource("paciente");
        $this->belongsTo('tipoDocumento', 'AdmTipoDocumento', 'idTipoDocumento', ['alias' => 'AdmTipoDocumento']);
        $this->belongsTo('genero', '\AdmGenero', 'idGenero', ['alias' => 'AdmGenero']);
        $this->belongsTo('eps', 'AdmEps', 'idEps', ['alias' => 'AdmEps']);
        $this->belongsTo('municipio', 'AdmMunicipio', 'idMunicipio', ['alias' => 'AdmMunicipio']);
        $this->belongsTo('zona', 'AdmZona', 'idZona', ['alias' => 'AdmZona']);
        $this->belongsTo('regimen', 'AdmRegimen', 'idRegimen', ['alias' => 'AdmRegimen']);
        $this->belongsTo('tipoAfiliacion', 'PacienteTipoAfiliacion', 'idTipoAfiliacion', ['alias' => 'PacienteTipoAfiliacion']);
        $this->belongsTo('parentezco', 'PacienteParentezco', 'idParentezco', ['alias' => 'PacienteParentezco']);
        $this->belongsTo('rangoSalarial', 'PacienteRangoSalarial', 'idRangoSalarial', ['alias' => 'PacienteRangoSalarial']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'paciente';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Paciente[]|Paciente|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Paciente|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

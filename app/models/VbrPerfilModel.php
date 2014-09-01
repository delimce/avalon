<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class VbrPerfilModel {
	private static $CLASS_NAME='VbrPerfilModel';
	const SQL_IDENTIFIER_QUOTE='"';
	const SQL_TABLE_NAME='vbr_perfil';
	const SQL_INSERT='INSERT INTO "vbr_perfil" ("id","descripcion") VALUES (?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO "vbr_perfil" ("descripcion") VALUES (?)';
	const SQL_UPDATE='UPDATE "vbr_perfil" SET "id"=?,"descripcion"=? WHERE "id"=?';
	const SQL_SELECT_PK='SELECT * FROM "vbr_perfil" WHERE "id"=?';
	const SQL_DELETE_PK='DELETE FROM "vbr_perfil" WHERE "id"=?';
	const FIELD_ID=-204190012;
	const FIELD_DESCRIPCION=-1643227612;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_DESCRIPCION=>'descripcion');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_DESCRIPCION=>'descripcion');
	
	private $id;
	private $descripcion;

	/**
	 * set value for id perfil de ususario por defecto al crearlo es invitado: 10
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return VbrPerfilModel
	 */
	public function &setId($id) {
		$this->notifyChanged(self::FIELD_ID,$this->id,$id);
		$this->id=$id;
		return $this;
	}

	/**
	 * get value for id perfil de ususario por defecto al crearlo es invitado: 10
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * set value for descripcion 
	 *
	 * type:VARCHAR,size:255,default:null
	 *
	 * @param mixed $descripcion
	 * @return VbrPerfilModel
	 */
	public function &setDescripcion($descripcion) {
		$this->notifyChanged(self::FIELD_DESCRIPCION,$this->descripcion,$descripcion);
		$this->descripcion=$descripcion;
		return $this;
	}

	/**
	 * get value for descripcion 
	 *
	 * type:VARCHAR,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}

	/**
	 * Get table name
	 *
	 * @return string
	 */
	public static function getTableName() {
		return self::SQL_TABLE_NAME;
	}

	/**
	 * Get array with field id as index and field name as value
	 *
	 * @return array
	 */
	public static function getFieldNames() {
		return self::$FIELD_NAMES;
	}

	/**
	 * Get array with field id as index and property name as value
	 *
	 * @return array
	 */
	public static function getPropertyNames() {
		return self::$PROPERTY_NAMES;
	}

	/**
	 * get the field name for the passed field id.
	 *
	 * @param int $fieldId
	 * @param bool $fullyQualifiedName true if field name should be qualified by table name
	 * @return string field name for the passed field id, null if the field doesn't exist
	 */
	public static function getFieldNameByFieldId($fieldId, $fullyQualifiedName=true) {
		if (!array_key_exists($fieldId, self::$FIELD_NAMES)) {
			return null;
		}
		$fieldName=self::SQL_IDENTIFIER_QUOTE . self::$FIELD_NAMES[$fieldId] . self::SQL_IDENTIFIER_QUOTE;
		if ($fullyQualifiedName) {
			return self::SQL_IDENTIFIER_QUOTE . self::SQL_TABLE_NAME . self::SQL_IDENTIFIER_QUOTE . '.' . $fieldName;
		}
		return $fieldName;
	}

	/**
	 * Get array with field ids of identifiers
	 *
	 * @return array
	 */
	public static function getIdentifierFields() {
		return self::$PRIMARY_KEYS;
	}

	/**
	 * Get array with field ids of autoincrement fields
	 *
	 * @return array
	 */
	public static function getAutoincrementFields() {
		return self::$AUTOINCREMENT_FIELDS;
	}

	/**
	 * Get array with field id as index and property type as value
	 *
	 * @return array
	 */
	public static function getPropertyTypes() {
		return self::$PROPERTY_TYPES;
	}

	/**
	 * Get array with field id as index and field type as value
	 *
	 * @return array
	 */
	public static function getFieldTypes() {
		return self::$FIELD_TYPES;
	}

	/**
	 * Assign default values according to table
	 * 
	 */
	public function assignDefaultValues() {
		$this->assignByArray(self::$DEFAULT_VALUES);
	}


	public function validar(){
            
            $db = new ObjectDB();
            
        }

}
?>
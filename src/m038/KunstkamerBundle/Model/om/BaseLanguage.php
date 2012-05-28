<?php

namespace m038\KunstkamerBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use m038\KunstkamerBundle\Model\LanguagePeer;
use m038\KunstkamerBundle\Model\LanguageQuery;
use m038\KunstkamerBundle\Model\MediaLang;
use m038\KunstkamerBundle\Model\MediaLangQuery;
use m038\KunstkamerBundle\Model\Page;
use m038\KunstkamerBundle\Model\PageQuery;

/**
 * Base class that represents a row from the 'tblLanguages' table.
 *
 * 
 *
 * @package    propel.generator.src.m038.KunstkamerBundle.Model.om
 */
abstract class BaseLanguage extends BaseObject 
{

    /**
     * Peer class name
     */
    const PEER = 'm038\\KunstkamerBundle\\Model\\LanguagePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LanguagePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the intid field.
     * @var        int
     */
    protected $intid;

    /**
     * The value for the strname field.
     * @var        string
     */
    protected $strname;

    /**
     * The value for the strabbreviation field.
     * @var        string
     */
    protected $strabbreviation;

    /**
     * The value for the strlocale field.
     * @var        string
     */
    protected $strlocale;

    /**
     * @var        array MediaLang[] Collection to store aggregation of MediaLang objects.
     */
    protected $collMediaLangs;

    /**
     * @var        array Page[] Collection to store aggregation of Page objects.
     */
    protected $collPages;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		array
     */
    protected $mediaLangsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		array
     */
    protected $pagesScheduledForDeletion = null;

    /**
     * Get the [intid] column value.
     * 
     * @return   int
     */
    public function getid()
    {

        return $this->intid;
    }

    /**
     * Get the [strname] column value.
     * 
     * @return   string
     */
    public function getname()
    {

        return $this->strname;
    }

    /**
     * Get the [strabbreviation] column value.
     * 
     * @return   string
     */
    public function getabbreviation()
    {

        return $this->strabbreviation;
    }

    /**
     * Get the [strlocale] column value.
     * 
     * @return   string
     */
    public function getlocale()
    {

        return $this->strlocale;
    }

    /**
     * Set the value of [intid] column.
     * 
     * @param      int $v new value
     * @return   Language The current object (for fluent API support)
     */
    public function setid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->intid !== $v) {
            $this->intid = $v;
            $this->modifiedColumns[] = LanguagePeer::INTID;
        }


        return $this;
    } // setid()

    /**
     * Set the value of [strname] column.
     * 
     * @param      string $v new value
     * @return   Language The current object (for fluent API support)
     */
    public function setname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->strname !== $v) {
            $this->strname = $v;
            $this->modifiedColumns[] = LanguagePeer::STRNAME;
        }


        return $this;
    } // setname()

    /**
     * Set the value of [strabbreviation] column.
     * 
     * @param      string $v new value
     * @return   Language The current object (for fluent API support)
     */
    public function setabbreviation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->strabbreviation !== $v) {
            $this->strabbreviation = $v;
            $this->modifiedColumns[] = LanguagePeer::STRABBREVIATION;
        }


        return $this;
    } // setabbreviation()

    /**
     * Set the value of [strlocale] column.
     * 
     * @param      string $v new value
     * @return   Language The current object (for fluent API support)
     */
    public function setlocale($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->strlocale !== $v) {
            $this->strlocale = $v;
            $this->modifiedColumns[] = LanguagePeer::STRLOCALE;
        }


        return $this;
    } // setlocale()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->intid = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->strname = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->strabbreviation = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->strlocale = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = LanguagePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Language object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LanguagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collMediaLangs = null;

            $this->collPages = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      PropelPDO $con
     * @return void
     * @throws PropelException
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LanguageQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                LanguagePeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->mediaLangsScheduledForDeletion !== null) {
                if (!$this->mediaLangsScheduledForDeletion->isEmpty()) {
                    MediaLangQuery::create()
                        ->filterByPrimaryKeys($this->mediaLangsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->mediaLangsScheduledForDeletion = null;
                }
            }

            if ($this->collMediaLangs !== null) {
                foreach ($this->collMediaLangs as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pagesScheduledForDeletion !== null) {
                if (!$this->pagesScheduledForDeletion->isEmpty()) {
                    PageQuery::create()
                        ->filterByPrimaryKeys($this->pagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pagesScheduledForDeletion = null;
                }
            }

            if ($this->collPages !== null) {
                foreach ($this->collPages as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = LanguagePeer::INTID;
        if (null !== $this->intid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LanguagePeer::INTID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LanguagePeer::INTID)) {
            $modifiedColumns[':p' . $index++]  = '`INTID`';
        }
        if ($this->isColumnModified(LanguagePeer::STRNAME)) {
            $modifiedColumns[':p' . $index++]  = '`STRNAME`';
        }
        if ($this->isColumnModified(LanguagePeer::STRABBREVIATION)) {
            $modifiedColumns[':p' . $index++]  = '`STRABBREVIATION`';
        }
        if ($this->isColumnModified(LanguagePeer::STRLOCALE)) {
            $modifiedColumns[':p' . $index++]  = '`STRLOCALE`';
        }

        $sql = sprintf(
            'INSERT INTO `tblLanguages` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`INTID`':
						$stmt->bindValue($identifier, $this->intid, PDO::PARAM_INT);
                        break;
                    case '`STRNAME`':
						$stmt->bindValue($identifier, $this->strname, PDO::PARAM_STR);
                        break;
                    case '`STRABBREVIATION`':
						$stmt->bindValue($identifier, $this->strabbreviation, PDO::PARAM_STR);
                        break;
                    case '`STRLOCALE`':
						$stmt->bindValue($identifier, $this->strlocale, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
			$pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setid($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param      mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        } else {
            $this->validationFailures = $res;

            return false;
        }
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param      array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = LanguagePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collMediaLangs !== null) {
                    foreach ($this->collMediaLangs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPages !== null) {
                    foreach ($this->collPages as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = LanguagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getid();
                break;
            case 1:
                return $this->getname();
                break;
            case 2:
                return $this->getabbreviation();
                break;
            case 3:
                return $this->getlocale();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Language'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Language'][$this->getPrimaryKey()] = true;
        $keys = LanguagePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getid(),
            $keys[1] => $this->getname(),
            $keys[2] => $this->getabbreviation(),
            $keys[3] => $this->getlocale(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collMediaLangs) {
                $result['MediaLangs'] = $this->collMediaLangs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPages) {
                $result['Pages'] = $this->collPages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name peer name
     * @param      mixed $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = LanguagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setid($value);
                break;
            case 1:
                $this->setname($value);
                break;
            case 2:
                $this->setabbreviation($value);
                break;
            case 3:
                $this->setlocale($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = LanguagePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setid($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setname($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setabbreviation($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setlocale($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LanguagePeer::DATABASE_NAME);

        if ($this->isColumnModified(LanguagePeer::INTID)) $criteria->add(LanguagePeer::INTID, $this->intid);
        if ($this->isColumnModified(LanguagePeer::STRNAME)) $criteria->add(LanguagePeer::STRNAME, $this->strname);
        if ($this->isColumnModified(LanguagePeer::STRABBREVIATION)) $criteria->add(LanguagePeer::STRABBREVIATION, $this->strabbreviation);
        if ($this->isColumnModified(LanguagePeer::STRLOCALE)) $criteria->add(LanguagePeer::STRLOCALE, $this->strlocale);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(LanguagePeer::DATABASE_NAME);
        $criteria->add(LanguagePeer::INTID, $this->intid);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return   int
     */
    public function getPrimaryKey()
    {
        return $this->getid();
    }

    /**
     * Generic method to set the primary key (intid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of Language (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setname($this->getname());
        $copyObj->setabbreviation($this->getabbreviation());
        $copyObj->setlocale($this->getlocale());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getMediaLangs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMediaLang($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPage($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setid(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return                 Language Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return   LanguagePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LanguagePeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('MediaLang' == $relationName) {
            return $this->initMediaLangs();
        }
        if ('Page' == $relationName) {
            return $this->initPages();
        }
    }

    /**
     * Clears out the collMediaLangs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMediaLangs()
     */
    public function clearMediaLangs()
    {
        $this->collMediaLangs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collMediaLangs collection.
     *
     * By default this just sets the collMediaLangs collection to an empty array (like clearcollMediaLangs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMediaLangs($overrideExisting = true)
    {
        if (null !== $this->collMediaLangs && !$overrideExisting) {
            return;
        }
        $this->collMediaLangs = new PropelObjectCollection();
        $this->collMediaLangs->setModel('MediaLang');
    }

    /**
     * Gets an array of MediaLang objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Language is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @return PropelCollection|array MediaLang[] List of MediaLang objects
     * @throws PropelException
     */
    public function getMediaLangs($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collMediaLangs || null !== $criteria) {
            if ($this->isNew() && null === $this->collMediaLangs) {
                // return empty collection
                $this->initMediaLangs();
            } else {
                $collMediaLangs = MediaLangQuery::create(null, $criteria)
                    ->filterByLanguage($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collMediaLangs;
                }
                $this->collMediaLangs = $collMediaLangs;
            }
        }

        return $this->collMediaLangs;
    }

    /**
     * Sets a collection of MediaLang objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      PropelCollection $mediaLangs A Propel collection.
     * @param      PropelPDO $con Optional connection object
     */
    public function setMediaLangs(PropelCollection $mediaLangs, PropelPDO $con = null)
    {
        $this->mediaLangsScheduledForDeletion = $this->getMediaLangs(new Criteria(), $con)->diff($mediaLangs);

        foreach ($mediaLangs as $mediaLang) {
            // Fix issue with collection modified by reference
            if ($mediaLang->isNew()) {
                $mediaLang->setLanguage($this);
            }
            $this->addMediaLang($mediaLang);
        }

        $this->collMediaLangs = $mediaLangs;
    }

    /**
     * Returns the number of related MediaLang objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      PropelPDO $con
     * @return int             Count of related MediaLang objects.
     * @throws PropelException
     */
    public function countMediaLangs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collMediaLangs || null !== $criteria) {
            if ($this->isNew() && null === $this->collMediaLangs) {
                return 0;
            } else {
                $query = MediaLangQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByLanguage($this)
                    ->count($con);
            }
        } else {
            return count($this->collMediaLangs);
        }
    }

    /**
     * Method called to associate a MediaLang object to this object
     * through the MediaLang foreign key attribute.
     *
     * @param    MediaLang $l MediaLang
     * @return   Language The current object (for fluent API support)
     */
    public function addMediaLang(MediaLang $l)
    {
        if ($this->collMediaLangs === null) {
            $this->initMediaLangs();
        }
        if (!$this->collMediaLangs->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddMediaLang($l);
        }

        return $this;
    }

    /**
     * @param	MediaLang $mediaLang The mediaLang object to add.
     */
    protected function doAddMediaLang($mediaLang)
    {
        $this->collMediaLangs[]= $mediaLang;
        $mediaLang->setLanguage($this);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Language is new, it will return
     * an empty collection; or if this Language has previously
     * been saved, it will retrieve related MediaLangs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Language.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelCollection|array MediaLang[] List of MediaLang objects
     */
    public function getMediaLangsJoinMedia($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = MediaLangQuery::create(null, $criteria);
        $query->joinWith('Media', $join_behavior);

        return $this->getMediaLangs($query, $con);
    }

    /**
     * Clears out the collPages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPages()
     */
    public function clearPages()
    {
        $this->collPages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collPages collection.
     *
     * By default this just sets the collPages collection to an empty array (like clearcollPages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPages($overrideExisting = true)
    {
        if (null !== $this->collPages && !$overrideExisting) {
            return;
        }
        $this->collPages = new PropelObjectCollection();
        $this->collPages->setModel('Page');
    }

    /**
     * Gets an array of Page objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Language is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @return PropelCollection|array Page[] List of Page objects
     * @throws PropelException
     */
    public function getPages($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPages || null !== $criteria) {
            if ($this->isNew() && null === $this->collPages) {
                // return empty collection
                $this->initPages();
            } else {
                $collPages = PageQuery::create(null, $criteria)
                    ->filterByLanguage($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPages;
                }
                $this->collPages = $collPages;
            }
        }

        return $this->collPages;
    }

    /**
     * Sets a collection of Page objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      PropelCollection $pages A Propel collection.
     * @param      PropelPDO $con Optional connection object
     */
    public function setPages(PropelCollection $pages, PropelPDO $con = null)
    {
        $this->pagesScheduledForDeletion = $this->getPages(new Criteria(), $con)->diff($pages);

        foreach ($pages as $page) {
            // Fix issue with collection modified by reference
            if ($page->isNew()) {
                $page->setLanguage($this);
            }
            $this->addPage($page);
        }

        $this->collPages = $pages;
    }

    /**
     * Returns the number of related Page objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      PropelPDO $con
     * @return int             Count of related Page objects.
     * @throws PropelException
     */
    public function countPages(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPages || null !== $criteria) {
            if ($this->isNew() && null === $this->collPages) {
                return 0;
            } else {
                $query = PageQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByLanguage($this)
                    ->count($con);
            }
        } else {
            return count($this->collPages);
        }
    }

    /**
     * Method called to associate a Page object to this object
     * through the Page foreign key attribute.
     *
     * @param    Page $l Page
     * @return   Language The current object (for fluent API support)
     */
    public function addPage(Page $l)
    {
        if ($this->collPages === null) {
            $this->initPages();
        }
        if (!$this->collPages->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddPage($l);
        }

        return $this;
    }

    /**
     * @param	Page $page The page object to add.
     */
    protected function doAddPage($page)
    {
        $this->collPages[]= $page;
        $page->setLanguage($this);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Language is new, it will return
     * an empty collection; or if this Language has previously
     * been saved, it will retrieve related Pages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Language.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelCollection|array Page[] List of Page objects
     */
    public function getPagesJoinPageRelatedByparentpage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PageQuery::create(null, $criteria);
        $query->joinWith('PageRelatedByparentpage', $join_behavior);

        return $this->getPages($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Language is new, it will return
     * an empty collection; or if this Language has previously
     * been saved, it will retrieve related Pages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Language.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelCollection|array Page[] List of Page objects
     */
    public function getPagesJoinPageType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PageQuery::create(null, $criteria);
        $query->joinWith('PageType', $join_behavior);

        return $this->getPages($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->intid = null;
        $this->strname = null;
        $this->strabbreviation = null;
        $this->strlocale = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collMediaLangs) {
                foreach ($this->collMediaLangs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPages) {
                foreach ($this->collPages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collMediaLangs instanceof PropelCollection) {
            $this->collMediaLangs->clearIterator();
        }
        $this->collMediaLangs = null;
        if ($this->collPages instanceof PropelCollection) {
            $this->collPages->clearIterator();
        }
        $this->collPages = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LanguagePeer::DEFAULT_STRING_FORMAT);
    }

} // BaseLanguage

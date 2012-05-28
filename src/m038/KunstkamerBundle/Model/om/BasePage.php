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
use m038\KunstkamerBundle\Model\Language;
use m038\KunstkamerBundle\Model\LanguageQuery;
use m038\KunstkamerBundle\Model\Page;
use m038\KunstkamerBundle\Model\PageMedia;
use m038\KunstkamerBundle\Model\PageMediaQuery;
use m038\KunstkamerBundle\Model\PagePeer;
use m038\KunstkamerBundle\Model\PageQuery;
use m038\KunstkamerBundle\Model\PageType;
use m038\KunstkamerBundle\Model\PageTypeCustom;
use m038\KunstkamerBundle\Model\PageTypeCustomQuery;
use m038\KunstkamerBundle\Model\PageTypeMedia;
use m038\KunstkamerBundle\Model\PageTypeMediaQuery;
use m038\KunstkamerBundle\Model\PageTypeQuery;
use m038\KunstkamerBundle\Model\PageTypeText;
use m038\KunstkamerBundle\Model\PageTypeTextQuery;

/**
 * Base class that represents a row from the 'tblPages' table.
 *
 * 
 *
 * @package    propel.generator.src.m038.KunstkamerBundle.Model.om
 */
abstract class BasePage extends BaseObject 
{

    /**
     * Peer class name
     */
    const PEER = 'm038\\KunstkamerBundle\\Model\\PagePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PagePeer
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
     * The value for the intparentpageid field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $intparentpageid;

    /**
     * The value for the inttypeid field.
     * @var        int
     */
    protected $inttypeid;

    /**
     * The value for the intlanguageid field.
     * @var        int
     */
    protected $intlanguageid;

    /**
     * The value for the intvisible field.
     * @var        int
     */
    protected $intvisible;

    /**
     * The value for the intorder field.
     * @var        int
     */
    protected $intorder;

    /**
     * The value for the strtitle field.
     * @var        string
     */
    protected $strtitle;

    /**
     * The value for the strslug field.
     * @var        string
     */
    protected $strslug;

    /**
     * @var        Page
     */
    protected $aPageRelatedByparentpage;

    /**
     * @var        Language
     */
    protected $aLanguage;

    /**
     * @var        PageType
     */
    protected $aPageType;

    /**
     * @var        array PageMedia[] Collection to store aggregation of PageMedia objects.
     */
    protected $collPageMedias;

    /**
     * @var        array PageTypeCustom[] Collection to store aggregation of PageTypeCustom objects.
     */
    protected $collPageTypeCustoms;

    /**
     * @var        array PageTypeMedia[] Collection to store aggregation of PageTypeMedia objects.
     */
    protected $collPageTypeMedias;

    /**
     * @var        array PageTypeText[] Collection to store aggregation of PageTypeText objects.
     */
    protected $collPageTypeTexts;

    /**
     * @var        array Page[] Collection to store aggregation of Page objects.
     */
    protected $collPagesRelatedByid;

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
    protected $pageMediasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		array
     */
    protected $pageTypeCustomsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		array
     */
    protected $pageTypeMediasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		array
     */
    protected $pageTypeTextsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		array
     */
    protected $pagesRelatedByidScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->intparentpageid = 0;
    }

    /**
     * Initializes internal state of BasePage object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

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
     * Get the [intparentpageid] column value.
     * 
     * @return   int
     */
    public function getparentpage()
    {

        return $this->intparentpageid;
    }

    /**
     * Get the [inttypeid] column value.
     * 
     * @return   int
     */
    public function gettype()
    {

        return $this->inttypeid;
    }

    /**
     * Get the [intlanguageid] column value.
     * 
     * @return   int
     */
    public function getlanguage()
    {

        return $this->intlanguageid;
    }

    /**
     * Get the [intvisible] column value.
     * 
     * @return   int
     */
    public function getvisibl()
    {

        return $this->intvisible;
    }

    /**
     * Get the [intorder] column value.
     * 
     * @return   int
     */
    public function getorder()
    {

        return $this->intorder;
    }

    /**
     * Get the [strtitle] column value.
     * 
     * @return   string
     */
    public function gettitle()
    {

        return $this->strtitle;
    }

    /**
     * Get the [strslug] column value.
     * 
     * @return   string
     */
    public function getslug()
    {

        return $this->strslug;
    }

    /**
     * Set the value of [intid] column.
     * 
     * @param      int $v new value
     * @return   Page The current object (for fluent API support)
     */
    public function setid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->intid !== $v) {
            $this->intid = $v;
            $this->modifiedColumns[] = PagePeer::INTID;
        }


        return $this;
    } // setid()

    /**
     * Set the value of [intparentpageid] column.
     * 
     * @param      int $v new value
     * @return   Page The current object (for fluent API support)
     */
    public function setparentpage($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->intparentpageid !== $v) {
            $this->intparentpageid = $v;
            $this->modifiedColumns[] = PagePeer::INTPARENTPAGEID;
        }

        if ($this->aPageRelatedByparentpage !== null && $this->aPageRelatedByparentpage->getid() !== $v) {
            $this->aPageRelatedByparentpage = null;
        }


        return $this;
    } // setparentpage()

    /**
     * Set the value of [inttypeid] column.
     * 
     * @param      int $v new value
     * @return   Page The current object (for fluent API support)
     */
    public function settype($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->inttypeid !== $v) {
            $this->inttypeid = $v;
            $this->modifiedColumns[] = PagePeer::INTTYPEID;
        }

        if ($this->aPageType !== null && $this->aPageType->getid() !== $v) {
            $this->aPageType = null;
        }


        return $this;
    } // settype()

    /**
     * Set the value of [intlanguageid] column.
     * 
     * @param      int $v new value
     * @return   Page The current object (for fluent API support)
     */
    public function setlanguage($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->intlanguageid !== $v) {
            $this->intlanguageid = $v;
            $this->modifiedColumns[] = PagePeer::INTLANGUAGEID;
        }

        if ($this->aLanguage !== null && $this->aLanguage->getid() !== $v) {
            $this->aLanguage = null;
        }


        return $this;
    } // setlanguage()

    /**
     * Set the value of [intvisible] column.
     * 
     * @param      int $v new value
     * @return   Page The current object (for fluent API support)
     */
    public function setvisibl($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->intvisible !== $v) {
            $this->intvisible = $v;
            $this->modifiedColumns[] = PagePeer::INTVISIBLE;
        }


        return $this;
    } // setvisibl()

    /**
     * Set the value of [intorder] column.
     * 
     * @param      int $v new value
     * @return   Page The current object (for fluent API support)
     */
    public function setorder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->intorder !== $v) {
            $this->intorder = $v;
            $this->modifiedColumns[] = PagePeer::INTORDER;
        }


        return $this;
    } // setorder()

    /**
     * Set the value of [strtitle] column.
     * 
     * @param      string $v new value
     * @return   Page The current object (for fluent API support)
     */
    public function settitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->strtitle !== $v) {
            $this->strtitle = $v;
            $this->modifiedColumns[] = PagePeer::STRTITLE;
        }


        return $this;
    } // settitle()

    /**
     * Set the value of [strslug] column.
     * 
     * @param      string $v new value
     * @return   Page The current object (for fluent API support)
     */
    public function setslug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->strslug !== $v) {
            $this->strslug = $v;
            $this->modifiedColumns[] = PagePeer::STRSLUG;
        }


        return $this;
    } // setslug()

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
            if ($this->intparentpageid !== 0) {
                return false;
            }

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
            $this->intparentpageid = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->inttypeid = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->intlanguageid = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->intvisible = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->intorder = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->strtitle = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->strslug = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = PagePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Page object", $e);
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

        if ($this->aPageRelatedByparentpage !== null && $this->intparentpageid !== $this->aPageRelatedByparentpage->getid()) {
            $this->aPageRelatedByparentpage = null;
        }
        if ($this->aPageType !== null && $this->inttypeid !== $this->aPageType->getid()) {
            $this->aPageType = null;
        }
        if ($this->aLanguage !== null && $this->intlanguageid !== $this->aLanguage->getid()) {
            $this->aLanguage = null;
        }
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
            $con = Propel::getConnection(PagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPageRelatedByparentpage = null;
            $this->aLanguage = null;
            $this->aPageType = null;
            $this->collPageMedias = null;

            $this->collPageTypeCustoms = null;

            $this->collPageTypeMedias = null;

            $this->collPageTypeTexts = null;

            $this->collPagesRelatedByid = null;

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
            $con = Propel::getConnection(PagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PageQuery::create()
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
            $con = Propel::getConnection(PagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                PagePeer::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aPageRelatedByparentpage !== null) {
                if ($this->aPageRelatedByparentpage->isModified() || $this->aPageRelatedByparentpage->isNew()) {
                    $affectedRows += $this->aPageRelatedByparentpage->save($con);
                }
                $this->setPageRelatedByparentpage($this->aPageRelatedByparentpage);
            }

            if ($this->aLanguage !== null) {
                if ($this->aLanguage->isModified() || $this->aLanguage->isNew()) {
                    $affectedRows += $this->aLanguage->save($con);
                }
                $this->setLanguage($this->aLanguage);
            }

            if ($this->aPageType !== null) {
                if ($this->aPageType->isModified() || $this->aPageType->isNew()) {
                    $affectedRows += $this->aPageType->save($con);
                }
                $this->setPageType($this->aPageType);
            }

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

            if ($this->pageMediasScheduledForDeletion !== null) {
                if (!$this->pageMediasScheduledForDeletion->isEmpty()) {
                    PageMediaQuery::create()
                        ->filterByPrimaryKeys($this->pageMediasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pageMediasScheduledForDeletion = null;
                }
            }

            if ($this->collPageMedias !== null) {
                foreach ($this->collPageMedias as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pageTypeCustomsScheduledForDeletion !== null) {
                if (!$this->pageTypeCustomsScheduledForDeletion->isEmpty()) {
                    PageTypeCustomQuery::create()
                        ->filterByPrimaryKeys($this->pageTypeCustomsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pageTypeCustomsScheduledForDeletion = null;
                }
            }

            if ($this->collPageTypeCustoms !== null) {
                foreach ($this->collPageTypeCustoms as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pageTypeMediasScheduledForDeletion !== null) {
                if (!$this->pageTypeMediasScheduledForDeletion->isEmpty()) {
                    PageTypeMediaQuery::create()
                        ->filterByPrimaryKeys($this->pageTypeMediasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pageTypeMediasScheduledForDeletion = null;
                }
            }

            if ($this->collPageTypeMedias !== null) {
                foreach ($this->collPageTypeMedias as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pageTypeTextsScheduledForDeletion !== null) {
                if (!$this->pageTypeTextsScheduledForDeletion->isEmpty()) {
                    PageTypeTextQuery::create()
                        ->filterByPrimaryKeys($this->pageTypeTextsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pageTypeTextsScheduledForDeletion = null;
                }
            }

            if ($this->collPageTypeTexts !== null) {
                foreach ($this->collPageTypeTexts as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pagesRelatedByidScheduledForDeletion !== null) {
                if (!$this->pagesRelatedByidScheduledForDeletion->isEmpty()) {
                    PageQuery::create()
                        ->filterByPrimaryKeys($this->pagesRelatedByidScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pagesRelatedByidScheduledForDeletion = null;
                }
            }

            if ($this->collPagesRelatedByid !== null) {
                foreach ($this->collPagesRelatedByid as $referrerFK) {
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

        $this->modifiedColumns[] = PagePeer::INTID;
        if (null !== $this->intid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PagePeer::INTID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PagePeer::INTID)) {
            $modifiedColumns[':p' . $index++]  = '`INTID`';
        }
        if ($this->isColumnModified(PagePeer::INTPARENTPAGEID)) {
            $modifiedColumns[':p' . $index++]  = '`INTPARENTPAGEID`';
        }
        if ($this->isColumnModified(PagePeer::INTTYPEID)) {
            $modifiedColumns[':p' . $index++]  = '`INTTYPEID`';
        }
        if ($this->isColumnModified(PagePeer::INTLANGUAGEID)) {
            $modifiedColumns[':p' . $index++]  = '`INTLANGUAGEID`';
        }
        if ($this->isColumnModified(PagePeer::INTVISIBLE)) {
            $modifiedColumns[':p' . $index++]  = '`INTVISIBLE`';
        }
        if ($this->isColumnModified(PagePeer::INTORDER)) {
            $modifiedColumns[':p' . $index++]  = '`INTORDER`';
        }
        if ($this->isColumnModified(PagePeer::STRTITLE)) {
            $modifiedColumns[':p' . $index++]  = '`STRTITLE`';
        }
        if ($this->isColumnModified(PagePeer::STRSLUG)) {
            $modifiedColumns[':p' . $index++]  = '`STRSLUG`';
        }

        $sql = sprintf(
            'INSERT INTO `tblPages` (%s) VALUES (%s)',
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
                    case '`INTPARENTPAGEID`':
						$stmt->bindValue($identifier, $this->intparentpageid, PDO::PARAM_INT);
                        break;
                    case '`INTTYPEID`':
						$stmt->bindValue($identifier, $this->inttypeid, PDO::PARAM_INT);
                        break;
                    case '`INTLANGUAGEID`':
						$stmt->bindValue($identifier, $this->intlanguageid, PDO::PARAM_INT);
                        break;
                    case '`INTVISIBLE`':
						$stmt->bindValue($identifier, $this->intvisible, PDO::PARAM_INT);
                        break;
                    case '`INTORDER`':
						$stmt->bindValue($identifier, $this->intorder, PDO::PARAM_INT);
                        break;
                    case '`STRTITLE`':
						$stmt->bindValue($identifier, $this->strtitle, PDO::PARAM_STR);
                        break;
                    case '`STRSLUG`':
						$stmt->bindValue($identifier, $this->strslug, PDO::PARAM_STR);
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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aPageRelatedByparentpage !== null) {
                if (!$this->aPageRelatedByparentpage->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aPageRelatedByparentpage->getValidationFailures());
                }
            }

            if ($this->aLanguage !== null) {
                if (!$this->aLanguage->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLanguage->getValidationFailures());
                }
            }

            if ($this->aPageType !== null) {
                if (!$this->aPageType->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aPageType->getValidationFailures());
                }
            }


            if (($retval = PagePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPageMedias !== null) {
                    foreach ($this->collPageMedias as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPageTypeCustoms !== null) {
                    foreach ($this->collPageTypeCustoms as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPageTypeMedias !== null) {
                    foreach ($this->collPageTypeMedias as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPageTypeTexts !== null) {
                    foreach ($this->collPageTypeTexts as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPagesRelatedByid !== null) {
                    foreach ($this->collPagesRelatedByid as $referrerFK) {
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
        $pos = PagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getparentpage();
                break;
            case 2:
                return $this->gettype();
                break;
            case 3:
                return $this->getlanguage();
                break;
            case 4:
                return $this->getvisibl();
                break;
            case 5:
                return $this->getorder();
                break;
            case 6:
                return $this->gettitle();
                break;
            case 7:
                return $this->getslug();
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
        if (isset($alreadyDumpedObjects['Page'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Page'][$this->getPrimaryKey()] = true;
        $keys = PagePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getid(),
            $keys[1] => $this->getparentpage(),
            $keys[2] => $this->gettype(),
            $keys[3] => $this->getlanguage(),
            $keys[4] => $this->getvisibl(),
            $keys[5] => $this->getorder(),
            $keys[6] => $this->gettitle(),
            $keys[7] => $this->getslug(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aPageRelatedByparentpage) {
                $result['PageRelatedByparentpage'] = $this->aPageRelatedByparentpage->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLanguage) {
                $result['Language'] = $this->aLanguage->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPageType) {
                $result['PageType'] = $this->aPageType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPageMedias) {
                $result['PageMedias'] = $this->collPageMedias->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPageTypeCustoms) {
                $result['PageTypeCustoms'] = $this->collPageTypeCustoms->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPageTypeMedias) {
                $result['PageTypeMedias'] = $this->collPageTypeMedias->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPageTypeTexts) {
                $result['PageTypeTexts'] = $this->collPageTypeTexts->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPagesRelatedByid) {
                $result['PagesRelatedByid'] = $this->collPagesRelatedByid->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setparentpage($value);
                break;
            case 2:
                $this->settype($value);
                break;
            case 3:
                $this->setlanguage($value);
                break;
            case 4:
                $this->setvisibl($value);
                break;
            case 5:
                $this->setorder($value);
                break;
            case 6:
                $this->settitle($value);
                break;
            case 7:
                $this->setslug($value);
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
        $keys = PagePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setid($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setparentpage($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->settype($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setlanguage($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setvisibl($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setorder($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->settitle($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setslug($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PagePeer::DATABASE_NAME);

        if ($this->isColumnModified(PagePeer::INTID)) $criteria->add(PagePeer::INTID, $this->intid);
        if ($this->isColumnModified(PagePeer::INTPARENTPAGEID)) $criteria->add(PagePeer::INTPARENTPAGEID, $this->intparentpageid);
        if ($this->isColumnModified(PagePeer::INTTYPEID)) $criteria->add(PagePeer::INTTYPEID, $this->inttypeid);
        if ($this->isColumnModified(PagePeer::INTLANGUAGEID)) $criteria->add(PagePeer::INTLANGUAGEID, $this->intlanguageid);
        if ($this->isColumnModified(PagePeer::INTVISIBLE)) $criteria->add(PagePeer::INTVISIBLE, $this->intvisible);
        if ($this->isColumnModified(PagePeer::INTORDER)) $criteria->add(PagePeer::INTORDER, $this->intorder);
        if ($this->isColumnModified(PagePeer::STRTITLE)) $criteria->add(PagePeer::STRTITLE, $this->strtitle);
        if ($this->isColumnModified(PagePeer::STRSLUG)) $criteria->add(PagePeer::STRSLUG, $this->strslug);

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
        $criteria = new Criteria(PagePeer::DATABASE_NAME);
        $criteria->add(PagePeer::INTID, $this->intid);

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
     * @param      object $copyObj An object of Page (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setparentpage($this->getparentpage());
        $copyObj->settype($this->gettype());
        $copyObj->setlanguage($this->getlanguage());
        $copyObj->setvisibl($this->getvisibl());
        $copyObj->setorder($this->getorder());
        $copyObj->settitle($this->gettitle());
        $copyObj->setslug($this->getslug());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getPageMedias() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPageMedia($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPageTypeCustoms() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPageTypeCustom($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPageTypeMedias() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPageTypeMedia($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPageTypeTexts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPageTypeText($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPagesRelatedByid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPageRelatedByid($relObj->copy($deepCopy));
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
     * @return                 Page Clone of current object.
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
     * @return   PagePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PagePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Page object.
     *
     * @param                  Page $v
     * @return                 Page The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPageRelatedByparentpage(Page $v = null)
    {
        if ($v === null) {
            $this->setparentpage(0);
        } else {
            $this->setparentpage($v->getid());
        }

        $this->aPageRelatedByparentpage = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Page object, it will not be re-added.
        if ($v !== null) {
            $v->addPageRelatedByid($this);
        }


        return $this;
    }


    /**
     * Get the associated Page object
     *
     * @param      PropelPDO Optional Connection object.
     * @return                 Page The associated Page object.
     * @throws PropelException
     */
    public function getPageRelatedByparentpage(PropelPDO $con = null)
    {
        if ($this->aPageRelatedByparentpage === null && ($this->intparentpageid !== null)) {
            $this->aPageRelatedByparentpage = PageQuery::create()->findPk($this->intparentpageid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPageRelatedByparentpage->addPagesRelatedByid($this);
             */
        }

        return $this->aPageRelatedByparentpage;
    }

    /**
     * Declares an association between this object and a Language object.
     *
     * @param                  Language $v
     * @return                 Page The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLanguage(Language $v = null)
    {
        if ($v === null) {
            $this->setlanguage(NULL);
        } else {
            $this->setlanguage($v->getid());
        }

        $this->aLanguage = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Language object, it will not be re-added.
        if ($v !== null) {
            $v->addPage($this);
        }


        return $this;
    }


    /**
     * Get the associated Language object
     *
     * @param      PropelPDO Optional Connection object.
     * @return                 Language The associated Language object.
     * @throws PropelException
     */
    public function getLanguage(PropelPDO $con = null)
    {
        if ($this->aLanguage === null && ($this->intlanguageid !== null)) {
            $this->aLanguage = LanguageQuery::create()->findPk($this->intlanguageid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLanguage->addPages($this);
             */
        }

        return $this->aLanguage;
    }

    /**
     * Declares an association between this object and a PageType object.
     *
     * @param                  PageType $v
     * @return                 Page The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPageType(PageType $v = null)
    {
        if ($v === null) {
            $this->settype(NULL);
        } else {
            $this->settype($v->getid());
        }

        $this->aPageType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the PageType object, it will not be re-added.
        if ($v !== null) {
            $v->addPage($this);
        }


        return $this;
    }


    /**
     * Get the associated PageType object
     *
     * @param      PropelPDO Optional Connection object.
     * @return                 PageType The associated PageType object.
     * @throws PropelException
     */
    public function getPageType(PropelPDO $con = null)
    {
        if ($this->aPageType === null && ($this->inttypeid !== null)) {
            $this->aPageType = PageTypeQuery::create()->findPk($this->inttypeid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPageType->addPages($this);
             */
        }

        return $this->aPageType;
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
        if ('PageMedia' == $relationName) {
            return $this->initPageMedias();
        }
        if ('PageTypeCustom' == $relationName) {
            return $this->initPageTypeCustoms();
        }
        if ('PageTypeMedia' == $relationName) {
            return $this->initPageTypeMedias();
        }
        if ('PageTypeText' == $relationName) {
            return $this->initPageTypeTexts();
        }
        if ('PageRelatedByid' == $relationName) {
            return $this->initPagesRelatedByid();
        }
    }

    /**
     * Clears out the collPageMedias collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPageMedias()
     */
    public function clearPageMedias()
    {
        $this->collPageMedias = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collPageMedias collection.
     *
     * By default this just sets the collPageMedias collection to an empty array (like clearcollPageMedias());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPageMedias($overrideExisting = true)
    {
        if (null !== $this->collPageMedias && !$overrideExisting) {
            return;
        }
        $this->collPageMedias = new PropelObjectCollection();
        $this->collPageMedias->setModel('PageMedia');
    }

    /**
     * Gets an array of PageMedia objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Page is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @return PropelCollection|array PageMedia[] List of PageMedia objects
     * @throws PropelException
     */
    public function getPageMedias($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPageMedias || null !== $criteria) {
            if ($this->isNew() && null === $this->collPageMedias) {
                // return empty collection
                $this->initPageMedias();
            } else {
                $collPageMedias = PageMediaQuery::create(null, $criteria)
                    ->filterByPage($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPageMedias;
                }
                $this->collPageMedias = $collPageMedias;
            }
        }

        return $this->collPageMedias;
    }

    /**
     * Sets a collection of PageMedia objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      PropelCollection $pageMedias A Propel collection.
     * @param      PropelPDO $con Optional connection object
     */
    public function setPageMedias(PropelCollection $pageMedias, PropelPDO $con = null)
    {
        $this->pageMediasScheduledForDeletion = $this->getPageMedias(new Criteria(), $con)->diff($pageMedias);

        foreach ($pageMedias as $pageMedia) {
            // Fix issue with collection modified by reference
            if ($pageMedia->isNew()) {
                $pageMedia->setPage($this);
            }
            $this->addPageMedia($pageMedia);
        }

        $this->collPageMedias = $pageMedias;
    }

    /**
     * Returns the number of related PageMedia objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      PropelPDO $con
     * @return int             Count of related PageMedia objects.
     * @throws PropelException
     */
    public function countPageMedias(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPageMedias || null !== $criteria) {
            if ($this->isNew() && null === $this->collPageMedias) {
                return 0;
            } else {
                $query = PageMediaQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPage($this)
                    ->count($con);
            }
        } else {
            return count($this->collPageMedias);
        }
    }

    /**
     * Method called to associate a PageMedia object to this object
     * through the PageMedia foreign key attribute.
     *
     * @param    PageMedia $l PageMedia
     * @return   Page The current object (for fluent API support)
     */
    public function addPageMedia(PageMedia $l)
    {
        if ($this->collPageMedias === null) {
            $this->initPageMedias();
        }
        if (!$this->collPageMedias->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddPageMedia($l);
        }

        return $this;
    }

    /**
     * @param	PageMedia $pageMedia The pageMedia object to add.
     */
    protected function doAddPageMedia($pageMedia)
    {
        $this->collPageMedias[]= $pageMedia;
        $pageMedia->setPage($this);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Page is new, it will return
     * an empty collection; or if this Page has previously
     * been saved, it will retrieve related PageMedias from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Page.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelCollection|array PageMedia[] List of PageMedia objects
     */
    public function getPageMediasJoinMedia($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PageMediaQuery::create(null, $criteria);
        $query->joinWith('Media', $join_behavior);

        return $this->getPageMedias($query, $con);
    }

    /**
     * Clears out the collPageTypeCustoms collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPageTypeCustoms()
     */
    public function clearPageTypeCustoms()
    {
        $this->collPageTypeCustoms = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collPageTypeCustoms collection.
     *
     * By default this just sets the collPageTypeCustoms collection to an empty array (like clearcollPageTypeCustoms());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPageTypeCustoms($overrideExisting = true)
    {
        if (null !== $this->collPageTypeCustoms && !$overrideExisting) {
            return;
        }
        $this->collPageTypeCustoms = new PropelObjectCollection();
        $this->collPageTypeCustoms->setModel('PageTypeCustom');
    }

    /**
     * Gets an array of PageTypeCustom objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Page is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @return PropelCollection|array PageTypeCustom[] List of PageTypeCustom objects
     * @throws PropelException
     */
    public function getPageTypeCustoms($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPageTypeCustoms || null !== $criteria) {
            if ($this->isNew() && null === $this->collPageTypeCustoms) {
                // return empty collection
                $this->initPageTypeCustoms();
            } else {
                $collPageTypeCustoms = PageTypeCustomQuery::create(null, $criteria)
                    ->filterByPage($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPageTypeCustoms;
                }
                $this->collPageTypeCustoms = $collPageTypeCustoms;
            }
        }

        return $this->collPageTypeCustoms;
    }

    /**
     * Sets a collection of PageTypeCustom objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      PropelCollection $pageTypeCustoms A Propel collection.
     * @param      PropelPDO $con Optional connection object
     */
    public function setPageTypeCustoms(PropelCollection $pageTypeCustoms, PropelPDO $con = null)
    {
        $this->pageTypeCustomsScheduledForDeletion = $this->getPageTypeCustoms(new Criteria(), $con)->diff($pageTypeCustoms);

        foreach ($pageTypeCustoms as $pageTypeCustom) {
            // Fix issue with collection modified by reference
            if ($pageTypeCustom->isNew()) {
                $pageTypeCustom->setPage($this);
            }
            $this->addPageTypeCustom($pageTypeCustom);
        }

        $this->collPageTypeCustoms = $pageTypeCustoms;
    }

    /**
     * Returns the number of related PageTypeCustom objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      PropelPDO $con
     * @return int             Count of related PageTypeCustom objects.
     * @throws PropelException
     */
    public function countPageTypeCustoms(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPageTypeCustoms || null !== $criteria) {
            if ($this->isNew() && null === $this->collPageTypeCustoms) {
                return 0;
            } else {
                $query = PageTypeCustomQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPage($this)
                    ->count($con);
            }
        } else {
            return count($this->collPageTypeCustoms);
        }
    }

    /**
     * Method called to associate a PageTypeCustom object to this object
     * through the PageTypeCustom foreign key attribute.
     *
     * @param    PageTypeCustom $l PageTypeCustom
     * @return   Page The current object (for fluent API support)
     */
    public function addPageTypeCustom(PageTypeCustom $l)
    {
        if ($this->collPageTypeCustoms === null) {
            $this->initPageTypeCustoms();
        }
        if (!$this->collPageTypeCustoms->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddPageTypeCustom($l);
        }

        return $this;
    }

    /**
     * @param	PageTypeCustom $pageTypeCustom The pageTypeCustom object to add.
     */
    protected function doAddPageTypeCustom($pageTypeCustom)
    {
        $this->collPageTypeCustoms[]= $pageTypeCustom;
        $pageTypeCustom->setPage($this);
    }

    /**
     * Clears out the collPageTypeMedias collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPageTypeMedias()
     */
    public function clearPageTypeMedias()
    {
        $this->collPageTypeMedias = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collPageTypeMedias collection.
     *
     * By default this just sets the collPageTypeMedias collection to an empty array (like clearcollPageTypeMedias());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPageTypeMedias($overrideExisting = true)
    {
        if (null !== $this->collPageTypeMedias && !$overrideExisting) {
            return;
        }
        $this->collPageTypeMedias = new PropelObjectCollection();
        $this->collPageTypeMedias->setModel('PageTypeMedia');
    }

    /**
     * Gets an array of PageTypeMedia objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Page is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @return PropelCollection|array PageTypeMedia[] List of PageTypeMedia objects
     * @throws PropelException
     */
    public function getPageTypeMedias($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPageTypeMedias || null !== $criteria) {
            if ($this->isNew() && null === $this->collPageTypeMedias) {
                // return empty collection
                $this->initPageTypeMedias();
            } else {
                $collPageTypeMedias = PageTypeMediaQuery::create(null, $criteria)
                    ->filterByPage($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPageTypeMedias;
                }
                $this->collPageTypeMedias = $collPageTypeMedias;
            }
        }

        return $this->collPageTypeMedias;
    }

    /**
     * Sets a collection of PageTypeMedia objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      PropelCollection $pageTypeMedias A Propel collection.
     * @param      PropelPDO $con Optional connection object
     */
    public function setPageTypeMedias(PropelCollection $pageTypeMedias, PropelPDO $con = null)
    {
        $this->pageTypeMediasScheduledForDeletion = $this->getPageTypeMedias(new Criteria(), $con)->diff($pageTypeMedias);

        foreach ($pageTypeMedias as $pageTypeMedia) {
            // Fix issue with collection modified by reference
            if ($pageTypeMedia->isNew()) {
                $pageTypeMedia->setPage($this);
            }
            $this->addPageTypeMedia($pageTypeMedia);
        }

        $this->collPageTypeMedias = $pageTypeMedias;
    }

    /**
     * Returns the number of related PageTypeMedia objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      PropelPDO $con
     * @return int             Count of related PageTypeMedia objects.
     * @throws PropelException
     */
    public function countPageTypeMedias(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPageTypeMedias || null !== $criteria) {
            if ($this->isNew() && null === $this->collPageTypeMedias) {
                return 0;
            } else {
                $query = PageTypeMediaQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPage($this)
                    ->count($con);
            }
        } else {
            return count($this->collPageTypeMedias);
        }
    }

    /**
     * Method called to associate a PageTypeMedia object to this object
     * through the PageTypeMedia foreign key attribute.
     *
     * @param    PageTypeMedia $l PageTypeMedia
     * @return   Page The current object (for fluent API support)
     */
    public function addPageTypeMedia(PageTypeMedia $l)
    {
        if ($this->collPageTypeMedias === null) {
            $this->initPageTypeMedias();
        }
        if (!$this->collPageTypeMedias->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddPageTypeMedia($l);
        }

        return $this;
    }

    /**
     * @param	PageTypeMedia $pageTypeMedia The pageTypeMedia object to add.
     */
    protected function doAddPageTypeMedia($pageTypeMedia)
    {
        $this->collPageTypeMedias[]= $pageTypeMedia;
        $pageTypeMedia->setPage($this);
    }

    /**
     * Clears out the collPageTypeTexts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPageTypeTexts()
     */
    public function clearPageTypeTexts()
    {
        $this->collPageTypeTexts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collPageTypeTexts collection.
     *
     * By default this just sets the collPageTypeTexts collection to an empty array (like clearcollPageTypeTexts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPageTypeTexts($overrideExisting = true)
    {
        if (null !== $this->collPageTypeTexts && !$overrideExisting) {
            return;
        }
        $this->collPageTypeTexts = new PropelObjectCollection();
        $this->collPageTypeTexts->setModel('PageTypeText');
    }

    /**
     * Gets an array of PageTypeText objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Page is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @return PropelCollection|array PageTypeText[] List of PageTypeText objects
     * @throws PropelException
     */
    public function getPageTypeTexts($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPageTypeTexts || null !== $criteria) {
            if ($this->isNew() && null === $this->collPageTypeTexts) {
                // return empty collection
                $this->initPageTypeTexts();
            } else {
                $collPageTypeTexts = PageTypeTextQuery::create(null, $criteria)
                    ->filterByPage($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPageTypeTexts;
                }
                $this->collPageTypeTexts = $collPageTypeTexts;
            }
        }

        return $this->collPageTypeTexts;
    }

    /**
     * Sets a collection of PageTypeText objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      PropelCollection $pageTypeTexts A Propel collection.
     * @param      PropelPDO $con Optional connection object
     */
    public function setPageTypeTexts(PropelCollection $pageTypeTexts, PropelPDO $con = null)
    {
        $this->pageTypeTextsScheduledForDeletion = $this->getPageTypeTexts(new Criteria(), $con)->diff($pageTypeTexts);

        foreach ($pageTypeTexts as $pageTypeText) {
            // Fix issue with collection modified by reference
            if ($pageTypeText->isNew()) {
                $pageTypeText->setPage($this);
            }
            $this->addPageTypeText($pageTypeText);
        }

        $this->collPageTypeTexts = $pageTypeTexts;
    }

    /**
     * Returns the number of related PageTypeText objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      PropelPDO $con
     * @return int             Count of related PageTypeText objects.
     * @throws PropelException
     */
    public function countPageTypeTexts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPageTypeTexts || null !== $criteria) {
            if ($this->isNew() && null === $this->collPageTypeTexts) {
                return 0;
            } else {
                $query = PageTypeTextQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPage($this)
                    ->count($con);
            }
        } else {
            return count($this->collPageTypeTexts);
        }
    }

    /**
     * Method called to associate a PageTypeText object to this object
     * through the PageTypeText foreign key attribute.
     *
     * @param    PageTypeText $l PageTypeText
     * @return   Page The current object (for fluent API support)
     */
    public function addPageTypeText(PageTypeText $l)
    {
        if ($this->collPageTypeTexts === null) {
            $this->initPageTypeTexts();
        }
        if (!$this->collPageTypeTexts->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddPageTypeText($l);
        }

        return $this;
    }

    /**
     * @param	PageTypeText $pageTypeText The pageTypeText object to add.
     */
    protected function doAddPageTypeText($pageTypeText)
    {
        $this->collPageTypeTexts[]= $pageTypeText;
        $pageTypeText->setPage($this);
    }

    /**
     * Clears out the collPagesRelatedByid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPagesRelatedByid()
     */
    public function clearPagesRelatedByid()
    {
        $this->collPagesRelatedByid = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collPagesRelatedByid collection.
     *
     * By default this just sets the collPagesRelatedByid collection to an empty array (like clearcollPagesRelatedByid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPagesRelatedByid($overrideExisting = true)
    {
        if (null !== $this->collPagesRelatedByid && !$overrideExisting) {
            return;
        }
        $this->collPagesRelatedByid = new PropelObjectCollection();
        $this->collPagesRelatedByid->setModel('Page');
    }

    /**
     * Gets an array of Page objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Page is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @return PropelCollection|array Page[] List of Page objects
     * @throws PropelException
     */
    public function getPagesRelatedByid($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPagesRelatedByid || null !== $criteria) {
            if ($this->isNew() && null === $this->collPagesRelatedByid) {
                // return empty collection
                $this->initPagesRelatedByid();
            } else {
                $collPagesRelatedByid = PageQuery::create(null, $criteria)
                    ->filterByPageRelatedByparentpage($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPagesRelatedByid;
                }
                $this->collPagesRelatedByid = $collPagesRelatedByid;
            }
        }

        return $this->collPagesRelatedByid;
    }

    /**
     * Sets a collection of PageRelatedByid objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      PropelCollection $pagesRelatedByid A Propel collection.
     * @param      PropelPDO $con Optional connection object
     */
    public function setPagesRelatedByid(PropelCollection $pagesRelatedByid, PropelPDO $con = null)
    {
        $this->pagesRelatedByidScheduledForDeletion = $this->getPagesRelatedByid(new Criteria(), $con)->diff($pagesRelatedByid);

        foreach ($pagesRelatedByid as $pageRelatedByid) {
            // Fix issue with collection modified by reference
            if ($pageRelatedByid->isNew()) {
                $pageRelatedByid->setPageRelatedByparentpage($this);
            }
            $this->addPageRelatedByid($pageRelatedByid);
        }

        $this->collPagesRelatedByid = $pagesRelatedByid;
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
    public function countPagesRelatedByid(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPagesRelatedByid || null !== $criteria) {
            if ($this->isNew() && null === $this->collPagesRelatedByid) {
                return 0;
            } else {
                $query = PageQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPageRelatedByparentpage($this)
                    ->count($con);
            }
        } else {
            return count($this->collPagesRelatedByid);
        }
    }

    /**
     * Method called to associate a Page object to this object
     * through the Page foreign key attribute.
     *
     * @param    Page $l Page
     * @return   Page The current object (for fluent API support)
     */
    public function addPageRelatedByid(Page $l)
    {
        if ($this->collPagesRelatedByid === null) {
            $this->initPagesRelatedByid();
        }
        if (!$this->collPagesRelatedByid->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddPageRelatedByid($l);
        }

        return $this;
    }

    /**
     * @param	PageRelatedByid $pageRelatedByid The pageRelatedByid object to add.
     */
    protected function doAddPageRelatedByid($pageRelatedByid)
    {
        $this->collPagesRelatedByid[]= $pageRelatedByid;
        $pageRelatedByid->setPageRelatedByparentpage($this);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Page is new, it will return
     * an empty collection; or if this Page has previously
     * been saved, it will retrieve related PagesRelatedByid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Page.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelCollection|array Page[] List of Page objects
     */
    public function getPagesRelatedByidJoinLanguage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PageQuery::create(null, $criteria);
        $query->joinWith('Language', $join_behavior);

        return $this->getPagesRelatedByid($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Page is new, it will return
     * an empty collection; or if this Page has previously
     * been saved, it will retrieve related PagesRelatedByid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Page.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      PropelPDO $con optional connection object
     * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelCollection|array Page[] List of Page objects
     */
    public function getPagesRelatedByidJoinPageType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PageQuery::create(null, $criteria);
        $query->joinWith('PageType', $join_behavior);

        return $this->getPagesRelatedByid($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->intid = null;
        $this->intparentpageid = null;
        $this->inttypeid = null;
        $this->intlanguageid = null;
        $this->intvisible = null;
        $this->intorder = null;
        $this->strtitle = null;
        $this->strslug = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
            if ($this->collPageMedias) {
                foreach ($this->collPageMedias as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPageTypeCustoms) {
                foreach ($this->collPageTypeCustoms as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPageTypeMedias) {
                foreach ($this->collPageTypeMedias as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPageTypeTexts) {
                foreach ($this->collPageTypeTexts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPagesRelatedByid) {
                foreach ($this->collPagesRelatedByid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collPageMedias instanceof PropelCollection) {
            $this->collPageMedias->clearIterator();
        }
        $this->collPageMedias = null;
        if ($this->collPageTypeCustoms instanceof PropelCollection) {
            $this->collPageTypeCustoms->clearIterator();
        }
        $this->collPageTypeCustoms = null;
        if ($this->collPageTypeMedias instanceof PropelCollection) {
            $this->collPageTypeMedias->clearIterator();
        }
        $this->collPageTypeMedias = null;
        if ($this->collPageTypeTexts instanceof PropelCollection) {
            $this->collPageTypeTexts->clearIterator();
        }
        $this->collPageTypeTexts = null;
        if ($this->collPagesRelatedByid instanceof PropelCollection) {
            $this->collPagesRelatedByid->clearIterator();
        }
        $this->collPagesRelatedByid = null;
        $this->aPageRelatedByparentpage = null;
        $this->aLanguage = null;
        $this->aPageType = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PagePeer::DEFAULT_STRING_FORMAT);
    }

} // BasePage

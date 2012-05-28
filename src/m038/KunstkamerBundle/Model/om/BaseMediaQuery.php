<?php

namespace m038\KunstkamerBundle\Model\om;

use \Criteria;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelPDO;
use m038\KunstkamerBundle\Model\Media;
use m038\KunstkamerBundle\Model\MediaLang;
use m038\KunstkamerBundle\Model\MediaPeer;
use m038\KunstkamerBundle\Model\MediaQuery;
use m038\KunstkamerBundle\Model\PageMedia;

/**
 * Base class that represents a query for the 'tblMedia' table.
 *
 * 
 *
 * @method     MediaQuery orderByid($order = Criteria::ASC) Order by the intID column
 * @method     MediaQuery orderBypath($order = Criteria::ASC) Order by the strPath column
 *
 * @method     MediaQuery groupByid() Group by the intID column
 * @method     MediaQuery groupBypath() Group by the strPath column
 *
 * @method     MediaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MediaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MediaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MediaQuery leftJoinMediaLang($relationAlias = null) Adds a LEFT JOIN clause to the query using the MediaLang relation
 * @method     MediaQuery rightJoinMediaLang($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MediaLang relation
 * @method     MediaQuery innerJoinMediaLang($relationAlias = null) Adds a INNER JOIN clause to the query using the MediaLang relation
 *
 * @method     MediaQuery leftJoinPageMedia($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageMedia relation
 * @method     MediaQuery rightJoinPageMedia($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageMedia relation
 * @method     MediaQuery innerJoinPageMedia($relationAlias = null) Adds a INNER JOIN clause to the query using the PageMedia relation
 *
 * @method     Media findOne(PropelPDO $con = null) Return the first Media matching the query
 * @method     Media findOneOrCreate(PropelPDO $con = null) Return the first Media matching the query, or a new Media object populated from the query conditions when no match is found
 *
 * @method     Media findOneByid(int $intID) Return the first Media filtered by the intID column
 * @method     Media findOneBypath(string $strPath) Return the first Media filtered by the strPath column
 *
 * @method     array findByid(int $intID) Return Media objects filtered by the intID column
 * @method     array findBypath(string $strPath) Return Media objects filtered by the strPath column
 *
 * @package    propel.generator.src.m038.KunstkamerBundle.Model.om
 */
abstract class BaseMediaQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseMediaQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'm038\\KunstkamerBundle\\Model\\Media', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MediaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return MediaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MediaQuery) {
            return $criteria;
        }
        $query = new MediaQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Media|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MediaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MediaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Media A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `INTID`, `STRPATH` FROM `tblMedia` WHERE `INTID` = :p0';
        try {
            $stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Media();
            $obj->hydrate($row);
            MediaPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Media|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return MediaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MediaPeer::INTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MediaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MediaPeer::INTID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the intID column
     *
     * Example usage:
     * <code>
     * $query->filterByid(1234); // WHERE intID = 1234
     * $query->filterByid(array(12, 34)); // WHERE intID IN (12, 34)
     * $query->filterByid(array('min' => 12)); // WHERE intID > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MediaQuery The current query, for fluid interface
     */
    public function filterByid($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MediaPeer::INTID, $id, $comparison);
    }

    /**
     * Filter the query on the strPath column
     *
     * Example usage:
     * <code>
     * $query->filterBypath('fooValue');   // WHERE strPath = 'fooValue'
     * $query->filterBypath('%fooValue%'); // WHERE strPath LIKE '%fooValue%'
     * </code>
     *
     * @param     string $path The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MediaQuery The current query, for fluid interface
     */
    public function filterBypath($path = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($path)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $path)) {
                $path = str_replace('*', '%', $path);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MediaPeer::STRPATH, $path, $comparison);
    }

    /**
     * Filter the query by a related MediaLang object
     *
     * @param   MediaLang $mediaLang  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MediaQuery The current query, for fluid interface
     */
    public function filterByMediaLang($mediaLang, $comparison = null)
    {
        if ($mediaLang instanceof MediaLang) {
            return $this
                ->addUsingAlias(MediaPeer::INTID, $mediaLang->getmedia(), $comparison);
        } elseif ($mediaLang instanceof PropelCollection) {
            return $this
                ->useMediaLangQuery()
                ->filterByPrimaryKeys($mediaLang->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMediaLang() only accepts arguments of type MediaLang or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MediaLang relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MediaQuery The current query, for fluid interface
     */
    public function joinMediaLang($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MediaLang');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'MediaLang');
        }

        return $this;
    }

    /**
     * Use the MediaLang relation MediaLang object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \m038\KunstkamerBundle\Model\MediaLangQuery A secondary query class using the current class as primary query
     */
    public function useMediaLangQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMediaLang($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MediaLang', '\m038\KunstkamerBundle\Model\MediaLangQuery');
    }

    /**
     * Filter the query by a related PageMedia object
     *
     * @param   PageMedia $pageMedia  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MediaQuery The current query, for fluid interface
     */
    public function filterByPageMedia($pageMedia, $comparison = null)
    {
        if ($pageMedia instanceof PageMedia) {
            return $this
                ->addUsingAlias(MediaPeer::INTID, $pageMedia->getmedia(), $comparison);
        } elseif ($pageMedia instanceof PropelCollection) {
            return $this
                ->usePageMediaQuery()
                ->filterByPrimaryKeys($pageMedia->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPageMedia() only accepts arguments of type PageMedia or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PageMedia relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MediaQuery The current query, for fluid interface
     */
    public function joinPageMedia($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PageMedia');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PageMedia');
        }

        return $this;
    }

    /**
     * Use the PageMedia relation PageMedia object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \m038\KunstkamerBundle\Model\PageMediaQuery A secondary query class using the current class as primary query
     */
    public function usePageMediaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPageMedia($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PageMedia', '\m038\KunstkamerBundle\Model\PageMediaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Media $media Object to remove from the list of results
     *
     * @return MediaQuery The current query, for fluid interface
     */
    public function prune($media = null)
    {
        if ($media) {
            $this->addUsingAlias(MediaPeer::INTID, $media->getid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BaseMediaQuery
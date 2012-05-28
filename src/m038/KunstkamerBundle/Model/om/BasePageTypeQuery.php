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
use m038\KunstkamerBundle\Model\Page;
use m038\KunstkamerBundle\Model\PageType;
use m038\KunstkamerBundle\Model\PageTypePeer;
use m038\KunstkamerBundle\Model\PageTypeQuery;

/**
 * Base class that represents a query for the 'tblPageTypes' table.
 *
 * 
 *
 * @method     PageTypeQuery orderByid($order = Criteria::ASC) Order by the intID column
 * @method     PageTypeQuery orderByname($order = Criteria::ASC) Order by the strName column
 * @method     PageTypeQuery orderByenabled($order = Criteria::ASC) Order by the intEnabled column
 * @method     PageTypeQuery orderBydatatable($order = Criteria::ASC) Order by the strDataTable column
 *
 * @method     PageTypeQuery groupByid() Group by the intID column
 * @method     PageTypeQuery groupByname() Group by the strName column
 * @method     PageTypeQuery groupByenabled() Group by the intEnabled column
 * @method     PageTypeQuery groupBydatatable() Group by the strDataTable column
 *
 * @method     PageTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PageTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PageTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PageTypeQuery leftJoinPage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Page relation
 * @method     PageTypeQuery rightJoinPage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Page relation
 * @method     PageTypeQuery innerJoinPage($relationAlias = null) Adds a INNER JOIN clause to the query using the Page relation
 *
 * @method     PageType findOne(PropelPDO $con = null) Return the first PageType matching the query
 * @method     PageType findOneOrCreate(PropelPDO $con = null) Return the first PageType matching the query, or a new PageType object populated from the query conditions when no match is found
 *
 * @method     PageType findOneByid(int $intID) Return the first PageType filtered by the intID column
 * @method     PageType findOneByname(string $strName) Return the first PageType filtered by the strName column
 * @method     PageType findOneByenabled(boolean $intEnabled) Return the first PageType filtered by the intEnabled column
 * @method     PageType findOneBydatatable(string $strDataTable) Return the first PageType filtered by the strDataTable column
 *
 * @method     array findByid(int $intID) Return PageType objects filtered by the intID column
 * @method     array findByname(string $strName) Return PageType objects filtered by the strName column
 * @method     array findByenabled(boolean $intEnabled) Return PageType objects filtered by the intEnabled column
 * @method     array findBydatatable(string $strDataTable) Return PageType objects filtered by the strDataTable column
 *
 * @package    propel.generator.src.m038.KunstkamerBundle.Model.om
 */
abstract class BasePageTypeQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BasePageTypeQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'm038\\KunstkamerBundle\\Model\\PageType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PageTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return PageTypeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PageTypeQuery) {
            return $criteria;
        }
        $query = new PageTypeQuery();
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
     * @return   PageType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PageTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PageTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PageType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `INTID`, `STRNAME`, `INTENABLED`, `STRDATATABLE` FROM `tblPageTypes` WHERE `INTID` = :p0';
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
            $obj = new PageType();
            $obj->hydrate($row);
            PageTypePeer::addInstanceToPool($obj, (string) $key);
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
     * @return PageType|array|mixed the result, formatted by the current formatter
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
     * @return PageTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PageTypePeer::INTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PageTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PageTypePeer::INTID, $keys, Criteria::IN);
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
     * @return PageTypeQuery The current query, for fluid interface
     */
    public function filterByid($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PageTypePeer::INTID, $id, $comparison);
    }

    /**
     * Filter the query on the strName column
     *
     * Example usage:
     * <code>
     * $query->filterByname('fooValue');   // WHERE strName = 'fooValue'
     * $query->filterByname('%fooValue%'); // WHERE strName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageTypeQuery The current query, for fluid interface
     */
    public function filterByname($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PageTypePeer::STRNAME, $name, $comparison);
    }

    /**
     * Filter the query on the intEnabled column
     *
     * Example usage:
     * <code>
     * $query->filterByenabled(true); // WHERE intEnabled = true
     * $query->filterByenabled('yes'); // WHERE intEnabled = true
     * </code>
     *
     * @param     boolean|string $enabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageTypeQuery The current query, for fluid interface
     */
    public function filterByenabled($enabled = null, $comparison = null)
    {
        if (is_string($enabled)) {
            $intEnabled = in_array(strtolower($enabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PageTypePeer::INTENABLED, $enabled, $comparison);
    }

    /**
     * Filter the query on the strDataTable column
     *
     * Example usage:
     * <code>
     * $query->filterBydatatable('fooValue');   // WHERE strDataTable = 'fooValue'
     * $query->filterBydatatable('%fooValue%'); // WHERE strDataTable LIKE '%fooValue%'
     * </code>
     *
     * @param     string $datatable The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageTypeQuery The current query, for fluid interface
     */
    public function filterBydatatable($datatable = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($datatable)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $datatable)) {
                $datatable = str_replace('*', '%', $datatable);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PageTypePeer::STRDATATABLE, $datatable, $comparison);
    }

    /**
     * Filter the query by a related Page object
     *
     * @param   Page $page  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageTypeQuery The current query, for fluid interface
     */
    public function filterByPage($page, $comparison = null)
    {
        if ($page instanceof Page) {
            return $this
                ->addUsingAlias(PageTypePeer::INTID, $page->gettype(), $comparison);
        } elseif ($page instanceof PropelCollection) {
            return $this
                ->usePageQuery()
                ->filterByPrimaryKeys($page->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPage() only accepts arguments of type Page or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Page relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PageTypeQuery The current query, for fluid interface
     */
    public function joinPage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Page');

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
            $this->addJoinObject($join, 'Page');
        }

        return $this;
    }

    /**
     * Use the Page relation Page object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \m038\KunstkamerBundle\Model\PageQuery A secondary query class using the current class as primary query
     */
    public function usePageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Page', '\m038\KunstkamerBundle\Model\PageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PageType $pageType Object to remove from the list of results
     *
     * @return PageTypeQuery The current query, for fluid interface
     */
    public function prune($pageType = null)
    {
        if ($pageType) {
            $this->addUsingAlias(PageTypePeer::INTID, $pageType->getid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BasePageTypeQuery
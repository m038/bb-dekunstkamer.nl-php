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
use m038\KunstkamerBundle\Model\PageTypeCustom;
use m038\KunstkamerBundle\Model\PageTypeCustomPeer;
use m038\KunstkamerBundle\Model\PageTypeCustomQuery;

/**
 * Base class that represents a query for the 'tblPageTypeCustom' table.
 *
 * 
 *
 * @method     PageTypeCustomQuery orderByid($order = Criteria::ASC) Order by the intID column
 * @method     PageTypeCustomQuery orderBypage($order = Criteria::ASC) Order by the intPageID column
 * @method     PageTypeCustomQuery orderByidentifyingslug($order = Criteria::ASC) Order by the strIdentifyingSlug column
 *
 * @method     PageTypeCustomQuery groupByid() Group by the intID column
 * @method     PageTypeCustomQuery groupBypage() Group by the intPageID column
 * @method     PageTypeCustomQuery groupByidentifyingslug() Group by the strIdentifyingSlug column
 *
 * @method     PageTypeCustomQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PageTypeCustomQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PageTypeCustomQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PageTypeCustomQuery leftJoinPage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Page relation
 * @method     PageTypeCustomQuery rightJoinPage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Page relation
 * @method     PageTypeCustomQuery innerJoinPage($relationAlias = null) Adds a INNER JOIN clause to the query using the Page relation
 *
 * @method     PageTypeCustom findOne(PropelPDO $con = null) Return the first PageTypeCustom matching the query
 * @method     PageTypeCustom findOneOrCreate(PropelPDO $con = null) Return the first PageTypeCustom matching the query, or a new PageTypeCustom object populated from the query conditions when no match is found
 *
 * @method     PageTypeCustom findOneByid(int $intID) Return the first PageTypeCustom filtered by the intID column
 * @method     PageTypeCustom findOneBypage(int $intPageID) Return the first PageTypeCustom filtered by the intPageID column
 * @method     PageTypeCustom findOneByidentifyingslug(string $strIdentifyingSlug) Return the first PageTypeCustom filtered by the strIdentifyingSlug column
 *
 * @method     array findByid(int $intID) Return PageTypeCustom objects filtered by the intID column
 * @method     array findBypage(int $intPageID) Return PageTypeCustom objects filtered by the intPageID column
 * @method     array findByidentifyingslug(string $strIdentifyingSlug) Return PageTypeCustom objects filtered by the strIdentifyingSlug column
 *
 * @package    propel.generator.src.m038.KunstkamerBundle.Model.om
 */
abstract class BasePageTypeCustomQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BasePageTypeCustomQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'm038\\KunstkamerBundle\\Model\\PageTypeCustom', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PageTypeCustomQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return PageTypeCustomQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PageTypeCustomQuery) {
            return $criteria;
        }
        $query = new PageTypeCustomQuery();
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
     * @return   PageTypeCustom|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PageTypeCustomPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PageTypeCustomPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PageTypeCustom A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `INTID`, `INTPAGEID`, `STRIDENTIFYINGSLUG` FROM `tblPageTypeCustom` WHERE `INTID` = :p0';
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
            $obj = new PageTypeCustom();
            $obj->hydrate($row);
            PageTypeCustomPeer::addInstanceToPool($obj, (string) $key);
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
     * @return PageTypeCustom|array|mixed the result, formatted by the current formatter
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
     * @return PageTypeCustomQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PageTypeCustomPeer::INTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PageTypeCustomQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PageTypeCustomPeer::INTID, $keys, Criteria::IN);
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
     * @return PageTypeCustomQuery The current query, for fluid interface
     */
    public function filterByid($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PageTypeCustomPeer::INTID, $id, $comparison);
    }

    /**
     * Filter the query on the intPageID column
     *
     * Example usage:
     * <code>
     * $query->filterBypage(1234); // WHERE intPageID = 1234
     * $query->filterBypage(array(12, 34)); // WHERE intPageID IN (12, 34)
     * $query->filterBypage(array('min' => 12)); // WHERE intPageID > 12
     * </code>
     *
     * @see       filterByPage()
     *
     * @param     mixed $page The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageTypeCustomQuery The current query, for fluid interface
     */
    public function filterBypage($page = null, $comparison = null)
    {
        if (is_array($page)) {
            $useMinMax = false;
            if (isset($page['min'])) {
                $this->addUsingAlias(PageTypeCustomPeer::INTPAGEID, $page['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($page['max'])) {
                $this->addUsingAlias(PageTypeCustomPeer::INTPAGEID, $page['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageTypeCustomPeer::INTPAGEID, $page, $comparison);
    }

    /**
     * Filter the query on the strIdentifyingSlug column
     *
     * Example usage:
     * <code>
     * $query->filterByidentifyingslug('fooValue');   // WHERE strIdentifyingSlug = 'fooValue'
     * $query->filterByidentifyingslug('%fooValue%'); // WHERE strIdentifyingSlug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $identifyingslug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageTypeCustomQuery The current query, for fluid interface
     */
    public function filterByidentifyingslug($identifyingslug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($identifyingslug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $identifyingslug)) {
                $identifyingslug = str_replace('*', '%', $identifyingslug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PageTypeCustomPeer::STRIDENTIFYINGSLUG, $identifyingslug, $comparison);
    }

    /**
     * Filter the query by a related Page object
     *
     * @param   Page|PropelCollection $page The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageTypeCustomQuery The current query, for fluid interface
     */
    public function filterByPage($page, $comparison = null)
    {
        if ($page instanceof Page) {
            return $this
                ->addUsingAlias(PageTypeCustomPeer::INTPAGEID, $page->getid(), $comparison);
        } elseif ($page instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PageTypeCustomPeer::INTPAGEID, $page->toKeyValue('PrimaryKey', 'id'), $comparison);
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
     * @return PageTypeCustomQuery The current query, for fluid interface
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
     * @param   PageTypeCustom $pageTypeCustom Object to remove from the list of results
     *
     * @return PageTypeCustomQuery The current query, for fluid interface
     */
    public function prune($pageTypeCustom = null)
    {
        if ($pageTypeCustom) {
            $this->addUsingAlias(PageTypeCustomPeer::INTID, $pageTypeCustom->getid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BasePageTypeCustomQuery
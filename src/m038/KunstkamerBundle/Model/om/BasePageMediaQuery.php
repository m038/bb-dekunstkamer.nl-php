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
use m038\KunstkamerBundle\Model\Page;
use m038\KunstkamerBundle\Model\PageMedia;
use m038\KunstkamerBundle\Model\PageMediaPeer;
use m038\KunstkamerBundle\Model\PageMediaQuery;

/**
 * Base class that represents a query for the 'tblPageMedia' table.
 *
 * 
 *
 * @method     PageMediaQuery orderByid($order = Criteria::ASC) Order by the intID column
 * @method     PageMediaQuery orderBypage($order = Criteria::ASC) Order by the intPageID column
 * @method     PageMediaQuery orderBymedia($order = Criteria::ASC) Order by the intMediaID column
 * @method     PageMediaQuery orderByorder($order = Criteria::ASC) Order by the intOrder column
 *
 * @method     PageMediaQuery groupByid() Group by the intID column
 * @method     PageMediaQuery groupBypage() Group by the intPageID column
 * @method     PageMediaQuery groupBymedia() Group by the intMediaID column
 * @method     PageMediaQuery groupByorder() Group by the intOrder column
 *
 * @method     PageMediaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PageMediaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PageMediaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PageMediaQuery leftJoinPage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Page relation
 * @method     PageMediaQuery rightJoinPage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Page relation
 * @method     PageMediaQuery innerJoinPage($relationAlias = null) Adds a INNER JOIN clause to the query using the Page relation
 *
 * @method     PageMediaQuery leftJoinMedia($relationAlias = null) Adds a LEFT JOIN clause to the query using the Media relation
 * @method     PageMediaQuery rightJoinMedia($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Media relation
 * @method     PageMediaQuery innerJoinMedia($relationAlias = null) Adds a INNER JOIN clause to the query using the Media relation
 *
 * @method     PageMedia findOne(PropelPDO $con = null) Return the first PageMedia matching the query
 * @method     PageMedia findOneOrCreate(PropelPDO $con = null) Return the first PageMedia matching the query, or a new PageMedia object populated from the query conditions when no match is found
 *
 * @method     PageMedia findOneByid(int $intID) Return the first PageMedia filtered by the intID column
 * @method     PageMedia findOneBypage(int $intPageID) Return the first PageMedia filtered by the intPageID column
 * @method     PageMedia findOneBymedia(int $intMediaID) Return the first PageMedia filtered by the intMediaID column
 * @method     PageMedia findOneByorder(int $intOrder) Return the first PageMedia filtered by the intOrder column
 *
 * @method     array findByid(int $intID) Return PageMedia objects filtered by the intID column
 * @method     array findBypage(int $intPageID) Return PageMedia objects filtered by the intPageID column
 * @method     array findBymedia(int $intMediaID) Return PageMedia objects filtered by the intMediaID column
 * @method     array findByorder(int $intOrder) Return PageMedia objects filtered by the intOrder column
 *
 * @package    propel.generator.src.m038.KunstkamerBundle.Model.om
 */
abstract class BasePageMediaQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BasePageMediaQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'm038\\KunstkamerBundle\\Model\\PageMedia', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PageMediaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return PageMediaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PageMediaQuery) {
            return $criteria;
        }
        $query = new PageMediaQuery();
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
     * @return   PageMedia|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PageMediaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PageMediaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PageMedia A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `INTID`, `INTPAGEID`, `INTMEDIAID`, `INTORDER` FROM `tblPageMedia` WHERE `INTID` = :p0';
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
            $obj = new PageMedia();
            $obj->hydrate($row);
            PageMediaPeer::addInstanceToPool($obj, (string) $key);
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
     * @return PageMedia|array|mixed the result, formatted by the current formatter
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
     * @return PageMediaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PageMediaPeer::INTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PageMediaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PageMediaPeer::INTID, $keys, Criteria::IN);
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
     * @return PageMediaQuery The current query, for fluid interface
     */
    public function filterByid($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PageMediaPeer::INTID, $id, $comparison);
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
     * @return PageMediaQuery The current query, for fluid interface
     */
    public function filterBypage($page = null, $comparison = null)
    {
        if (is_array($page)) {
            $useMinMax = false;
            if (isset($page['min'])) {
                $this->addUsingAlias(PageMediaPeer::INTPAGEID, $page['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($page['max'])) {
                $this->addUsingAlias(PageMediaPeer::INTPAGEID, $page['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageMediaPeer::INTPAGEID, $page, $comparison);
    }

    /**
     * Filter the query on the intMediaID column
     *
     * Example usage:
     * <code>
     * $query->filterBymedia(1234); // WHERE intMediaID = 1234
     * $query->filterBymedia(array(12, 34)); // WHERE intMediaID IN (12, 34)
     * $query->filterBymedia(array('min' => 12)); // WHERE intMediaID > 12
     * </code>
     *
     * @see       filterByMedia()
     *
     * @param     mixed $media The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageMediaQuery The current query, for fluid interface
     */
    public function filterBymedia($media = null, $comparison = null)
    {
        if (is_array($media)) {
            $useMinMax = false;
            if (isset($media['min'])) {
                $this->addUsingAlias(PageMediaPeer::INTMEDIAID, $media['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($media['max'])) {
                $this->addUsingAlias(PageMediaPeer::INTMEDIAID, $media['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageMediaPeer::INTMEDIAID, $media, $comparison);
    }

    /**
     * Filter the query on the intOrder column
     *
     * Example usage:
     * <code>
     * $query->filterByorder(1234); // WHERE intOrder = 1234
     * $query->filterByorder(array(12, 34)); // WHERE intOrder IN (12, 34)
     * $query->filterByorder(array('min' => 12)); // WHERE intOrder > 12
     * </code>
     *
     * @param     mixed $order The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageMediaQuery The current query, for fluid interface
     */
    public function filterByorder($order = null, $comparison = null)
    {
        if (is_array($order)) {
            $useMinMax = false;
            if (isset($order['min'])) {
                $this->addUsingAlias(PageMediaPeer::INTORDER, $order['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($order['max'])) {
                $this->addUsingAlias(PageMediaPeer::INTORDER, $order['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageMediaPeer::INTORDER, $order, $comparison);
    }

    /**
     * Filter the query by a related Page object
     *
     * @param   Page|PropelCollection $page The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageMediaQuery The current query, for fluid interface
     */
    public function filterByPage($page, $comparison = null)
    {
        if ($page instanceof Page) {
            return $this
                ->addUsingAlias(PageMediaPeer::INTPAGEID, $page->getid(), $comparison);
        } elseif ($page instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PageMediaPeer::INTPAGEID, $page->toKeyValue('PrimaryKey', 'id'), $comparison);
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
     * @return PageMediaQuery The current query, for fluid interface
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
     * Filter the query by a related Media object
     *
     * @param   Media|PropelCollection $media The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageMediaQuery The current query, for fluid interface
     */
    public function filterByMedia($media, $comparison = null)
    {
        if ($media instanceof Media) {
            return $this
                ->addUsingAlias(PageMediaPeer::INTMEDIAID, $media->getid(), $comparison);
        } elseif ($media instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PageMediaPeer::INTMEDIAID, $media->toKeyValue('PrimaryKey', 'id'), $comparison);
        } else {
            throw new PropelException('filterByMedia() only accepts arguments of type Media or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Media relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PageMediaQuery The current query, for fluid interface
     */
    public function joinMedia($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Media');

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
            $this->addJoinObject($join, 'Media');
        }

        return $this;
    }

    /**
     * Use the Media relation Media object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \m038\KunstkamerBundle\Model\MediaQuery A secondary query class using the current class as primary query
     */
    public function useMediaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMedia($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Media', '\m038\KunstkamerBundle\Model\MediaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PageMedia $pageMedia Object to remove from the list of results
     *
     * @return PageMediaQuery The current query, for fluid interface
     */
    public function prune($pageMedia = null)
    {
        if ($pageMedia) {
            $this->addUsingAlias(PageMediaPeer::INTID, $pageMedia->getid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BasePageMediaQuery
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
use m038\KunstkamerBundle\Model\Language;
use m038\KunstkamerBundle\Model\Page;
use m038\KunstkamerBundle\Model\PageMedia;
use m038\KunstkamerBundle\Model\PagePeer;
use m038\KunstkamerBundle\Model\PageQuery;
use m038\KunstkamerBundle\Model\PageType;
use m038\KunstkamerBundle\Model\PageTypeCustom;
use m038\KunstkamerBundle\Model\PageTypeMedia;
use m038\KunstkamerBundle\Model\PageTypeText;

/**
 * Base class that represents a query for the 'tblPages' table.
 *
 * 
 *
 * @method     PageQuery orderByid($order = Criteria::ASC) Order by the intID column
 * @method     PageQuery orderByparentpage($order = Criteria::ASC) Order by the intParentPageID column
 * @method     PageQuery orderBytype($order = Criteria::ASC) Order by the intTypeID column
 * @method     PageQuery orderBylanguage($order = Criteria::ASC) Order by the intLanguageID column
 * @method     PageQuery orderByvisibl($order = Criteria::ASC) Order by the intVisible column
 * @method     PageQuery orderByorder($order = Criteria::ASC) Order by the intOrder column
 * @method     PageQuery orderBytitle($order = Criteria::ASC) Order by the strTitle column
 * @method     PageQuery orderByslug($order = Criteria::ASC) Order by the strSlug column
 *
 * @method     PageQuery groupByid() Group by the intID column
 * @method     PageQuery groupByparentpage() Group by the intParentPageID column
 * @method     PageQuery groupBytype() Group by the intTypeID column
 * @method     PageQuery groupBylanguage() Group by the intLanguageID column
 * @method     PageQuery groupByvisibl() Group by the intVisible column
 * @method     PageQuery groupByorder() Group by the intOrder column
 * @method     PageQuery groupBytitle() Group by the strTitle column
 * @method     PageQuery groupByslug() Group by the strSlug column
 *
 * @method     PageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PageQuery leftJoinPageRelatedByparentpage($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageRelatedByparentpage relation
 * @method     PageQuery rightJoinPageRelatedByparentpage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageRelatedByparentpage relation
 * @method     PageQuery innerJoinPageRelatedByparentpage($relationAlias = null) Adds a INNER JOIN clause to the query using the PageRelatedByparentpage relation
 *
 * @method     PageQuery leftJoinLanguage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Language relation
 * @method     PageQuery rightJoinLanguage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Language relation
 * @method     PageQuery innerJoinLanguage($relationAlias = null) Adds a INNER JOIN clause to the query using the Language relation
 *
 * @method     PageQuery leftJoinPageType($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageType relation
 * @method     PageQuery rightJoinPageType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageType relation
 * @method     PageQuery innerJoinPageType($relationAlias = null) Adds a INNER JOIN clause to the query using the PageType relation
 *
 * @method     PageQuery leftJoinPageMedia($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageMedia relation
 * @method     PageQuery rightJoinPageMedia($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageMedia relation
 * @method     PageQuery innerJoinPageMedia($relationAlias = null) Adds a INNER JOIN clause to the query using the PageMedia relation
 *
 * @method     PageQuery leftJoinPageTypeCustom($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageTypeCustom relation
 * @method     PageQuery rightJoinPageTypeCustom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageTypeCustom relation
 * @method     PageQuery innerJoinPageTypeCustom($relationAlias = null) Adds a INNER JOIN clause to the query using the PageTypeCustom relation
 *
 * @method     PageQuery leftJoinPageTypeMedia($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageTypeMedia relation
 * @method     PageQuery rightJoinPageTypeMedia($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageTypeMedia relation
 * @method     PageQuery innerJoinPageTypeMedia($relationAlias = null) Adds a INNER JOIN clause to the query using the PageTypeMedia relation
 *
 * @method     PageQuery leftJoinPageTypeText($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageTypeText relation
 * @method     PageQuery rightJoinPageTypeText($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageTypeText relation
 * @method     PageQuery innerJoinPageTypeText($relationAlias = null) Adds a INNER JOIN clause to the query using the PageTypeText relation
 *
 * @method     PageQuery leftJoinPageRelatedByid($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageRelatedByid relation
 * @method     PageQuery rightJoinPageRelatedByid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageRelatedByid relation
 * @method     PageQuery innerJoinPageRelatedByid($relationAlias = null) Adds a INNER JOIN clause to the query using the PageRelatedByid relation
 *
 * @method     Page findOne(PropelPDO $con = null) Return the first Page matching the query
 * @method     Page findOneOrCreate(PropelPDO $con = null) Return the first Page matching the query, or a new Page object populated from the query conditions when no match is found
 *
 * @method     Page findOneByid(int $intID) Return the first Page filtered by the intID column
 * @method     Page findOneByparentpage(int $intParentPageID) Return the first Page filtered by the intParentPageID column
 * @method     Page findOneBytype(int $intTypeID) Return the first Page filtered by the intTypeID column
 * @method     Page findOneBylanguage(int $intLanguageID) Return the first Page filtered by the intLanguageID column
 * @method     Page findOneByvisibl(int $intVisible) Return the first Page filtered by the intVisible column
 * @method     Page findOneByorder(int $intOrder) Return the first Page filtered by the intOrder column
 * @method     Page findOneBytitle(string $strTitle) Return the first Page filtered by the strTitle column
 * @method     Page findOneByslug(string $strSlug) Return the first Page filtered by the strSlug column
 *
 * @method     array findByid(int $intID) Return Page objects filtered by the intID column
 * @method     array findByparentpage(int $intParentPageID) Return Page objects filtered by the intParentPageID column
 * @method     array findBytype(int $intTypeID) Return Page objects filtered by the intTypeID column
 * @method     array findBylanguage(int $intLanguageID) Return Page objects filtered by the intLanguageID column
 * @method     array findByvisibl(int $intVisible) Return Page objects filtered by the intVisible column
 * @method     array findByorder(int $intOrder) Return Page objects filtered by the intOrder column
 * @method     array findBytitle(string $strTitle) Return Page objects filtered by the strTitle column
 * @method     array findByslug(string $strSlug) Return Page objects filtered by the strSlug column
 *
 * @package    propel.generator.src.m038.KunstkamerBundle.Model.om
 */
abstract class BasePageQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BasePageQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'm038\\KunstkamerBundle\\Model\\Page', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return PageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PageQuery) {
            return $criteria;
        }
        $query = new PageQuery();
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
     * @return   Page|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PagePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Page A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `INTID`, `INTPARENTPAGEID`, `INTTYPEID`, `INTLANGUAGEID`, `INTVISIBLE`, `INTORDER`, `STRTITLE`, `STRSLUG` FROM `tblPages` WHERE `INTID` = :p0';
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
            $obj = new Page();
            $obj->hydrate($row);
            PagePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Page|array|mixed the result, formatted by the current formatter
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
     * @return PageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PagePeer::INTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PagePeer::INTID, $keys, Criteria::IN);
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
     * @return PageQuery The current query, for fluid interface
     */
    public function filterByid($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PagePeer::INTID, $id, $comparison);
    }

    /**
     * Filter the query on the intParentPageID column
     *
     * Example usage:
     * <code>
     * $query->filterByparentpage(1234); // WHERE intParentPageID = 1234
     * $query->filterByparentpage(array(12, 34)); // WHERE intParentPageID IN (12, 34)
     * $query->filterByparentpage(array('min' => 12)); // WHERE intParentPageID > 12
     * </code>
     *
     * @see       filterByPageRelatedByparentpage()
     *
     * @param     mixed $parentpage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function filterByparentpage($parentpage = null, $comparison = null)
    {
        if (is_array($parentpage)) {
            $useMinMax = false;
            if (isset($parentpage['min'])) {
                $this->addUsingAlias(PagePeer::INTPARENTPAGEID, $parentpage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentpage['max'])) {
                $this->addUsingAlias(PagePeer::INTPARENTPAGEID, $parentpage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagePeer::INTPARENTPAGEID, $parentpage, $comparison);
    }

    /**
     * Filter the query on the intTypeID column
     *
     * Example usage:
     * <code>
     * $query->filterBytype(1234); // WHERE intTypeID = 1234
     * $query->filterBytype(array(12, 34)); // WHERE intTypeID IN (12, 34)
     * $query->filterBytype(array('min' => 12)); // WHERE intTypeID > 12
     * </code>
     *
     * @see       filterByPageType()
     *
     * @param     mixed $type The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function filterBytype($type = null, $comparison = null)
    {
        if (is_array($type)) {
            $useMinMax = false;
            if (isset($type['min'])) {
                $this->addUsingAlias(PagePeer::INTTYPEID, $type['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($type['max'])) {
                $this->addUsingAlias(PagePeer::INTTYPEID, $type['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagePeer::INTTYPEID, $type, $comparison);
    }

    /**
     * Filter the query on the intLanguageID column
     *
     * Example usage:
     * <code>
     * $query->filterBylanguage(1234); // WHERE intLanguageID = 1234
     * $query->filterBylanguage(array(12, 34)); // WHERE intLanguageID IN (12, 34)
     * $query->filterBylanguage(array('min' => 12)); // WHERE intLanguageID > 12
     * </code>
     *
     * @see       filterByLanguage()
     *
     * @param     mixed $language The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function filterBylanguage($language = null, $comparison = null)
    {
        if (is_array($language)) {
            $useMinMax = false;
            if (isset($language['min'])) {
                $this->addUsingAlias(PagePeer::INTLANGUAGEID, $language['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($language['max'])) {
                $this->addUsingAlias(PagePeer::INTLANGUAGEID, $language['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagePeer::INTLANGUAGEID, $language, $comparison);
    }

    /**
     * Filter the query on the intVisible column
     *
     * Example usage:
     * <code>
     * $query->filterByvisibl(1234); // WHERE intVisible = 1234
     * $query->filterByvisibl(array(12, 34)); // WHERE intVisible IN (12, 34)
     * $query->filterByvisibl(array('min' => 12)); // WHERE intVisible > 12
     * </code>
     *
     * @param     mixed $visibl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function filterByvisibl($visibl = null, $comparison = null)
    {
        if (is_array($visibl)) {
            $useMinMax = false;
            if (isset($visibl['min'])) {
                $this->addUsingAlias(PagePeer::INTVISIBLE, $visibl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visibl['max'])) {
                $this->addUsingAlias(PagePeer::INTVISIBLE, $visibl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagePeer::INTVISIBLE, $visibl, $comparison);
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
     * @return PageQuery The current query, for fluid interface
     */
    public function filterByorder($order = null, $comparison = null)
    {
        if (is_array($order)) {
            $useMinMax = false;
            if (isset($order['min'])) {
                $this->addUsingAlias(PagePeer::INTORDER, $order['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($order['max'])) {
                $this->addUsingAlias(PagePeer::INTORDER, $order['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagePeer::INTORDER, $order, $comparison);
    }

    /**
     * Filter the query on the strTitle column
     *
     * Example usage:
     * <code>
     * $query->filterBytitle('fooValue');   // WHERE strTitle = 'fooValue'
     * $query->filterBytitle('%fooValue%'); // WHERE strTitle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function filterBytitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagePeer::STRTITLE, $title, $comparison);
    }

    /**
     * Filter the query on the strSlug column
     *
     * Example usage:
     * <code>
     * $query->filterByslug('fooValue');   // WHERE strSlug = 'fooValue'
     * $query->filterByslug('%fooValue%'); // WHERE strSlug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function filterByslug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagePeer::STRSLUG, $slug, $comparison);
    }

    /**
     * Filter the query by a related Page object
     *
     * @param   Page|PropelCollection $page The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageQuery The current query, for fluid interface
     */
    public function filterByPageRelatedByparentpage($page, $comparison = null)
    {
        if ($page instanceof Page) {
            return $this
                ->addUsingAlias(PagePeer::INTPARENTPAGEID, $page->getid(), $comparison);
        } elseif ($page instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PagePeer::INTPARENTPAGEID, $page->toKeyValue('PrimaryKey', 'id'), $comparison);
        } else {
            throw new PropelException('filterByPageRelatedByparentpage() only accepts arguments of type Page or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PageRelatedByparentpage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function joinPageRelatedByparentpage($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PageRelatedByparentpage');

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
            $this->addJoinObject($join, 'PageRelatedByparentpage');
        }

        return $this;
    }

    /**
     * Use the PageRelatedByparentpage relation Page object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \m038\KunstkamerBundle\Model\PageQuery A secondary query class using the current class as primary query
     */
    public function usePageRelatedByparentpageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPageRelatedByparentpage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PageRelatedByparentpage', '\m038\KunstkamerBundle\Model\PageQuery');
    }

    /**
     * Filter the query by a related Language object
     *
     * @param   Language|PropelCollection $language The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageQuery The current query, for fluid interface
     */
    public function filterByLanguage($language, $comparison = null)
    {
        if ($language instanceof Language) {
            return $this
                ->addUsingAlias(PagePeer::INTLANGUAGEID, $language->getid(), $comparison);
        } elseif ($language instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PagePeer::INTLANGUAGEID, $language->toKeyValue('PrimaryKey', 'id'), $comparison);
        } else {
            throw new PropelException('filterByLanguage() only accepts arguments of type Language or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Language relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function joinLanguage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Language');

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
            $this->addJoinObject($join, 'Language');
        }

        return $this;
    }

    /**
     * Use the Language relation Language object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \m038\KunstkamerBundle\Model\LanguageQuery A secondary query class using the current class as primary query
     */
    public function useLanguageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLanguage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Language', '\m038\KunstkamerBundle\Model\LanguageQuery');
    }

    /**
     * Filter the query by a related PageType object
     *
     * @param   PageType|PropelCollection $pageType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageQuery The current query, for fluid interface
     */
    public function filterByPageType($pageType, $comparison = null)
    {
        if ($pageType instanceof PageType) {
            return $this
                ->addUsingAlias(PagePeer::INTTYPEID, $pageType->getid(), $comparison);
        } elseif ($pageType instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PagePeer::INTTYPEID, $pageType->toKeyValue('PrimaryKey', 'id'), $comparison);
        } else {
            throw new PropelException('filterByPageType() only accepts arguments of type PageType or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PageType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function joinPageType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PageType');

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
            $this->addJoinObject($join, 'PageType');
        }

        return $this;
    }

    /**
     * Use the PageType relation PageType object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \m038\KunstkamerBundle\Model\PageTypeQuery A secondary query class using the current class as primary query
     */
    public function usePageTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPageType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PageType', '\m038\KunstkamerBundle\Model\PageTypeQuery');
    }

    /**
     * Filter the query by a related PageMedia object
     *
     * @param   PageMedia $pageMedia  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageQuery The current query, for fluid interface
     */
    public function filterByPageMedia($pageMedia, $comparison = null)
    {
        if ($pageMedia instanceof PageMedia) {
            return $this
                ->addUsingAlias(PagePeer::INTID, $pageMedia->getpage(), $comparison);
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
     * @return PageQuery The current query, for fluid interface
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
     * Filter the query by a related PageTypeCustom object
     *
     * @param   PageTypeCustom $pageTypeCustom  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageQuery The current query, for fluid interface
     */
    public function filterByPageTypeCustom($pageTypeCustom, $comparison = null)
    {
        if ($pageTypeCustom instanceof PageTypeCustom) {
            return $this
                ->addUsingAlias(PagePeer::INTID, $pageTypeCustom->getpage(), $comparison);
        } elseif ($pageTypeCustom instanceof PropelCollection) {
            return $this
                ->usePageTypeCustomQuery()
                ->filterByPrimaryKeys($pageTypeCustom->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPageTypeCustom() only accepts arguments of type PageTypeCustom or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PageTypeCustom relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function joinPageTypeCustom($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PageTypeCustom');

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
            $this->addJoinObject($join, 'PageTypeCustom');
        }

        return $this;
    }

    /**
     * Use the PageTypeCustom relation PageTypeCustom object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \m038\KunstkamerBundle\Model\PageTypeCustomQuery A secondary query class using the current class as primary query
     */
    public function usePageTypeCustomQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPageTypeCustom($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PageTypeCustom', '\m038\KunstkamerBundle\Model\PageTypeCustomQuery');
    }

    /**
     * Filter the query by a related PageTypeMedia object
     *
     * @param   PageTypeMedia $pageTypeMedia  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageQuery The current query, for fluid interface
     */
    public function filterByPageTypeMedia($pageTypeMedia, $comparison = null)
    {
        if ($pageTypeMedia instanceof PageTypeMedia) {
            return $this
                ->addUsingAlias(PagePeer::INTID, $pageTypeMedia->getpage(), $comparison);
        } elseif ($pageTypeMedia instanceof PropelCollection) {
            return $this
                ->usePageTypeMediaQuery()
                ->filterByPrimaryKeys($pageTypeMedia->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPageTypeMedia() only accepts arguments of type PageTypeMedia or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PageTypeMedia relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function joinPageTypeMedia($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PageTypeMedia');

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
            $this->addJoinObject($join, 'PageTypeMedia');
        }

        return $this;
    }

    /**
     * Use the PageTypeMedia relation PageTypeMedia object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \m038\KunstkamerBundle\Model\PageTypeMediaQuery A secondary query class using the current class as primary query
     */
    public function usePageTypeMediaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPageTypeMedia($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PageTypeMedia', '\m038\KunstkamerBundle\Model\PageTypeMediaQuery');
    }

    /**
     * Filter the query by a related PageTypeText object
     *
     * @param   PageTypeText $pageTypeText  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageQuery The current query, for fluid interface
     */
    public function filterByPageTypeText($pageTypeText, $comparison = null)
    {
        if ($pageTypeText instanceof PageTypeText) {
            return $this
                ->addUsingAlias(PagePeer::INTID, $pageTypeText->getpage(), $comparison);
        } elseif ($pageTypeText instanceof PropelCollection) {
            return $this
                ->usePageTypeTextQuery()
                ->filterByPrimaryKeys($pageTypeText->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPageTypeText() only accepts arguments of type PageTypeText or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PageTypeText relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function joinPageTypeText($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PageTypeText');

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
            $this->addJoinObject($join, 'PageTypeText');
        }

        return $this;
    }

    /**
     * Use the PageTypeText relation PageTypeText object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \m038\KunstkamerBundle\Model\PageTypeTextQuery A secondary query class using the current class as primary query
     */
    public function usePageTypeTextQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPageTypeText($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PageTypeText', '\m038\KunstkamerBundle\Model\PageTypeTextQuery');
    }

    /**
     * Filter the query by a related Page object
     *
     * @param   Page $page  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PageQuery The current query, for fluid interface
     */
    public function filterByPageRelatedByid($page, $comparison = null)
    {
        if ($page instanceof Page) {
            return $this
                ->addUsingAlias(PagePeer::INTID, $page->getparentpage(), $comparison);
        } elseif ($page instanceof PropelCollection) {
            return $this
                ->usePageRelatedByidQuery()
                ->filterByPrimaryKeys($page->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPageRelatedByid() only accepts arguments of type Page or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PageRelatedByid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function joinPageRelatedByid($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PageRelatedByid');

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
            $this->addJoinObject($join, 'PageRelatedByid');
        }

        return $this;
    }

    /**
     * Use the PageRelatedByid relation Page object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \m038\KunstkamerBundle\Model\PageQuery A secondary query class using the current class as primary query
     */
    public function usePageRelatedByidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPageRelatedByid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PageRelatedByid', '\m038\KunstkamerBundle\Model\PageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Page $page Object to remove from the list of results
     *
     * @return PageQuery The current query, for fluid interface
     */
    public function prune($page = null)
    {
        if ($page) {
            $this->addUsingAlias(PagePeer::INTID, $page->getid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BasePageQuery
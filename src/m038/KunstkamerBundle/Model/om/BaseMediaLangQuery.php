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
use m038\KunstkamerBundle\Model\Media;
use m038\KunstkamerBundle\Model\MediaLang;
use m038\KunstkamerBundle\Model\MediaLangPeer;
use m038\KunstkamerBundle\Model\MediaLangQuery;

/**
 * Base class that represents a query for the 'tblMedia_lang' table.
 *
 * 
 *
 * @method     MediaLangQuery orderByid($order = Criteria::ASC) Order by the intID column
 * @method     MediaLangQuery orderBymedia($order = Criteria::ASC) Order by the intMediaID column
 * @method     MediaLangQuery orderBylanguage($order = Criteria::ASC) Order by the intLanguageID column
 * @method     MediaLangQuery orderByname($order = Criteria::ASC) Order by the strName column
 * @method     MediaLangQuery orderBydescription($order = Criteria::ASC) Order by the txtDescription column
 * @method     MediaLangQuery orderBycopyright($order = Criteria::ASC) Order by the strCopyright column
 *
 * @method     MediaLangQuery groupByid() Group by the intID column
 * @method     MediaLangQuery groupBymedia() Group by the intMediaID column
 * @method     MediaLangQuery groupBylanguage() Group by the intLanguageID column
 * @method     MediaLangQuery groupByname() Group by the strName column
 * @method     MediaLangQuery groupBydescription() Group by the txtDescription column
 * @method     MediaLangQuery groupBycopyright() Group by the strCopyright column
 *
 * @method     MediaLangQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MediaLangQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MediaLangQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MediaLangQuery leftJoinMedia($relationAlias = null) Adds a LEFT JOIN clause to the query using the Media relation
 * @method     MediaLangQuery rightJoinMedia($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Media relation
 * @method     MediaLangQuery innerJoinMedia($relationAlias = null) Adds a INNER JOIN clause to the query using the Media relation
 *
 * @method     MediaLangQuery leftJoinLanguage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Language relation
 * @method     MediaLangQuery rightJoinLanguage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Language relation
 * @method     MediaLangQuery innerJoinLanguage($relationAlias = null) Adds a INNER JOIN clause to the query using the Language relation
 *
 * @method     MediaLang findOne(PropelPDO $con = null) Return the first MediaLang matching the query
 * @method     MediaLang findOneOrCreate(PropelPDO $con = null) Return the first MediaLang matching the query, or a new MediaLang object populated from the query conditions when no match is found
 *
 * @method     MediaLang findOneByid(int $intID) Return the first MediaLang filtered by the intID column
 * @method     MediaLang findOneBymedia(int $intMediaID) Return the first MediaLang filtered by the intMediaID column
 * @method     MediaLang findOneBylanguage(int $intLanguageID) Return the first MediaLang filtered by the intLanguageID column
 * @method     MediaLang findOneByname(string $strName) Return the first MediaLang filtered by the strName column
 * @method     MediaLang findOneBydescription(string $txtDescription) Return the first MediaLang filtered by the txtDescription column
 * @method     MediaLang findOneBycopyright(string $strCopyright) Return the first MediaLang filtered by the strCopyright column
 *
 * @method     array findByid(int $intID) Return MediaLang objects filtered by the intID column
 * @method     array findBymedia(int $intMediaID) Return MediaLang objects filtered by the intMediaID column
 * @method     array findBylanguage(int $intLanguageID) Return MediaLang objects filtered by the intLanguageID column
 * @method     array findByname(string $strName) Return MediaLang objects filtered by the strName column
 * @method     array findBydescription(string $txtDescription) Return MediaLang objects filtered by the txtDescription column
 * @method     array findBycopyright(string $strCopyright) Return MediaLang objects filtered by the strCopyright column
 *
 * @package    propel.generator.src.m038.KunstkamerBundle.Model.om
 */
abstract class BaseMediaLangQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseMediaLangQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'm038\\KunstkamerBundle\\Model\\MediaLang', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MediaLangQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return MediaLangQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MediaLangQuery) {
            return $criteria;
        }
        $query = new MediaLangQuery();
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
     * @return   MediaLang|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MediaLangPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MediaLangPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MediaLang A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `INTID`, `INTMEDIAID`, `INTLANGUAGEID`, `STRNAME`, `TXTDESCRIPTION`, `STRCOPYRIGHT` FROM `tblMedia_lang` WHERE `INTID` = :p0';
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
            $obj = new MediaLang();
            $obj->hydrate($row);
            MediaLangPeer::addInstanceToPool($obj, (string) $key);
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
     * @return MediaLang|array|mixed the result, formatted by the current formatter
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
     * @return MediaLangQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MediaLangPeer::INTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MediaLangQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MediaLangPeer::INTID, $keys, Criteria::IN);
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
     * @return MediaLangQuery The current query, for fluid interface
     */
    public function filterByid($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MediaLangPeer::INTID, $id, $comparison);
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
     * @return MediaLangQuery The current query, for fluid interface
     */
    public function filterBymedia($media = null, $comparison = null)
    {
        if (is_array($media)) {
            $useMinMax = false;
            if (isset($media['min'])) {
                $this->addUsingAlias(MediaLangPeer::INTMEDIAID, $media['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($media['max'])) {
                $this->addUsingAlias(MediaLangPeer::INTMEDIAID, $media['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MediaLangPeer::INTMEDIAID, $media, $comparison);
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
     * @return MediaLangQuery The current query, for fluid interface
     */
    public function filterBylanguage($language = null, $comparison = null)
    {
        if (is_array($language)) {
            $useMinMax = false;
            if (isset($language['min'])) {
                $this->addUsingAlias(MediaLangPeer::INTLANGUAGEID, $language['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($language['max'])) {
                $this->addUsingAlias(MediaLangPeer::INTLANGUAGEID, $language['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MediaLangPeer::INTLANGUAGEID, $language, $comparison);
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
     * @return MediaLangQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MediaLangPeer::STRNAME, $name, $comparison);
    }

    /**
     * Filter the query on the txtDescription column
     *
     * Example usage:
     * <code>
     * $query->filterBydescription('fooValue');   // WHERE txtDescription = 'fooValue'
     * $query->filterBydescription('%fooValue%'); // WHERE txtDescription LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MediaLangQuery The current query, for fluid interface
     */
    public function filterBydescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MediaLangPeer::TXTDESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the strCopyright column
     *
     * Example usage:
     * <code>
     * $query->filterBycopyright('fooValue');   // WHERE strCopyright = 'fooValue'
     * $query->filterBycopyright('%fooValue%'); // WHERE strCopyright LIKE '%fooValue%'
     * </code>
     *
     * @param     string $copyright The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MediaLangQuery The current query, for fluid interface
     */
    public function filterBycopyright($copyright = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($copyright)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $copyright)) {
                $copyright = str_replace('*', '%', $copyright);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MediaLangPeer::STRCOPYRIGHT, $copyright, $comparison);
    }

    /**
     * Filter the query by a related Media object
     *
     * @param   Media|PropelCollection $media The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MediaLangQuery The current query, for fluid interface
     */
    public function filterByMedia($media, $comparison = null)
    {
        if ($media instanceof Media) {
            return $this
                ->addUsingAlias(MediaLangPeer::INTMEDIAID, $media->getid(), $comparison);
        } elseif ($media instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MediaLangPeer::INTMEDIAID, $media->toKeyValue('PrimaryKey', 'id'), $comparison);
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
     * @return MediaLangQuery The current query, for fluid interface
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
     * Filter the query by a related Language object
     *
     * @param   Language|PropelCollection $language The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MediaLangQuery The current query, for fluid interface
     */
    public function filterByLanguage($language, $comparison = null)
    {
        if ($language instanceof Language) {
            return $this
                ->addUsingAlias(MediaLangPeer::INTLANGUAGEID, $language->getid(), $comparison);
        } elseif ($language instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MediaLangPeer::INTLANGUAGEID, $language->toKeyValue('PrimaryKey', 'id'), $comparison);
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
     * @return MediaLangQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   MediaLang $mediaLang Object to remove from the list of results
     *
     * @return MediaLangQuery The current query, for fluid interface
     */
    public function prune($mediaLang = null)
    {
        if ($mediaLang) {
            $this->addUsingAlias(MediaLangPeer::INTID, $mediaLang->getid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BaseMediaLangQuery
<?php

namespace m038\KunstkamerBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'tblPageTypeCustom' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.m038.KunstkamerBundle.Model.map
 */
class PageTypeCustomTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.m038.KunstkamerBundle.Model.map.PageTypeCustomTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('tblPageTypeCustom');
        $this->setPhpName('PageTypeCustom');
        $this->setClassname('m038\\KunstkamerBundle\\Model\\PageTypeCustom');
        $this->setPackage('src.m038.KunstkamerBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('INTID', 'id', 'INTEGER', true, 10, null);
        $this->addForeignKey('INTPAGEID', 'page', 'INTEGER', 'tblPages', 'INTID', true, 10, null);
        $this->addColumn('STRIDENTIFYINGSLUG', 'identifyingslug', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Page', 'm038\\KunstkamerBundle\\Model\\Page', RelationMap::MANY_TO_ONE, array('intPageID' => 'intID', ), 'CASCADE', 'CASCADE');
    } // buildRelations()

} // PageTypeCustomTableMap

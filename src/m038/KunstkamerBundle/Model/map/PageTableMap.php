<?php

namespace m038\KunstkamerBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'tblPages' table.
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
class PageTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.m038.KunstkamerBundle.Model.map.PageTableMap';

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
        $this->setName('tblPages');
        $this->setPhpName('Page');
        $this->setClassname('m038\\KunstkamerBundle\\Model\\Page');
        $this->setPackage('src.m038.KunstkamerBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('INTID', 'id', 'INTEGER', true, 10, null);
        $this->addForeignKey('INTPARENTPAGEID', 'parentpage', 'INTEGER', 'tblPages', 'INTID', false, 10, 0);
        $this->addForeignKey('INTTYPEID', 'type', 'INTEGER', 'tblPageTypes', 'INTID', true, 10, null);
        $this->addForeignKey('INTLANGUAGEID', 'language', 'INTEGER', 'tblLanguages', 'INTID', true, 10, null);
        $this->addColumn('INTVISIBLE', 'visibl', 'INTEGER', true, null, null);
        $this->addColumn('INTORDER', 'order', 'INTEGER', true, null, null);
        $this->addColumn('STRTITLE', 'title', 'VARCHAR', true, 255, null);
        $this->addColumn('STRSLUG', 'slug', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PageRelatedByparentpage', 'm038\\KunstkamerBundle\\Model\\Page', RelationMap::MANY_TO_ONE, array('intParentPageID' => 'intID', ), 'CASCADE', 'CASCADE');
        $this->addRelation('Language', 'm038\\KunstkamerBundle\\Model\\Language', RelationMap::MANY_TO_ONE, array('intLanguageID' => 'intID', ), 'CASCADE', 'CASCADE');
        $this->addRelation('PageType', 'm038\\KunstkamerBundle\\Model\\PageType', RelationMap::MANY_TO_ONE, array('intTypeID' => 'intID', ), 'CASCADE', 'CASCADE');
        $this->addRelation('PageMedia', 'm038\\KunstkamerBundle\\Model\\PageMedia', RelationMap::ONE_TO_MANY, array('intID' => 'intPageID', ), 'CASCADE', 'CASCADE', 'PageMedias');
        $this->addRelation('PageTypeCustom', 'm038\\KunstkamerBundle\\Model\\PageTypeCustom', RelationMap::ONE_TO_MANY, array('intID' => 'intPageID', ), 'CASCADE', 'CASCADE', 'PageTypeCustoms');
        $this->addRelation('PageTypeMedia', 'm038\\KunstkamerBundle\\Model\\PageTypeMedia', RelationMap::ONE_TO_MANY, array('intID' => 'intPageID', ), 'CASCADE', 'CASCADE', 'PageTypeMedias');
        $this->addRelation('PageTypeText', 'm038\\KunstkamerBundle\\Model\\PageTypeText', RelationMap::ONE_TO_MANY, array('intID' => 'intPageID', ), 'CASCADE', 'CASCADE', 'PageTypeTexts');
        $this->addRelation('PageRelatedByid', 'm038\\KunstkamerBundle\\Model\\Page', RelationMap::ONE_TO_MANY, array('intID' => 'intParentPageID', ), 'CASCADE', 'CASCADE', 'PagesRelatedByid');
    } // buildRelations()

} // PageTableMap

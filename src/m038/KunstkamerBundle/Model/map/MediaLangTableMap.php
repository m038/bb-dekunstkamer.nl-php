<?php

namespace m038\KunstkamerBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'tblMedia_lang' table.
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
class MediaLangTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.m038.KunstkamerBundle.Model.map.MediaLangTableMap';

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
        $this->setName('tblMedia_lang');
        $this->setPhpName('MediaLang');
        $this->setClassname('m038\\KunstkamerBundle\\Model\\MediaLang');
        $this->setPackage('src.m038.KunstkamerBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('INTID', 'id', 'INTEGER', true, 10, null);
        $this->addForeignKey('INTMEDIAID', 'media', 'INTEGER', 'tblMedia', 'INTID', true, 10, null);
        $this->addForeignKey('INTLANGUAGEID', 'language', 'INTEGER', 'tblLanguages', 'INTID', true, 10, null);
        $this->addColumn('STRNAME', 'name', 'VARCHAR', false, 255, null);
        $this->addColumn('TXTDESCRIPTION', 'description', 'VARCHAR', false, 255, null);
        $this->addColumn('STRCOPYRIGHT', 'copyright', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Media', 'm038\\KunstkamerBundle\\Model\\Media', RelationMap::MANY_TO_ONE, array('intMediaID' => 'intID', ), 'CASCADE', 'CASCADE');
        $this->addRelation('Language', 'm038\\KunstkamerBundle\\Model\\Language', RelationMap::MANY_TO_ONE, array('intLanguageID' => 'intID', ), 'CASCADE', 'CASCADE');
    } // buildRelations()

} // MediaLangTableMap

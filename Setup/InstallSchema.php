<?php


namespace Gentoma\Helpdesk\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use \Gentoma\Helpdesk\Helper\Logger;

class InstallSchema implements InstallSchemaInterface
{

    const TABLE_NAME = 'tickets';

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        try {
            Logger::log(
                'Start action create table ' . self::TABLE_NAME
            );

            $table = $installer->getConnection()->newTable(self::TABLE_NAME);

            $table->addColumn(
                'ticket_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'primary'  => true,
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false
                ],
                'Ticket ID'
            );

            $table->addColumn(
                'customer_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'unsigned' => true
                ],
                'Customer ID'
            );

            $table->addColumn(
                'title',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false
                ],
                'Title of ticket'
            );

            $table->addColumn(
                'level',
                Table::TYPE_SMALLINT,
                null,
                [
                    'nullable' => false
                ],
                'Level of ticket'
            );

            $table->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'nullable' => false
                ],
                'Status of ticket'
            );

            $table->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false
                ],
                'Created at'
            );

            $table->addIndex(
                $installer->getIdxName(self::TABLE_NAME, ['customer_id']),
                ['customer_id']
            );

            $table->addForeignKey(
                $installer->getFkName(
                    self::TABLE_NAME, 'customer_id', 'customer_entity',
                    'entity_id'
                ),
                'customer_id',
                $installer->getTable('customer_entity'),
                'entity_id',
                Table::ACTION_SET_NULL
            );

            $table->setComment("Gentoma's Helpdesk Ticket");

            $installer->getConnection()->createTable($table);
        } catch (\Zend_Db_Exception $e) {
            Logger::log($e->getMessage());
        } finally {
            Logger::log('End action create table ' . self::TABLE_NAME);
        }

        $setup->endSetup();
    }
}

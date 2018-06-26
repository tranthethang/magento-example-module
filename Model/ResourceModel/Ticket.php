<?php

namespace Gentoma\Helpdesk\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Ticket extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('tickets', 'ticket_id');
    }
}
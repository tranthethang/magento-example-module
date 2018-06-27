<?php

namespace Gentoma\Helpdesk\Model\ResourceModel\Ticket;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(
            'Gentoma\Helpdesk\Model\Ticket',
            'Gentoma\Helpdesk\Model\ResourceModel\Ticket'
        );
    }
}

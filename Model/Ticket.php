<?php

namespace Gentoma\Helpdesk\Model;

use Magento\Framework\Model\AbstractModel;
use Gentoma\Helpdesk\Api\Data\TicketInterface;

class Ticket extends AbstractModel implements TicketInterface
{
    const STATUS_OPENED = 1;
    const STATUS_CLOSED = 0;

    const LEVEL_LOW = 0;
    const LEVEL_MEDIUM = 1;
    const LEVEL_HIGHT = 2;

    protected function _construct()
    {
        $this->_init('Gentoma\Helpdesk\Model\ResourceModel\Ticket');
    }

    public static $statuses
        = array(
            self::STATUS_OPENED => 'Opened',
            self::STATUS_CLOSED => 'Closed'
        );

    public static $leveles
        = array(
            self::LEVEL_LOW    => 'Low',
            self::LEVEL_MEDIUM => 'Medium',
            self::LEVEL_HIGHT  => 'Hight'
        );

    public function getStatusAsText()
    {
        return self::$statuses[$this->getStatus()];
    }

    public function getLevelAsText()
    {
        return self::$leveles[$this->getLevel()];
    }

    function getId()
    {
        return $this->getData(self::TICKET_ID);
    }

    function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    function getLevel()
    {
        return $this->getData(self::LEVEL);
    }

    function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    function setId($id)
    {
        return $this->setData(self::TICKET_ID, $id);
    }

    function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    function setLevel($level)
    {
        return $this->setData(self::LEVEL, $level);
    }

    function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
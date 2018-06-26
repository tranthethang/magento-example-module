<?php

namespace Gentoma\Helpdesk\Api\Data;

interface TicketInterface
{
    const TICKET_ID = 'ticket_id';
    const CUSTOMER_ID = 'customer_id';
    const TITLE = 'title';
    const LEVEL = 'level';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';

    function getId();

    function getCustomerId();

    function getTitle();

    function getLevel();

    function getStatus();

    function getCreatedAt();

    function setId($id);

    function setCustomerId($customerId);

    function setTitle($title);

    function setLevel($level);

    function setStatus($status);

    function setCreatedAt($createdAt);
}
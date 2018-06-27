<?php


namespace Gentoma\Helpdesk\Block\Index;

use Magento\Framework\View\Element\Template\Context;
use Gentoma\Helpdesk\Helper\BEM;
use Gentoma\Helpdesk\Model\Ticket;
use Gentoma\Helpdesk\Model\ResourceModel\Ticket\Collection;
use Magento\Customer\Model\Session;
use Psr\Log\LoggerInterface;


class Index extends \Magento\Framework\View\Element\Template
{
    public $bem;

    protected $logger;
    protected $customerSession;
    protected $resourceModelTicketCollection;


    public function __construct(Context $context,
        Collection $resourceModelTicketCollection,
        Session $customerSession,
        LoggerInterface $logger,
        array $data = []
    ) {
        $this->logger = $logger;
        $this->customerSession = $customerSession;
        $this->resourceModelTicketCollection = $resourceModelTicketCollection;

        $this->bem = new BEM('g-frm_helpdesk', 'send');

        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getStatuses()
    {
        return Ticket::$statuses;
    }

    /**
     * @return array
     */
    public function getLeveles()
    {
        return Ticket::$leveles;
    }

    /**
     * @return string
     */
    public function getFromAction()
    {
        return $this->getUrl('gentoma_helpdesk/index/save');
    }

    /**
     * @return \Gentoma\Helpdesk\Model\ResourceModel\Ticket\Collection
     */
    public function getTickets()
    {
        $customerId =
        $tickets = $this->resourceModelTicketCollection
            ->addFieldToFilter(
            'customer_id', $this->customerSession->getCustomerId()
        );

        return $tickets;
    }
}

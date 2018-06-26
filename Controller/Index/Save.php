<?php


namespace Gentoma\Helpdesk\Controller\Index;

use Gentoma\Helpdesk\Helper\Logger;
use Gentoma\Helpdesk\Model\TicketFactory;
use Gentoma\Helpdesk\Model\ResourceModel\Ticket as ResourceModelTicket;
use Gentoma\Helpdesk\Model\Ticket;

use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Stdlib\DateTime;


class Save extends \Gentoma\Helpdesk\Controller\Index
{

    protected $resultPageFactory, $formKeyValidator, $dateTime, $ticketFactory, $resourceModelTicket;

    /**
     * Save constructor.
     *
     * @param \Magento\Framework\App\Action\Context          $context
     * @param \Magento\Customer\Model\Session                $customerSession
     * @param \Magento\Framework\View\Result\PageFactory     $resultPageFactory
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \Magento\Framework\Stdlib\DateTime             $dateTime
     * @param \Gentoma\Helpdesk\Model\TicketFactory          $ticketFactory
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        PageFactory $resultPageFactory,
        Validator $formKeyValidator,
        DateTime $dateTime,
        TicketFactory $ticketFactory,
        ResourceModelTicket $resourceModelTicket
    ) {

        $this->resultPageFactory = $resultPageFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->dateTime = $dateTime;
        $this->ticketFactory = $ticketFactory;
        $this->resourceModelTicket = $resourceModelTicket;

        parent::__construct($context, $customerSession);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        #TODO: Validate form key by security reason.
        if (!$this->formKeyValidator->validate($this->getRequest())) {
            return $resultRedirect->setRefererUrl();
        }

        #TODO: Get form data from request.
        $title = $this->getRequest()->getParam('title');
        $level = $this->getRequest()->getParam('level');

        #TODO: Insert to DB.
        try {
            $ticket = $this->ticketFactory->create();
            $ticket->setCustomerId($this->customerSession->getCustomerId());
            $ticket->setTitle($title);
            $ticket->setCreatedAt($this->dateTime->formatDate(true));
            $ticket->setStatus(Ticket::STATUS_OPENED);

            $this->resourceModelTicket->save($ticket);

            $this->messageManager->addSuccessMessage(
                __('Ticket successfully created.')
            );
        } catch (\Exception $e) {
            Logger::log($e);
            $this->messageManager->addErrorMessage(
                __('Error occurred during ticket creation.')
            );
        }

        return $resultRedirect->setRefererUrl();
    }
}

<?php


namespace Gentoma\Helpdesk\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Gentoma\Helpdesk\Controller\Index
{

    protected $resultPageFactory;

    /**
     * Index constructor.
     *
     * @param Context     $context
     * @param Session     $customerSession
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context, Session $customerSession,
        PageFactory $resultPageFactory
    ) {

        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $customerSession);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}

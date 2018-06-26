<?php


namespace Gentoma\Helpdesk\Block\Index;

use Magento\Framework\View\Element\Template;
use Gentoma\Helpdesk\Helper\BEM;
use Gentoma\Helpdesk\Model\Ticket;

class Index extends \Magento\Framework\View\Element\Template
{
    public $bem;

    public function __construct(Template\Context $context, array $data = [])
    {
        $this->bem = new BEM('g-frm_helpdesk', 'send');
        parent::__construct($context, $data);
    }

    public function getStatuses()
    {
        return Ticket::$statuses;
    }

    public function getLeveles()
    {
        return Ticket::$leveles;
    }

    public function getFromAction()
    {
        return $this->getUrl('gentoma_helpdesk/index/save');
    }
}

<?php

namespace Gentoma\Helpdesk\Controller\Index;

class Index extends \Gentoma\Helpdesk\Controller\Index
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}

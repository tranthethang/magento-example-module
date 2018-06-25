<?php


namespace Gentoma\Helpdesk\Block\Index;

class Index extends \Magento\Framework\View\Element\Template
{

    const BEM_BLOCK = 'g-frm_helpdesk--create';

    public function bemGetBlock()
    {
        return self::BEM_BLOCK;
    }

    public function bemGetElementClass($element = '', $state = [], $extra = [])
    {
        if (empty($element)) {
            return '';
        }

        $class = [self::BEM_BLOCK . '__' . $element];

        return implode(' ', $class);
    }

}

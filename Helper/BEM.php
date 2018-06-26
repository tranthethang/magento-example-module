<?php

namespace Gentoma\Helpdesk\Helper;

class BEM
{

    private $_block, $_modifier;

    public function __construct($block = '', $modifier = '')
    {
        $this->_block = $block;
        $this->_modifier = $modifier;
    }

    public function getBlock()
    {
        return sprintf('%s--%s', $this->_block, $this->_modifier);
    }

    public function element($element = '', $state = [], $classes = [],
        $echo = false
    ) {

        $mix[] = $element ? sprintf('%s__%s', $this->getBlock(), $element)
            : $this->getBlock();

        if ($classes) {
            $mix = array_merge($mix, $classes);
        }

        if ($state) {
            $mix = array_merge($mix, $this->_extractState($state));
        }

        $mix = implode(' ', $mix);

        if ($echo) {
            echo $mix;
        }

        return $mix;
    }

    private function _extractState($state)
    {
        return array_map(
            function ($s) {
                return 'is-' . $s;
            }, $state
        );
    }

}
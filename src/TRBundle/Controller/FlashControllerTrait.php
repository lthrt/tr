<?php

namespace TRBundle\Controller;

trait FlashControllerTrait
{
    // helper functions
    private function _flash(
        $type,
        $message
    ) {
        if ($message) {
            $this->get('session')->getFlashBag()->add($type, $message);
        }
    }

    private function danger($message = null)
    {
        $this->_flash(__FUNCTION__, $message);
    }

    private function info($message = null)
    {
        $this->_flash(__FUNCTION__, $message);
    }

    private function success($message = null)
    {
        $this->_flash(__FUNCTION__, $message);
    }

    private function warning($message = null)
    {
        $this->_flash(__FUNCTION__, $message);
    }
}

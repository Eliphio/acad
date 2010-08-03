<?php

/**
 * View Helper to Display Flash Messages.
 *
 * Checks for messages from previous requests and from the current request.
 *
 * Checks for `array($key => $value)` pairs in FlashMessenger's messages array.
 * If such a pair is found, $key is taken as the "message level", $value as the
 * message. (Simple strings are provided a default level of 'warning'.)
 *
 * NOTE: MESSAGES ARE PRESUMED TO BE SAFE HTML. IF REDISPLAYING USER
 * INPUT, ESCAPE ALL MESSAGES PRIOR TO ADDING TO FLASHMESSENGER.
 *
 * @package FlashMessenger_View
 */
class App_Helpers_FlashMessenger extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * @var Zend_Controller_Action_Helper_FlashMessenger
     */
    private $_flashMessenger = null;

    /**
     * Display Flash Messages.
     *
     * @param  string $key Message level for string messages
     * @param  string $template Format string for message output
     * @return string Flash messages formatted for output
     */
    public function flashMessenger($key = 'warning',
                                   $template='<p class="%s">%s</p>')
    {
        $flashMessenger = $this->_getFlashMessenger();

        //get messages from previous requests
        $messages = $flashMessenger->getMessages();

        //add any messages from this request
        if ($flashMessenger->hasCurrentMessages()) {
            $messages = array_merge(
                $messages,
                $flashMessenger->getCurrentMessages()
            );
            //we don't need to display them twice.
            $flashMessenger->clearCurrentMessages();
        }

        //initialise return string
        $output ='';

        //process messages
        foreach ($messages as $message)
        {
            if (is_array($message)) {
                list($key,$message) = each($message);
            }
            $output .= sprintf($template,$key,$message);
        }

        return $output;
    }

    /**
     * Lazily fetches FlashMessenger Instance.
     *
     * @return Zend_Controller_Action_Helper_FlashMessenger
     */
    public function _getFlashMessenger()
    {
        if (null === $this->_flashMessenger) {
            $this->_flashMessenger =
                Zend_Controller_Action_HelperBroker::getStaticHelper(
                    'FlashMessenger');
        }
        return $this->_flashMessenger;
    }
}
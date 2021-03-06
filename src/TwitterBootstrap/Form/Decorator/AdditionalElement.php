<?php
/**
 * @author gabriel
 */
 
namespace TwitterBootstrap\Form\Decorator;

use \Zend\Form\Decorator\AbstractDecorator;

class AdditionalElement extends AbstractDecorator
{
    /**
     * Decorate content and/or element
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        /* @var $element \Zend\Form\Element */
        $element = $this->getElement();
        if (!$element instanceof \Zend\Form\Element) {
            return $content;
        }

        $isActive = (bool) $element->getAttrib('isActive');

        $tag = $this->getOption('tag');
        $tag = empty($tag) ? 'span' : $tag;

        $class = $this->getOption('class');
        $class = trim($class);
        $class = array(
            'add-on',
            empty($class) ?: $class,
            $isActive ? 'active' : ''
        );
        $class = implode(' ', $class);


        $additionalContent = $element->getAttrib('content');
        $additionalContent = empty($tag) ? '' : $additionalContent;

        $deoration = '<%1$s class="%2$s">%3$s</%1$s>';
        $deoration = sprintf($deoration, $tag, $class, $additionalContent);

        switch($this->getPlacement())
        {
            case self::PREPEND:
                return $deoration.$content;
            case self::APPEND:
            default:
                return $content.$deoration;
        }
    }
}
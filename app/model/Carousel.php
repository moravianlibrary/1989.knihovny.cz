<?php

namespace App\Model;

use Nette\Utils\Html;

class Carousel {
    protected $html, $param, $slides;

    function __construct($param = []) {
        $this->slides = [];
        $this->allowControls = $param['allowControls'] ?? FALSE;
        $class = isset($param['class']) ? (is_array($param['class']) ? $param['class'] : [ $param['class'] ]) : [];

        $this->html = Html::el('div data-ride="carousel"')
            ->setAttribute('class', array_merge([ 'carousel' ], $class))
            ->setAttribute('id', $param['id'] ?? NULL);
    }

    function add_slide(array $param) {
        $class = isset($param['class']) ? (is_array($param['class']) ? $param['class'] : [ $param['class'] ]) : [];
        $img = $param['img'] ?? NULL;

        $slide = Html::el('div')
            ->setAttribute('class', array_merge($class, [ 'carousel-item' ]))
            ->setAttribute('id', $param['id'] ?? NULL);

        if($img && isset($img['src'])) {
            $img = Html::el('img')
                ->setAttribute('src', $img['src'])
                ->setAttribute('class', isset($img['class']) ? (is_array($class = $img['class']) ? $class : [ $class ]) : NULL)
                ->setAttribute('alt', $img['alt'] ?? NULL);
            $slide->addHtml($img);
        }
        $this->slides[] = $slide;

        return $this;
    }

    function render() {
        //create inner carousel content
        $inner = Html::el('div class="carousel-inner"');
        foreach($this->slides as $slide)
            $inner->addHtml($slide);
        //add inner content to carousel
        $this->html->addHtml($inner);

        //add control elements
        if(isset($this->param['allowControls']) && $this->param['allowControls'] === TRUE)
            $this->add_controls();

        return $this->html->render();
    }

    function add_controls() {
        //todo
    }
}
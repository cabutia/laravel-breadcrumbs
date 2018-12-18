<?php

namespace Nova\Breadcrumbs\Classes;

use Illuminate\Support\Collection;

class Breadcrumb
{
    protected $html;
    protected $config;
    protected $maxId = 0;
    protected $breadrcumbs;

    protected $last;
    protected $first;

    public function __construct ()
    {
        $this->html = '';
        $this->config = config('nova-breadcrumbs');
        $this->breadcrumbs =  new Collection();
    }

    public function __toString ()
    {
        $this->breadcrumbs = $this->breadcrumbs->reverse();
        $this->last = $this->breadcrumbs->last();
        $this->first = $this->breadcrumbs->first();
        if ($this->breadcrumbs->count() > 0) {
            $this->_init();
            $this->buildContent();
            $this->_end();
        }
        return $this->html;
    }

    protected function _init ()
    {
        $this->html .= $this->config['wrapper'] ? '<div class="'. $this->config['wrapper-class'] .'">' : '';
        $this->html .= '<'. $this->config['list-element'] .' class="'. $this->config['list-class'] .'">';
    }

    protected function _end ()
    {
        $this->html .= '</'. $this->config['list-element'] .'>';
        $this->html .= $this->config['wrapper'] ? '</div>' : '';
    }

    protected function buildContent ()
    {
        foreach ($this->breadcrumbs as $breadcrumb) {
            $_is_first = $this->first == $breadcrumb;
            $_not_last = $this->last !== $breadcrumb;
            $_is_last = $this->last == $breadcrumb;
            $this->html .= '<'. $this->config['item-element'] .' class="';
            $this->html .= $this->config['breadcrumb']['common'] . ' ';
            $this->html .= $_is_first ? ($this->config['breadcrumb']['first'] . ' ') : '';
            $this->html .= $_not_last ? ($this->config['breadcrumb']['before-last'] . ' ') : '';
            $this->html .= $_is_last ? ($this->config['breadcrumb']['last'] . ' ') : ' ';
            $this->html .= '">';
            $this->html .= '<a href="'. ($this->last == $breadcrumb ? '#' : $breadcrumb['route']) .'" class="';
            $this->html .= $this->config['anchor']['common'] . ' ';
            $this->html .= $_is_first ? ($this->config['anchor']['first'] . ' ') : '';
            $this->html .= $_not_last ? ($this->config['anchor']['before-last'] . ' ') : '';
            $this->html .= $_is_last ? ($this->config['anchor']['last'] . ' ') : ' ';
            $this->html .= '">';
            $this->html .= $breadcrumb['display'];
            $this->html .= '</a>';
            $this->html .= '</'. $this->config['item-element'] .'>';
        }
    }

    public function push ($display, $route = '#')
    {
        $this->breadcrumbs[] = [
            'display' => $display,
            'route' => $route,
            'id' => 'bread-' . $this->maxId
        ];
        $this->maxId++;
        return $this;
    }
}

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
        $this->html .= '<div class="'. $this->config['wrapper-class'] .'">';
        $this->html .= '<ol class="'. $this->config['list-class'] .'">';
    }

    protected function _end ()
    {
        $this->html .= '</ol>';
        $this->html .= '</div>';
    }

    protected function buildContent ()
    {
        foreach ($this->breadcrumbs as $breadcrumb) {
            $this->html .= '<li  class="';
            $this->html .= $this->config['breadcrumb-common-class'] . ' ';
            $this->html .= $this->first == $breadcrumb ? ($this->config['breadcrumb-first-class'] . ' ') : '';
            $this->html .= $this->last !== $breadcrumb ? ($this->config['breadcrumb-before-last-class'] . ' ') : '';
            $this->html .= $this->last == $breadcrumb ? ($this->config['breadcrumb-last-class'] . ' ') : ' ';
            $this->html .= '">';
            $this->html .= '<a href="'. ($this->last == $breadcrumb ? '#' : $breadcrumb['route']) .'">';
            $this->html .= $breadcrumb['display'];
            $this->html .= '</a>';
            $this->html .= '</li>';
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

<?php

namespace Nova\Breadcrumbs\Classes;

use Illuminate\Support\Collection;

class Breadcrumb
{
    protected $html;
    protected $maxId = 0;
    protected $breadrcumbs;

    public function __construct ()
    {
        $this->html = '';
        $this->breadcrumbs =  new Collection();
    }

    public function __toString ()
    {
        $this->breadcrumbs = $this->breadcrumbs->reverse();
        $last = $this->breadcrumbs->last();
        if ($this->breadcrumbs->count() > 0) {
            $this->_init();
            $this->buildContent($last);
            $this->_end();
        }
        return $this->html;
    }

    protected function _init ()
    {
        $this->html .= '<nav class="__nova_breadcrumbs">';
        $this->html .= '<div class="nav-wrapper">';
        $this->html .= '<div class="col s12 no-padding">';
    }

    protected function _end ()
    {
        $this->html .= '</div>';
        $this->html .= '</div>';
        $this->html .= '</nav>';
    }

    protected function buildContent ($last)
    {
        foreach ($this->breadcrumbs as $breadcrumb) {
            $this->html .= '<a href="'. $breadcrumb['route'] .'" class="breadcrumb '. ($last == $breadcrumb ? 'cyan' : 'grey') .'-text">';
            $this->html .= $breadcrumb['display'];
            $this->html .= '</a>';
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

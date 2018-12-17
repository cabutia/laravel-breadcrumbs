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

    public function __construct ($config = null)
    {
        $this->html = '';
        $this->config = $this->buildConfig($config);
        $this->breadcrumbs =  new Collection();
    }

    protected function buildConfig ($config)
    {
        $defaults = [
            'main-wrapper-class' => '__nova_breadcrumbs',
            'first-wrapper-class' => 'nav-wrapper',
            'second-wrapper-class' => 'col s12 no-padding',
            'breadcrumb-common-class' => 'breadcrumb',
            'breadcrumb-first-class' => '',
            'breadcrumb-before-last-class' => 'grey-text',
            'breadcrumb-last-class' => 'cyan-text'
        ];
        if (!$config || !count($config) > 0) return $defaults;
        foreach ($config as $key => $value) {
            if (isset($defaults[$key])) {
                $defaults[$key] = $value;
            }
        }
        return $defaults;
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
        $this->html .= '<nav class="'. $this->config['main-wrapper-class'] .'">';
        $this->html .= '<div class="'. $this->config['first-wrapper-class'] .'">';
        $this->html .= '<div class="'. $this->config['second-wrapper-class'] .'">';
    }

    protected function _end ()
    {
        $this->html .= '</div>';
        $this->html .= '</div>';
        $this->html .= '</nav>';
    }

    protected function buildContent ()
    {
        foreach ($this->breadcrumbs as $breadcrumb) {
            $this->html .= '<a href="'. $breadcrumb['route'] .'" class="';
            $this->html .= $this->config['breadcrumb-common-class'] . ' ';
            $this->html .= $this->first == $breadcrumb ? ($this->config['breadcrumb-first-class'] . ' ') : '';
            $this->html .= $this->last !== $breadcrumb ? ($this->config['breadcrumb-before-last-class'] . ' ') : '';
            $this->html .= $this->last == $breadcrumb ? ($this->config['breadcrumb-last-class'] . ' ') : ' ';
            $this->html .= '">' . $breadcrumb['display'] . '</a>';
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

<?php

namespace App\Model;

class Page
{
    // Page properties
    public $title; // head title
    public $styles; // list of css
    public $scripts; // list of js
    public $header; // true/false
    public $body; // name of view
    public $footer; // true/false
    public $datas; // array with datas from DB

    // Assigning values in instantiation
    protected function __construct($title, $body, $styles, $scripts, $header, $footer)
    {
        $this->title = $title;
        $this->styles = $styles;
        $this->header = $header;
        $this->body = $body;
        $this->footer = $footer;
        $this->scripts = $scripts;
        $this->datas = [];
    }

    // Rendering all views
    public function render()
    {
        $this->renderHead();
        $this->renderHeader();
        $this->renderBody();
        $this->renderFooter();
        $this->renderFoot();
    }

    // Methods determining rendering behavior
    private function renderHead()
    {
        $title = $this->title;
        $styles = $this->styles;
        include_once './App/View/head.php';
    }

    private function renderHeader()
    {
        if ($this->header) {
            include_once './App/View/header.php';
        }
    }

    private function renderBody()
    {
        $datas = $this->datas;
        include_once './App/View/' . $this->body;
    }

    private function renderFooter()
    {
        if ($this->footer) {
            include_once './App/View/footer.php';
        }
    }

    private function renderFoot()
    {
        $scripts = $this->scripts;
        include_once './App/View/foot.php';
    }
}

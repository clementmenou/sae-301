<?php

class Page
{
    public $title;
    public $styles;
    public $scripts;
    public $header;
    public $body;
    public $footer;

    public function __construct($title, $body, $styles, $scripts, $header, $footer)
    {
        $this->title = $title;
        $this->styles = $styles;
        $this->header = $header;
        $this->body = $body;
        $this->footer = $footer;
        $this->scripts = $scripts;
    }

    public function render()
    {
        $this->renderHead();
        $this->renderHeader();
        $this->renderBody();
        $this->renderFooter();
        $this->renderFoot();
    }

    private function renderHead()
    {
        $title = $this->title;
        $styles = $this->styles;
        include_once './view/head.php';
    }

    private function renderHeader()
    {
        if ($this->header) {
            include_once './view/header.php';
        }
    }

    private function renderBody()
    {
        include_once './view/' . $this->body;
    }

    private function renderFooter()
    {
        if ($this->footer) {
            include_once './view/footer.php';
        }
    }

    private function renderFoot()
    {
        $scripts = $this->scripts;
        include_once './view/foot.php';
    }
}

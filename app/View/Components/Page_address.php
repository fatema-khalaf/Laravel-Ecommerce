<?php
namespace App\View\Components\Page_address;

use Illuminate\View\Component;

class Address extends Component
{
    public $title;
    public $page;
    public $subpage;
    public $route;


    public function __construct($title, $page, $subpage,$route)
    {
        $this->title  = $title;
        $this->page = $page;
        $this->subpage = $subpage;
        $this->route = $route;
    }

    public function render()
    {
        return view('components.address');
    }
}
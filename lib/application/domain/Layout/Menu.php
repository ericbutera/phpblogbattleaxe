<?php
class Layout_Menu extends baxe_Layout_RegionAbstract {

	public function getId() {
		return "menu";
	}

	public function render() {
        $menu =<<<MENU
        <ul id="nav">
	        <li><a href="/">Home</a></li>
	        <li><a href="/about">About</a></li>
        </ul>
MENU;
        return $menu;
	}

}

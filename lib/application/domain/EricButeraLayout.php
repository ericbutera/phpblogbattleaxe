<?php
class EricButeraLayout extends baxe_Layout {
    protected $layoutFile = 'pattern.php';
	public function registerRegions() {
        // $this->addRegion(new Layout_Header);
        $this->addRegion(new Layout_Menu);
	}

}

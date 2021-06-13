<?php
namespace App\View\Components;
use Illuminate\View\Component;

class slideShow extends Component {
	public $slideImages, $imageKey, $arrows;
	//Costruttore del componente
    public function __construct($slideImages, $imageKey, $arrows = false) {
		$this->slideImages = $slideImages;
		$this->imageKey = $imageKey;
		$this->arrows = $arrows;
    }
    public function render() {
        return view('components.slide-show');
    }
}

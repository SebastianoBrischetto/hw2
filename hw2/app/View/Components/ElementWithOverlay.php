<?php
namespace App\View\Components;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class ElementWithOverlay extends Component {
	public $image, $name, $id, $description, $behavior, $behaviorVar, $note, $truncate;
	//Costruttore del componente
    public function __construct($image, $name, $id = false, $description = '', $behavior = 'none', $behaviorVar = '', $note = '&nbsp;', $truncate = false) {
		$this->image = $image;
		$this->name = $name;
		$this->id = $id;
		$this->description = ($truncate) ? Str::limit($description,400,'...') : $description;
		$this->behavior = $behavior;
		$this->behaviorVar = $behaviorVar;
		$this->note = $note;
    }
    public function render() {
        return view('components.element-with-overlay');
    }
}

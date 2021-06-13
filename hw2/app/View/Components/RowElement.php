<?php
namespace App\View\Components;
use Illuminate\View\Component;

class RowElement extends Component {
	public $subscriptionId, $subscriptionName, $info, $infoData, $courseTypes, $coursesInfo, $addable;
	//Costruttore del componente
    public function __construct($subscriptionId, $subscriptionName, $info, $infoData, $courseTypes = [], $coursesInfo = [], $addable = false) {
		$this->subscriptionId = $subscriptionId;
		$this->subscriptionName = $subscriptionName;
		$this->info = $info;
		$this->infoData = $infoData;
		$this->courseTypes = $courseTypes;
		$this->coursesInfo = $coursesInfo;
		$this->addable = $addable;
    }
    public function render() {
        return view('components.row-element');
    }
}

<?php
class trainer extends defaultModel {
	protected $table = 'trainer';
	protected $primaryKey = 'trainer_id';
	protected $fillable = ['location_id', 'name', 'surname', 'description', 'image'];
	//Sede dove lavora il trainer
	public function Location() {
		return $this->belongsTo('location', 'location_id');
	}
}
?>

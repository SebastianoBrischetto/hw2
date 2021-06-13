<?php
class location_times extends defaultModel {
	protected $table = 'location_times';
	protected $primaryKey = 'id';
	protected $fillable = ['location_id', 'days', 'times'];
	//Sede a cui appartiene l'orario
	public function Location() {
		return $this->belongsTo('location', 'location_id');
	}
}
?>

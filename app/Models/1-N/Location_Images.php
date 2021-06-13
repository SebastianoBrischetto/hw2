<?php
class location_images extends defaultModel {
	protected $table = 'location_images';
	protected $primaryKey = 'id';
	protected $fillable = ['location_id', 'image'];
	//Sede a cui appartiene l'immagine
	public function Location() {
		return $this->belongsTo('location', 'location_id');
	}
}
?>

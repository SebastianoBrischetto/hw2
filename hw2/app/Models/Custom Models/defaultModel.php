<?php
use Illuminate\Database\Eloquent\Model;
//Modello con funzione che recupera la chiave primaria
class defaultModel extends Model {
	public static function primaryKey() {
		return (new static())->getKeyName();
	}
}
?>

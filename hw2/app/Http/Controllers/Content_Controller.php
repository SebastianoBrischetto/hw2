<?php
use Illuminate\Routing\Controller;

class Content_Controller extends Controller {
	//Carica la pagina per gestire i contenuti se admin
	public function loadContent() {
		return (session('is_admin')) ? view('Content')->with('page_name', 'Gestione contenuti') : redirect('Access');
	}
	//Recupera i dati necessari per creare un form (mysql per l'INFORMATION_SCHEMA)
	public function contentForm_mysql($table) {
		$db_name = DB::connection()->getDatabaseName();
		$columns = DB::table('INFORMATION_SCHEMA.COLUMNS')->where('table_schema', $db_name)->where('table_name', $table)->get(['column_name', 'column_comment']);
		foreach($columns as $column) {
			$type = $column->column_comment;
			$key = $column->column_name;
			$value = null;
			
			if(str_contains($type, 'INDEX_OF ')) {
				$reference_table = str_replace('INDEX_OF ', '', $type);
				$reference_values = $reference_table::all();
				foreach($reference_values as $values) {
					$value[] = $values->$key;
				}
				$type = 'SELECT';
			} else {
				switch($type) {
					case 'AUTO_INCREMENT':
						$last_id = $table::latest()->first($key);
						$value = ($last_id) ? $last_id->$key + 1 : 1;
						break;

					case '':
						$type = 'default';
						break;
				}
			}
			$form_inputs[] = array(
				'type' => $type,
				'key' => $key,
				'value' => $value
			);
		}
		
		return $form_inputs;
	}
	//Aggiunge,modifica o rimuove (in base alla richiesta inviata) una riga della tabella
	public function manageContent() {
		if (!session('is_admin')) {
			return ['success' => false, 'message' => 'Non si dispone dei permessi necessari'];
		}
		$inputs = request();
		$table = $inputs['table'];
		$success = false;
		$message = 'Operazione non riuscita';
		
		switch($inputs['request']) {
			case 'add':
				if($this->checkInputs($inputs)) {
					$data = array_combine($inputs['key'], $inputs['value']);
					foreach($data as $key => $value) {
						if($inputs->file($key)){
							$data[$key] = url('images/'.$inputs->file($key)->store('uploads'));
						}
					}
					$success = $table::create($data);
				}
				break;

			case 'update':
				if($this->checkInputs($inputs) && $this->checkPKey($inputs)) {
					$data = array_combine($inputs['key'], $inputs['value']);
					foreach($data as $key => $value) {
						if($inputs->file($key)) {
							$data[$key] = url('images/'.$inputs->file($key)->store('uploads'));
						}
					}
					$success = $table::where($inputs['p_key'], $inputs['pk_value'])->update($data);
				}
				break;

			case 'remove':
				$success = ($this->checkPkey($inputs)) ? $table::where($inputs['p_key'], $inputs['pk_value'])->delete() : false;
				break;

			default:
				$message = 'Richiesta non valida';
		}
		
		if($success) {
			$message = 'Operazione avvenuta con successo';
		}
		return ['success' => $success, 'message' => $message];
	}
	//controllo degli input
	public function checkInputs($inputs) {
		return (isset($inputs['key']) && isset($inputs['value']) && count($inputs['key']) == count($inputs['value'])) ? true : false;
	}
	//controllo della Primary Key
	public function checkPKey($inputs){
		return (isset($inputs['p_key']) && isset($inputs['pk_value'])) ? true : false;
	}
	//recupero della Primary Key
	public function tableKey($table) {
		$primaryKey = $table::primaryKey();
		return ['key' => $primaryKey, 'value' => $table::get($primaryKey)];
	}
	//recupero dei dati
	public function tableData($table, $key, $value) {
		return $table::where($key, $value)->first();
	}
}
?>

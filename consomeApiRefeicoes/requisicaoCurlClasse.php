<?php
class RequisicaoRefeicoes {
	
	private $url = "Localhost/php/Trabalho3/refeicoesApi";
	/**
	 * Retorna uma lista de objetos se teve sucesso, 0 caso contrário. Só é possível 'pegar' alimentos cadastrados pelo professor ou por você
	 */
	public function getAllRefeicoes(){
		
		#$this->url = "http://localhost/RESTapi/ramos-api/alimentos?pront={$this->prontuario}&key={$this->apiKey}";
		$ch = curl_init($this->url);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                                                    
		$result = curl_exec($ch);
		return $result;
	}
	/**
	 * Retorna um objeto se teve sucesso, 0 caso contrário. Só é possível 'pegar' alimentos cadastrados pelo professor ou por você
	 */
	public function getRefeicaoById($id){
		$idUrl = $this->url.'?idRef='.$id;

		$ch = curl_init($idUrl);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                                                    
		$result = curl_exec($ch);
		return $result;
	}
	/**
	 * Retorna o id criado se teve sucesso, 0 caso contrário.
	 */
	public function createRefeicao(){
		$data = array(
			"nome" => "{$_POST['nome']}"
		);
		$payLoad = json_encode($data);
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($ch, CURLOPT_URL,$this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_HEADER, false); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payLoad); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($payLoad))
		);   
	
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
  
	}
  
	/**
	 * Retorna 1 se teve sucesso, 0 caso contrário. Só é possível editar alimentos que você mesmo cadastrou
	 */

	public function editRefeicao(){
		$data = array(
			"idRef" => "{$_POST['idRefeicao']}",
			"idAli" => "{$_POST['idAlimento']}"
		);
		if (isset($_POST['qdtGrama'])) {
			$data['gramas'] = "{$_POST['qdtGrama']}";
		}
		$payLoad = json_encode($data);
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
		curl_setopt($ch, CURLOPT_URL,$this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_HEADER, false); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payLoad); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($payLoad))
		);   
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
  
	}
  
	/**
	 * Retorna 1 se teve sucesso, 0 caso contrário. Só é possível excluir alimentos que você mesmo cadastrou
	 */
	public function deleteRefeicao(){
		
		$data = array(
			"idRef" => "{$_POST['idRefeicao']}"
		);
		$payLoad = json_encode($data);

		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
		curl_setopt($ch, CURLOPT_URL,$this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_HEADER, false); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payLoad); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($payLoad))
		);   
	
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
		
	}
  
  }
?>
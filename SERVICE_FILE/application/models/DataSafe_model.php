<?php 

class DataSafe_model extends CI_Model{



	public function delete_safe( $datatable,  $where_data = []){

		//Mengubah update suatu data row pada suatu tabel dengan nilai statusnya menjadi DISABLE

		$response = [];
		/* 
		- Where data bentuknya adalah array associatif berisi kondisi data row yang dihapus dengan key dan valuenya
		- data_table adalah nama tabel tempat row dihapus 
		contoh :
		$datatable = "data_produk";
		$param_data = [ 'id_produk' => "1" ]

		- artinya mengubah status menjadi DISABLE untuk data row dengan id_produk = 1 pada table data_produk  
		*/

		$nama_key_id = false;  
		$value_id = false;
		//Hanya akan mengulang sekali
		foreach ($where_data as $key_id => $id ) {
			$nama_key_id  = $key_id;
			$value_id  = $id;
		}

		$data_update = [
			//SET status = DISABLE
			'status' => "DISABLE" 
		];

		$this->db->where( $nama_key_id, $value_id );
		$update_data = $this->db->update( $datatable,  $data_update );

		// var_dump($update_data);
		// die;
		if ( $update_data == true ) {
			$response['status '] = true;
			$response['msg'] = "Delete safe Berhasil!! status data row sudah menjadi DISABLE";
		}else{
			$response['status '] = false;
			$response['msg'] = "Delete safe Gagal!!";
		}


		return $response;
	}



	public function restore_safe( $datatable,  $where_data = []){

		//Mengubah update suatu data row pada suatu tabel dengan nilai statusnya menjadi ACTIVE

		$response = [];
		/* 
		- Where data bentuknya adalah array associatif berisi kondisi data row yang dihapus dengan key dan valuenya
		- data_table adalah nama tabel tempat row dihapus 
		contoh :
		$datatable = "data_produk";
		$param_data = [ 'id_produk' => "1" ]

		- artinya mengubah status menjadi ACTIVE untuk data row dengan id_produk = 1 pada table data_produk  
		*/

		$nama_key_id = false;  
		$value_id = false;
		//Hanya akan mengulang sekali
		foreach ($where_data as $key_id => $id ) {
			$nama_key_id  = $key_id;
			$value_id  = $id;
		}

		$data_update = [
			//SET status = ACTIVE
			'status' => "ACTIVE" 
		];

		$this->db->where( $nama_key_id, $value_id );
		$update_data = $this->db->update( $datatable,  $data_update );

		// var_dump($update_data);
		// die;
		if ( $update_data == true ) {
			$response['status '] = true;
			$response['msg'] = "Restore safe Berhasil!! status data row sudah menjadi ACTIVE";
		}else{
			$response['status '] = false;
			$response['msg'] = "Restore safe Gagal!!";
		}


		return $response;
	}

}
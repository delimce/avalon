<?php

	function _crearProspecto() {
				
		$url = "http://localhost/suite/service/v4/rest.php";
		$username = "admin";
		$password = "123456";
		
		//$saludo 	= @trim(stripslashes($_POST['tratamiento'])); 
		$nombre 	= @trim(stripslashes($_POST['nombre'])); 
		$apellido 	= @trim(stripslashes($_POST['apellido']));
		//$empresa 	= @trim(stripslashes($_POST['empresa']));
		$email	 	= @trim(stripslashes($_POST['email']));
		//$telefono 	= @trim(stripslashes($_POST['telefono']));
		//$pais	 	= @trim(stripslashes($_POST['pais']));
	
		//function to make cURL request
		function call($method, $parameters, $url) {
			ob_start();
			$curl_request = curl_init();

			curl_setopt($curl_request, CURLOPT_URL, $url);
			curl_setopt($curl_request, CURLOPT_POST, 1);
			curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
			curl_setopt($curl_request, CURLOPT_HEADER, 1);
			curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

			$jsonEncodedData = json_encode($parameters);

			$post = array(
				 "method" => $method,
				 "input_type" => "JSON",
				 "response_type" => "JSON",
				 "rest_data" => $jsonEncodedData
			);

			curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
			$result = curl_exec($curl_request);
			curl_close($curl_request);

			$result = explode("\r\n\r\n", $result, 2);
			$response = json_decode($result[1]);
			ob_end_flush();

			return $response;
		}

		//login ------------------------------------------------

		$login_parameters = array(
			 "user_auth"=>array(
				  "user_name"=>$username,
				  "password"=>md5($password),
				  "version"=>"1"
			 ),
			 "application_name"=>"RestTest",
			 "name_value_list"=>array(),
		);

		$login_result = call("login", $login_parameters, $url);

		//get session id
		$session_id = $login_result->id;	
		
		$set_entry_parameters = array(
			//session id
			"session" => $session_id,

			//The name of the module from which to retrieve records.
			"module_name" => "Prospects",

			//Record attributes
			"name_value_list" => array(
				//to update a record, you will nee to pass in a record id as commented below
				//array("name" => "id", "value" => "9b170af9-3080-e22b-fbc1-4fea74def88f"),
				//array("name" => "salutation", "value" => $saludo),
				array("name" => "first_name", "value" => $nombre),
				array("name" => "last_name", "value" => $apellido),
				array("name" => "assigned_user_id", "value" => 1),
				//array("name" => "phone_mobile", "value" => $telefono),
				//array("name" => "primary_address_country", "value" => $pais),
				//array("name" => "account_name", "value" => $empresa),
			),
		 
			//A list of link names and the fields to be returned for each link name
			'link_name_to_fields_array' => array(
			),
		);

		$set_entry_result = call("set_entry", $set_entry_parameters, $url);
		
		//Id del Prospecto recien ingresado
		$prospect_id = $set_entry_result->id;
	
		//----------------------------------	
		//Guardar Email
		$set_registro_email = array(
			//session id
			"session" => $session_id,

			//The name of the module from which to retrieve records.
			"module_name" => "EmailAddresses",

			//Record attributes
			"name_value_list" => array(
				//to update a record, you will nee to pass in a record id as commented below
				//array("name" => "id", "value" => "9b170af9-3080-e22b-fbc1-4fea74def88f"),
				array("name" => "email_address", "value" => strtolower($email)),
				array("name" => "email_address_caps", "value" => strtoupper($email)),
				array("name" => "invalid_email", "value" => 0),
				array("name" => "opt_out", "value" => 0),
				array("name" => "deleted", "value" => 0),
			),
			 
			//A list of link names and the fields to be returned for each link name
			'link_name_to_fields_array' => array(),
		);
	
		$set_email = call("set_entry", $set_registro_email, $url);

		//Id del registro de email
		$email_id = $set_email->id;
	
		//-------------------------------	
		//Crear relación
		$set_relationship_parameters = array(
			//session id
			'session' => $session_id,
			//The name of the module.
			'module_name' => 'Prospects',
			//The ID of the specified module bean.
			'module_id' => $prospect_id,
			//The relationship name of the linked field from which to relate records.
			'link_field_name' => 'email_addresses',
			//The list of record ids to relate
			'related_ids' => array(
				$email_id,
			),
			//Sets the value for relationship based fields
			'name_value_list' => array(
			),
			//Whether or not to delete the relationship. 0:create, 1:delete
			'delete'=> 0,
		);
	
		$guardar_relacion = call("set_relationship", $set_relationship_parameters, $url);
		
		if ($guardar_relacion->failed == 1) {
			echo 'NO SE PUDO CREAR REGISTRO';
		} else {
			echo 'ok';
		}
	}
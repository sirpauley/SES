<?php

/******************************************************************************************************************************
*	Additional info for system
*
*	Database name = ses
*	user: sirpauley
*	password: {BLANK}
*
*
*	created by: sirPauley
*	Contact sirpauley@gmail.com
*******************************************************************************************************************************/

//Class gaan remove word na Procedural verandering
class DBCLASS{

	public $servername;
	public $username;
	public $password;
	public $table;
	public $conn;

//settings for connecting to the database
	public function __construct($host="localhost",$user="root",$pass="",$db="ses"){
		$this->conn = new mysqli($host, $user, $pass, $db);
		if ($this->conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	}//function __construct

	 /***************************DBCLASS***************************************/
	/****************************SELECT***************************************/
	public function SELECT($table=NULL, $field=NULL, $fieldValue=NULL){

		//query
		$sql = "SELECT * FROM $table";

		if(!empty($field)){
			$sql .= " WHERE $field = '$fieldValue'";
		}

		$result = $this->conn->query($sql);


		$DBArray = array();

		//sql data output
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		         $DBArray[] = $row;
		    }
		} else {
			$DBArray["SQLsuccess"] = "FALSE";
			$DBArray['SQLstatement'] = "NO STATEMENT";
		}

		return $DBArray;


	}//Function


	 /***************************DBCLASS***************************************/
	/****************************INSERT***************************************/
	public function INSERT($table=NULL, $arrData=NULL){

		$DBArray = array();
		$fieldsArray = array();

		if(!empty($arrData)){
			if( isset($arrData[0]) ){//multi items insert


				//fields generate
				foreach ($arrData as $DataKey => $DataValue) {
					foreach ($DataValue as $key => $value) {
						$fieldsArray[] = $key ;
					}
				}

				$fieldsArray = array_unique($fieldsArray);
				asort($fieldsArray);


				//create query
				//$sql = "INSERT INTO $table (velde) VALUES (values),(values);";
				$sqlValues = '';


				foreach ($arrData as $DataKey => $DataValue) {
					$sqlValues .= "(";
					$sqlFields = '';
					$sqlFields .=  "(";
					foreach ($fieldsArray as $field) {

						if(!empty($DataValue[$field])){
							$sqlFields .= " $field" . ", ";
							$sqlValues .= "'" . $DataValue[$field] . "', ";
						}

					}
					$sqlFields = substr($sqlFields, 0, -2);
					$sqlFields .=  ")";

					$sqlValues = substr($sqlValues, 0, -2);
					$sqlValues .= "),";
				}
				$sqlValues = substr($sqlValues, 0, -1);
				$sqlValues .= ";";


			}else{//single item insert
				//fields generate
				foreach ($arrData as $key => $value) {
					$fieldsArray[] = $key ;
				}

				$fieldsArray = array_unique($fieldsArray);
				asort($fieldsArray);

				//create query
				$sqlValues = '';

				$sqlValues .= "(";
				$sqlFields = '';
				$sqlFields .=  "(";
				foreach ($fieldsArray as $field) {

					if(!empty($arrData[$field])){
						$sqlFields .= " $field" . ", ";
						$sqlValues .= "'" . $arrData[$field] . "', ";
					}

				}
				$sqlFields = substr($sqlFields, 0, -2);
				$sqlFields .=  ")";

				$sqlValues = substr($sqlValues, 0, -2);
				$sqlValues .= "),";

				$sqlValues = substr($sqlValues, 0, -1);
				$sqlValues .= ";";
			}
			//query

			$sql = "INSERT INTO $table $sqlFields VALUES $sqlValues";
			try{

				$sqlText = $this->conn->query($sql);
				if (($sqlText) === TRUE) {
					$DBArray['SQLsuccess'] = "TRUE";
					$DBArray['SQLstatement'] = $sql;
				}else{
					$DBArray['SQLsuccess'] = "FALSE";
					$DBArray['SQLstatement'] = $sql;
					$DBArray['SQLerror'] 	= $this->conn->error;
				}
			}catch (Exception $e) {
				$DBArray[] = 0;
			}


		}else{
			$DBArray["SQLsuccess"] = "FALSE";
			$DBArray['SQLstatement'] = "NO STATEMENT";

		}

		return $DBArray;

	}//Function

	 /***************************DBCLASS***************************************/
	/****************************UPDATE***************************************/
	public function UPDATE($table=NULL, $idField=NULL, $idValue=NULL, $valueArray=NULL){


		$sql = "UPDATE $table SET ";
		$queryUpdateData = "";
		//UPDATE MyGuests SET lastname='Doe', name='john' WHERE id=2
		foreach ($valueArray as $key => $value) {
			$queryUpdateData .= "$key = '$value', ";
		}

		$queryUpdateData = substr($queryUpdateData, 0, -2);
		$sql .= $queryUpdateData . " WHERE $idField = $idValue";

		try{

			$sqlText = $this->conn->query($sql);
			if (($sqlText) === TRUE) {
				$DBArray['SQLsuccess'] 		= "TRUE";
				$DBArray['SQLstatement'] 	= $sql;
			}else{
				$DBArray['SQLsuccess'] 		= "FALSE";
				$DBArray['SQLstatement'] 	= $sql;
				$DBArray['SQLerror'] 	= $this->conn->error;
			}
		}catch (Exception $e) {
			$DBArray['SQLsuccess'] 		= "FALSE";
			$DBArray['SQLstatement'] 	= $sql;
		}

		return $DBArray;

	}//Function


	 /***************************DBCLASS***************************************/
	/****************************DELETE***************************************/
	public function DELETE($table=NULL, $idField=NULL, $idValue=NULL){


		$sql = "DELETE FROM $table WHERE $idField=$idValue";


		try{

			$sqlText = $this->conn->query($sql);
			if (($sqlText) === TRUE) {
				$DBArray['SQLsuccess'] = "TRUE";
				$DBArray['SQLstatement'] = $sql;
			}else{
				$DBArray['SQLsuccess'] 		= "FALSE";
				$DBArray['SQLstatement'] 	= $sql;
				$DBArray['SQLerror'] 	= $this->conn->error;
			}
		}catch (Exception $e) {
			$DBArray['SQLsuccess'] = "FALSE";
			$DBArray['SQLstatement'] = $sql;
			$DBArray['SQLerror'] = $this->conn->error;
		}

		return $DBArray;

	}//Function

	/***************************DBCLASS***************************************/
 /****************************CUSTOM***************************************/
 public function CUSTOM($query=NULL){

	 $sql = $query;

	 try{

		 $sqlText = $this->conn->query($sql);
		 //print_r($sqlText);
		 if (($sqlText) === TRUE) {
			 $DBArray['SQLsuccess'] = "TRUE";
			 $DBArray['SQLstatement'] = $sql;
		 }else{
			 $DBArray['SQLsuccess'] = "FALSE";
			 $DBArray['SQLstatement'] = $sql;
			 $DBArray['SQLerror'] 	= $this->conn->error;
		 }
	 }catch (Exception $e) {
		 $DBArray['SQLsuccess'] = "FALSE";
		 $DBArray['SQLstatement'] = $sql;
		 $DBArray['SQLerror'] 	= $this->conn->error;
	 }

	 return $sqlText;
	 //return $DBArray;

 }//Function

	 /***************************DBCLASS***************************************/
	/****************************CUSTOM MULTI***************************************/
	public function CUSTOMMULTI($query=NULL){

		$sql = $query;

		if($query != NULL){
				if($this->conn->multi_query($sql)){
					$DBArray['SQLsuccess'] = "TRUE";
	 			 	$DBArray['SQLstatement'] = $sql;
				}else{
					$DBArray['SQLsuccess'] = "FALSE";
					$DBArray['SQLstatement'] = $sql;
					$DBArray['SQLerror'] 	= $this->conn->error;
				}//if Query
		}
return $DBArray;

	}//Function

	/***************************DBCLASS***************************************/
 /****************************close connetion with Database***************************************/
 function rollback(){
	 $this->conn->rollback();
 }

	/***************************DBCLASS***************************************/
 /****************************close connetion with Database***************************************/
 function close_connection() {
	 $this->conn->close();
 }

}//end class
//Class gaan remove word na Procedural verandering


date_default_timezone_set('Africa/Johannesburg');

?>

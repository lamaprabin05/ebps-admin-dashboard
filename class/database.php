<?php

	abstract class Database{

		private $conn;
		private  $table = null;
		private $sql = null;
		private $fields = null;
		private $where = null;
		private $join = null;
		private $groupby = null;
		private $limit = null;

		private $stmt = null;
		private $result = null;
		private $orderby = null;

		protected function Database(){
			try{
			$this->conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';',DB_USER,DB_PASSWORD);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		catch(PDOException $e){
				error_log(date('Y-m-d h:i:s').'Database:'.$e->getMessage()."\r\n", 3 , 
				'log/error.log');  //for line break.
				//echo $e->getMessage(); two ways either show or log folder ma rakhne.
				return false;
			}
		}
	
		protected function table($table){
			$this->table = $table;
		}

		protected function fields($_fields = '*'){
			if($_fields == '*'){
				$this->fields = ' * ';				
			} else if(is_string($_fields)){
				$this->fields = $_fields;
			
			} else if(is_array($_fields)) {
				$this->fields = implode(',', $_fields);
			}
		}

		protected function where($_where = null){
			if($_where != null){
				$this->where = $_where;
			}
		}

		protected function groupBy($groupby = null){
			if($groupby != null){
			$this->groupby = $groupby;
			}
		}

		protected function orderBy($orderby = null){
			if($orderby != null){
			$this->orderby = $orderby;
			}
		}

		protected function join($join = null){
			if($join != null){
			$this->join = $join;
			}
		}


		protected function limit($start, $count){
			$this->limit = " ".$start.", ".$count;
		}

		public function select ($is_die = false){
			try {
				/*
					SELECT fields from TABLE 
					JOIN statement
					WHERE clause
					GROUP BY clause
					ORDER BY clause
					LIMIT start, count.
				*/
					$this->sql = "SELECT";

					if(!isset($this->fields)){
						$this->fields();
					}

					$this->sql .= $this->fields;
					$this->sql .= " FROM ";

					if(!isset($this->table)){
						throw new Exception("Table not selected");
					}

					$this->sql .= " ".$this->table;

					/*1. join statement*/
					if(isset($this->join)){
						$this->sql .= " ".$this->join;
					}

					/*2. where clause*/
					if(isset($this->where)){
						$this->sql .= " WHERE ". $this->where;
					}
					/*3. group by*/
					if(isset($this->groupby)){
						$this->sql .= " GROUP BY ".$this->groupby;
					}

					/*4. order By */
					if(isset($this->orderby)){
						$this->sql .= " ORDER BY ".$this->orderby;
					}

					/*5. Limit By*/
					if(isset($this->limit)){
						$this->sql .= " LIMIT ".$this->limit;
					}

					if($is_die){
						echo $this->sql;
						exit;
					}

					//prepare statement in PDO
					$this->stmt = $this->conn->prepare($this->sql);
					//run garnu vanda agadi stmt ready garnu parxa.
					$this->stmt->execute();

					$data = array();
					while ($row = $this->stmt->fetchObject()) {
						$data[] = $row;
					}

					return $data;

			} catch(PDOException $e){
				error_log(date('Y-m-d h:i:s').'Database:'.$e->getMessage()."\r\n", 3 , 
				'../../log/error.log');  //for line break.
				//echo $e->getMessage(); two ways either show or log folder ma rakhne.
				return false;	

			} catch (Exception $e) {
				error_log(date('Y-m-d h:i:s').'Database:'.$e->getMessage()."\r\n", 3 , 
				'../../log/error.log');  //for line break.
				//echo $e->getMessage(); two ways either show or log folder ma rakhne.
				return false;
			}
				
			
		}

		public function update($data,$is_die = false){
			try{
				/*UPDATE Table SET column_name = value WHERE condition*/
				/*data binding in PDO.
					UPDATE users SET last_login = :last_login, login_ip = :login_ip WHERE id = 1.
				*/
				$this->sql = "UPDATE ";
				if(!isset($this->table)){
					throw new Exception("table not set");		
				}
				$this->sql .= " ".$this->table;
				$this->sql .= " SET ";

				if(is_string($data)){
					$this->sql .= " ".$data;
				
				}else if(is_array($data)){
						$columns = array_keys($data);
						$temp = array();

						foreach ($columns as $key => $value) {
							$temp[] = $value." = :".$value;
						}
						$this->sql .= implode(", ", $temp);
				
				}else{ 
					throw new Exception("Invalid Data Type");
					
				}

				if(isset($this->where)){
					$this->sql .= " WHERE ".$this->where;
				}	


				$this->stmt = $this->conn->prepare($this->sql);
				if($is_die){
					debugger($data);
					debugger($this->stmt,true);
				}

				// Pdo ma value binding garne way.
				/*
					$this->stmt->bindValue(':last_login',$value,PDO::PARAM_STRING);
				*/
				if(is_array($data)){
					foreach ($data as $columns => $value) {
						
						if(is_int($value)){
							$param = PDO::PARAM_INT;
						}
						 else if(is_bool($value)){
							$param = PDO::PARAM_BOOL;
						} else if (is_null($value)){
							$param = PDO::PARAM_NULL;
						} else if(is_string($value)){
							$param = PDO::PARAM_STR;
						} else{
							$param = false;
						}

						if($param){
							$this->stmt->bindValue(":".$columns,$value,$param);
						}	
					}
				}
				
				$this->result = $this->stmt->execute();
				if($this->result){
					return true;
				}
				else{
					return false;
				}

			}catch(PDOException $e){
				error_log(date('Y-m-d h:i:s').'Database:'.$e->getMessage()."\r\n", 3 , 
				'../../log/error.log');  //for line break.
				//echo $e->getMessage(); two ways either show or log folder ma rakhne.
				return false;	

			} catch (Exception $e) {
				error_log(date('Y-m-d h:i:s').'Database:'.$e->getMessage()."\r\n", 3 , 
				'../../log/error.log');  //for line break.
				//echo $e->getMessage(); two ways either show or log folder ma rakhne.
				return false;
			}
		}
	
		public function insert($data,$is_die = false){
			try{
				/*INSERT INTO Tablename SET column_name = value */
				/*data binding in PDO.
					INSERT INTO  users SET last_login = :last_login, login_ip = :login_ip 
				*/
				$this->sql = "INSERT INTO ";
				if(!isset($this->table)){
					throw new Exception("table not set");		
				}
				$this->sql .= " ".$this->table;
				$this->sql .= " SET ";

				if(is_string($data)){
					$this->sql .= " ".$data;
				
				}else if(is_array($data)){
						$columns = array_keys($data);
						$temp = array();

						foreach ($columns as $key => $value) {
							$temp[] = $value." = :".$value;
						}
						$this->sql .= implode(", ", $temp);
				
				}else{ 
					throw new Exception("Invalid Data Type");
					
				}

				$this->stmt = $this->conn->prepare($this->sql);
				if($is_die){
					debugger($data);
					debugger($this->stmt,true);
				}

				// Pdo ma value binding garne way.
				/*
					$this->stmt->bindValue(':last_login',$value,PDO::PARAM_STRING);
				*/
				if(is_array($data)){
					foreach ($data as $columns => $value) {
						
						if(is_int($value)){
							$param = PDO::PARAM_INT;
						}
						 else if(is_bool($value)){
							$param = PDO::PARAM_BOOL;
						} else if (is_null($value)){
							$param = PDO::PARAM_NULL;
						} else if(is_string($value)){
							$param = PDO::PARAM_STR;
						} else{
							$param = false;
						}

						if($param){
							$this->stmt->bindValue(":".$columns,$value,$param);
						
						}	
					}
				}
				
				$this->result = $this->stmt->execute();
				if($this->result){
					return $this->conn->LastInsertId();
				}
				else{
					return false;
				}

			}catch(PDOException $e){
				error_log(date('Y-m-d h:i:s').'Database:'.$e->getMessage()."\r\n", 3 , 
				'../../log/error.log');  //for line break.
				//echo $e->getMessage(); two ways either show or log folder ma rakhne.
				return false;	

			} catch (Exception $e) {
				error_log(date('Y-m-d h:i:s').'Database:'.$e->getMessage()."\r\n", 3 , 
				'../../log/error.log');  //for line break.
				//echo $e->getMessage(); two ways either show or log folder ma rakhne.
				return false;
			}
		}

		protected function delete($is_die = false){
			try {
				$this->sql = "DELETE FROM ";
				if(!isset($this->table)){
					throw new Exception("Table not set.");	
				}
				$this->sql .=" ".$this->table;

				if(isset($this->where)){
					$this->sql .=" WHERE ".$this->where;
				}

				$this->stmt = $this->conn->prepare($this->sql);
				if($is_die){
					debugger($this->stmt,true);
				}

				$del = $this->stmt->execute();
				return $del;

			} catch(PDOException $e){
				error_log(date('Y-m-d h:i:s').'Database:'.$e->getMessage()."\r\n", 3 , 
				'../../log/error.log');  //for line break.
				//echo $e->getMessage(); two ways either show or log folder ma rakhne.
				return false;	

			} catch (Exception $e) {
				error_log(date('Y-m-d h:i:s').'Database:'.$e->getMessage()."\r\n", 3 , 
				'../../log/error.log');  //for line break.
				//echo $e->getMessage(); two ways either show or log folder ma rakhne.
				return false;
			}
		}
	}

?>
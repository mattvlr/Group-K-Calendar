<?php
	require_once('_db.php');
class mysql_driver extends db_info
{

	public $query_id = null;
	public $fetch = '';
	protected $connection_id = null;

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Connect - Connect to the DB designated in _db.php 
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function connect()
	{
		$this->connection_id = mysqli_connect(parent::DB_SERVER,parent::DB_USERNAME,parent::DB_PASSWORD,parent::DB_DATABASE);
		if (mysqli_connect_errno()) {  //Check connection
			$this->error("Failed to connect to MYSQL: " . mysqli_connect_error());
			return false;
		}
		else
		{
			return true;
		}
	}
	

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//arrayPairToQuery( associative array ) - Format Associative array into Query String
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function arrayPairToQuery($set) //format key value array to query-able format
	{
		$field_names = "";
		$field_values = "";

		foreach( $set as $k => $v)  //split into two data sets each separated by ,
		{
			$field_names .= $k . ',';

			if ( is_numeric( $v ) and strcmp( intval($v), $v ) === 0 )
			{
				$field_values .= $v.",";
			}
			else  // if its a string use 'value' instead of value
			{
				$field_values .= "'" . $v . "'" . ',';
			}
		}

		$field_names  = rtrim( $field_names, ","  ); //take space out
		$field_values = rtrim( $field_values, "," );
		return array ('FIELD_NAMES' => $field_names, //return array
			'FIELD_VALUES' => $field_values,
			);
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//arrayToQuery( array of fields ) - Format array of fields to comma separated query string format
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function arrayToQuery($set)
	{
		$field_names = "";

		foreach( $set as $k ) 
		{
			$field_names .= $k . ',';
		}


		$field_names  = rtrim( $field_names, ","  ); //take space out
		return $field_names;
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//exists( mysql table , query constraint {ex. "id='1'" where id is a unique column} ) - Checks whether a unique value exists in a column
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function exists($table,$where) 
	{
		$exists = false;
		$query = "SELECT * FROM " . $table . " WHERE " . $where;
		$query_id = $this->query( $query);
		while($row = mysqli_fetch_array($query_id))
		{
		}
		if(mysqli_num_rows($query_id) > 0)
		{
			$exists = true;
		}
		return $exists;
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//select( mysql table , fields to get, query constraint {ex. "id='1'" } ) - Selects designated fields from a specific column
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function select( $table, $get, $where='') //SELECTs the fields designated in the array $get WHERE conditions..
	{
		$data = array();
		if(is_array($get))
		{
			$getq = $this->arrayToQuery($get);
		}
		else
		{
			$getq = $get;
		}
		$query = "SELECT " . $getq . " FROM " . $table;

		if( $where != '')
		{
			$query .= " WHERE " . $where;
		}
		$query_id = $this->query($query,$get);

		if(is_array($get))
		{
			while($row = mysqli_fetch_array($query_id))
			{
				$i = 0;
				while( $i < count($get))
				{
					$data[$get[$i]] = $row[$get[$i]];
					$i++;
				}
			}
		}
		else  // handle single data returns
		{
			while($row = mysqli_fetch_array($query_id))
			{
				$data = $row[$get];
			}
		}
		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query);
			return false;
		}	


		return $data;


	}
	
		public function selectMany( $table, $get, $where='') //SELECTs the fields designated in the array $get WHERE conditions..
	{
		$data = array();
		if(is_array($get))
		{
			$getq = $this->arrayToQuery($get);
		}
		else
		{
			$getq = $get;
		}
		$query = "SELECT " . $getq . " FROM " . $table;

		if( $where != '')
		{
			$query .= " WHERE " . $where;
		}
		$query_id = $this->query($query,$get);

		if(is_array($get))
		{
			$i = 0;
			while($row = mysqli_fetch_array($query_id))
			{
				$j = 0;
				while( $j < count($get))
				{
					$data[$i][$get[$j]] = $row[$get[$j]];
					$j++;
				}
			$i++;
			}
		}
		else  // handle single data returns
		{
			$i = 0;
			while($row = mysqli_fetch_array($query_id))
			{
				$data[$i] = $row[$get];
				$i++;
			}
		}
		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query);
			return false;
		}	


		return $data;


	}
	/*
	public function compare( $table, $get='', $value, $where='' ) // used like compare('user', 'passhash', $test_passhash, 'id') 
	{	//test a value against the db
		$same = false;
		$query = "SELECT " . $get . " FROM " . $table;

		if( $where != '')
		{
			$query .= " WHERE " . $where . ';';
		}
		$query_id = $this->query($query);
		while($row = mysqli_fetch_array($query_id))
		{
			$found = $row["$get"];
		}

		if(mysqli_num_rows($query_id) > 0)
		{
			if( $value == $found)
			{
				$same = true;
			}
		}
		else
		{
			$same = false;
		}

		return $same;
	}*/

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//delete( MySQL table , optional condition set ) - Truncate a table or delete specific values from a table
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function delete( $table, $where='')
	{
		if(! $where )
		{
			$query = "TRUNCATE TABLE " . $table;
		}
		else
		{
			$query = "DELETE FROM " . $table . " WHERE " . $where;
		}
		$result = $this->query($query);
		return $result;
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//update( MySQL table , new data , optional condition set ) - Insert set of organized data into column 
	//Ex. update('user'  , 'MySql_field_name1="newval1" , MySql_field_name2="newval2"'  ,  'MySql_field_condition="condition"') 
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function update( $table, $set, $where='')
	{
		$query = "UPDATE " . $table . " SET " . $set;
		if( $where )
		{
			$query .= " WHERE " . $where;
		}
		if($this->query($query))
		{
			return true;
		}
		return false;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//insert( MySQL table , associative array( field_names => values )) - Insert set of organized data into column 
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function insert( $table, $set)
	{
		$q = $this->arrayPairToQuery( $set);
		$query = "INSERT INTO " . $table .  " ({$q['FIELD_NAMES']}) VALUES({$q['FIELD_VALUES']})";
		$query_id = $this->query($query);
		if(mysqli_affected_rows($this->connection_id) > 0)
		{
			return true;
		}
		return false;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//error(  query string error ) - alert the developer of mysql query errors w/ a easy to see popup box.
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function error( $err)
	{
		echo $err . '<br>';
		echo '<script language="javascript">';
		echo 'alert("'.$err.'")';
		echo '</script>';
		

		printf("Error: %s\n", mysqli_error($this->connection_id));
		exit();
    }
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//query(  query string ) - Query the database with input query string
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function query( $query_string)
	{
		$this->query_id = mysqli_query($this->connection_id, $query_string);

		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query_string);
		}
		return $this->query_id;
	}
	/*
	public function fetch($query)
	{
		$this->query_id = mysqli_fetch_field($this->connection_id, $query);
		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query);
		}
		return $this->query_id;
	}

	public function fetchArray($query_id)
	{
		mysqli_fetch_array($query_id);
		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query);
		}
		return $this->query_id;
	}

	*/
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//getSessionInfo(  unique id ) - Take user id query database and return session info.
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function getSessionInfo($id)  //take id from cookie and return array of session info
	{
		$fields = array('username','first_name','last_name','avatar','permission','theme');
		$where = "id='" . $id . "'";
		$info = $this->select('user',$fields,$where);
		if(!$info)
		{
			return false;
		}
		return $info;

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//login(  email ,  password ) - Check given email/password vs db return the id if info is valid else return false.
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function login($email, $password)
	{
		$what = array('id','passhash','salt','permission');
		$where = 'email = "' . $email. '"';
		$login = $this->select('user',$what,$where);
		if($login != false)
		{
			$testhash = crypt($password,$login['salt']);
			if($testhash == $login['passhash'])
			{
				return $login['id'];
			}
		}

		return false;
	}
	
	public function getUsername($uid )
	{	
		$what = array('username');
		$where = 'id = "' . $uid. '"';
		$uname = $this->select('user',$what,$where);
		if($uname != false)
		{
			return $uname;
		}
		return false;
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//getEvents(group id, start time, repeat period(day/week/month/year views), order ) - Returns all events from a specific group in the time $period that starts at $start 
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function getEvents($group, $start, $period, $order='desc')
	{
		$table = "events";
		$get =  array('eid','gid','ownerid','priority','date_created','event_date','repeat_style','repeat_until','title','location','description');
		$where = "event_date >= '".$start."' AND event_date  <= DATE_ADD('".$start."' ,";
		if(is_numeric($period))
		{
		$where .= "INTERVAL " . $period . " DAY) ";
		}
		else if($period == "day")
		{
		$where .= "INTERVAL 1 DAY) ";
		}
		else if($period == "week")
		{
		$where .= "INTERVAL 7 DAY) ";
		}
		else if($period == "month")
		{
		$where .= "INTERVAL 1 MONTH) ";
		}
		else if($period == "year")
		{
		$where .= "INTERVAL 1 YEAR) ";
		}
		if($order == "asc")
		{
		$where .= "ORDER BY event_date ASC";
		}
		elseif($order == "desc")
		{
		$where .= "ORDER BY  event_date DESC";
		}
		
		$info = $this->selectMany('events',$get,$where);
		
		if($info)
		{
			return $info;
		}
		return false;
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//getGroupsCreated
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function getGroupsCreated($user)
	{
		$get =  array('gid','ownerid','date_created','title','description');
		$where = "ownerid = ".$user." ORDER BY gid ASC";
		
		$info = $this->selectMany('groups',$get,$where);
		
		if($info)
		{
			return $info;
		}
		return false;
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//getGroupMembers
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function getGroupMembers($gid)
	{
		$get =  array('gid','userid','date_joined','permission');
		$where = "gid = ".$gid." ORDER BY date_joined ASC";
		
		$info = $this->selectMany('group_user',$get,$where);
		
		if($info)
		{
			return $info;
		}
		return false;
	}
	
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//disconnect( ) - Disconnect from MySQL db 
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function disconnect()
	{
		if ( $this->connection_id )
		{
			return @mysqli_close( $this->connection_id );
		}
	}
}
?>
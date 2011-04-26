<?php

class DB {
	
    public static function dbSetup($srv, $usr, $pas, $dbs) {
        //echo $srv.", ".$usr.", ".$pas.",".$dbs;
        $conn = mysql_connect($srv, $usr, $pas);
        if (!$conn) {
            //echo "<p id='error'>ERROR Connection failed with mySQL: ".mysql_error()."</p>";
            return false;
        } else {
            $dbconn = mysql_select_db($dbs);
            if (!$dbconn) {
                //echo "<p id='error'>ERROR with DB Selection mySQL: ".mysql_error()."</p>";
                return false;
            }
            return true;
        }
    }
	
    public static function dbQuery($sql, $qType) {
        $runQ = mysql_query($sql);
        if (!$runQ) {
            echo "<p id='error'>ERROR with mySQL: ".mysql_error()."</p>";
        } else {
            switch ($qType) {
                // Run query and return resource
                case "0":
                    return $runQ;
                    break;
                case "1":
                    $singVal = mysql_fetch_array($runQ);
                    return $singVal[0];
                    break;
                default:
                    break;
            }
        }
    }
	/*
     * Trying to create a hyper intelligent Page Update system 
     */
	
    public static function dbUpdatePage($table, $data) {
        $end = array_pop(array_keys($data));
		$query = "UPDATE ".$table." SET ";
		foreach ($data as $key=>$val) {
			if ($key == "id") {
			} else {
				if ($end == $key) {
					$query .= $key."='".$val."' ";
				} else {
					$query .= $key."='".$val."', ";
				}
			}
		}
		$query .= " WHERE id='".$data['id']."';";
		$dbFields = DB::dbQuery($query,"0");
        if (!$dbFields) {
            echo "<p>Sorry there was an error updating the content of this page.  Please alert a site administrator so this can corrected.</p>";
            echo mysql_error();
        }
    }

    public static function dbInsertContact($table, $data) {
		$query = "INSERT INTO ".$table." VALUES ('',";
		foreach ($data as $key=>$val) {
            if (end($data) == $val) {
                $query .= "'".$val."' ";
            } else {
                $query .= "'".$val."', ";
            }
		}
		$query .= ", '');";
		$dbFields = DB::dbQuery($query,"0");
        if (!$dbFields) {
            error::displayError(12);
        }
    }

    public static function dbInsert($table, $data) {
        $count = count($data);
        $i=1;
        $query = "INSERT INTO ".$table." VALUES ('',";
		foreach ($data as $key=>$val) {
            if ($i == $count) {
                $query .= "'".$val."' ";
            } else {
                $query .= "'".$val."', ";
            }
            $i++;
		}
		$query .= ");";
		$dbFields = DB::dbQuery($query,"0");
        if (!$dbFields) {
            error::displayError(12);
        }
    }

    public static function dbFetch($data, $type) {
        switch ($type) {
            case "assoc":
                $outData = mysql_fetch_assoc($data);
                break;
            case "array":
                $outData = mysql_fetch_array($data);
                break;
            default:
                $outData = mysql_fetch_assoc($data);
                break;
        }
        return $outData;
    }


    public static function dbDelete($table, $unique ,$ref) {
        $query = "DELETE FROM ".$table." WHERE ".$unique." = '".$ref."';";
        $request = mysql_query($query);
        if ($request) {
            return true;
        } else {
            error::displayError(13);
            return false;
        }
    }

    public static function dbUpdate($table, $data, $id) {
        $count = count($data);
        $i=1;
		$query = "UPDATE ".$table." SET ";
		foreach ($data as $key=>$val) {
            if ($i == $count) {
                $query .= $key."='".$val."' ";
            } else {
                $query .= $key."='".$val."', ";
            }
            $i++;
		}
		$query .= " WHERE ".$id.";";
		$dbFields = DB::dbQuery($query,"0");
        if (!$dbFields) {
            error::displayError(12);
        }

    }

    public static function dbResMenu($qRes) {
        while ($showMenu = mysql_fetch_assoc($qRes)) {
                echo "<a href='".$showMenu['menuLink']."' title='".$showMenu['menuTitle']."'>".$showMenu['menuName']."</a> | ";
        }
    }

      public static function dbCount($qRes) {
        $num = mysql_num_rows($qRes);
        return $num;
    }
	
}

?>
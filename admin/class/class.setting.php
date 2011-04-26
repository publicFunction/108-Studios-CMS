<?php

class settings {
    
    public static function loadRegistry() {
		$list = settings::getRegList('');
		while ($reg = DB::dbFetch($list, 'assoc')) {
			define($reg['reg_param'],$reg['reg_value']);
		}
	}
	
    public static function showReg() {
        $group =  settings::getRegGroup();
        while ($data = DB::dbFetch($group, 'array')) {
            switch ($data[0]) {
                case "System":
                    echo "<h2>System Registry</h2>
                        <p><h5 class='regParam'>Parameter</h5><h5 class='regVal'>Value</h5><br />";

                    $list = settings::getRegList($data[0]);
                    while ($param = DB::dbFetch($list, 'assoc')) {
                        echo "<p class='regPara'><span class='regParam'>".$param['reg_param']."</span><span class='regVal'>".$param['reg_value']."</span>&nbsp;<a href='javascript:' class='editVal'>Edit</a></p>";
                    }
                    break;
                case "Default":
                    echo "<h2>Default Registry</h2>";
                    $list = settings::getRegList($data[0]);
                    while ($param = DB::dbFetch($list, 'assoc')) {
                        echo "<p class='regPara'><span class='regParam'>".$param['reg_param']."</span><span class='regVal'>".$param['reg_value']."</span>&nbsp;<a href='javascript:' class='editVal'>Edit</a></p>";
                    }
                    break;
                case "Database":
                    echo "<h2>Database Registry</h2>";
                    $list = settings::getRegList($data[0]);
                    while ($param = DB::dbFetch($list, 'assoc')) {
                        echo "<p class='regPara'><span class='regParam'>".$param['reg_param']."</span><span class='regVal'>".$param['reg_value']."</span>&nbsp;<a href='javascript:' class='editVal'>Edit</a></p>";
                    }
                    break;
                case "Social Media":
                    echo "<h2>Social Media Registry</h2>";
                    $list = settings::getRegList($data[0]);
                    while ($param = DB::dbFetch($list, 'assoc')) {
                        echo "<p class='regPara'><span class='regParam'>".$param['reg_param']."</span><span class='regVal'>".$param['reg_value']."</span>&nbsp;<a href='javascript:' class='editVal'>Edit</a></p>";
                    }
                    break;
                case "External":
                    echo "<h2>External Registry</h2>";
                    $list = settings::getRegList($data[0]);
                    while ($param = DB::dbFetch($list, 'assoc')) {
                        echo "<p class='regPara'><span class='regParam'>".$param['reg_param']."</span><span class='regVal'>".$param['reg_value']."</span>&nbsp;<a href='javascript:' class='editVal'>Edit</a></p>";
                    }
                    break;
                default:
                    break;
            }
        }
            
	}

    public static function getRegGroup() {
		$list = DB::dbQuery("SELECT DISTINCT(reg_group) FROM register ORDER BY reg_group DESC;", "0");
		return $list;
	}

	public static function getRegList($type) {
        if ($type == "") {
            $regList = DB::dbQuery("SELECT * FROM register ORDER BY reg_group DESC;", "0");
        } else {
            $regList = DB::dbQuery("SELECT * FROM register WHERE reg_group = '".$type."'ORDER BY reg_group DESC;", "0");
        }
        return $regList;
	}

    public static function loadjQuery($vers) {
        echo "<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/".$vers."/jquery.min.js'></script>";
    }

    public static function loadjQueryTools($vers) {
        echo "<script src='http://cdn.jquerytools.org/".$vers."/all/jquery.tools.min.js'></script>";
    }


    public static function loadjQueryUI($vers) {
        echo "<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/".$vers."/jquery-ui.js'></script>";
    }

    public static function loadInclude($ext) {
        foreach(glob(INCLUDE_DIR."*.".$ext."") as $file) {
            switch ($ext) {
                case "js":
                    echo "<script type='text/javascript' src='".$file."'></script>";
                    break;
                default:
                    break;
            }
        }
    }
}

?>
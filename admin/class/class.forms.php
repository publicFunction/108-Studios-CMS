<?php

class forms {

    public static function openForm($name, $id, $action, $method, $files=false) {
        if (isset($method) && $method == "" || strtolower($method) == "get") {
            echo "<p>Method of form submission not recommnded, please use post.</p>";
        } else {
            if (isset($action) && $action == "") {
                echo "<p>Please provide an action for the form.</p>";
            } else {
                if (isset($name) && $name == "") {
                   echo "<p>Please provide a name for the form.</p>";
                } else {
                    if ($files) {
                        echo "<form name='".$name."' id='".$id."' action='".$action."' method='".$method."' enctype='multipart/form-data'>";
                    } else {
                        echo "<form name='".$name."' id='".$id."' action='".$action."' method='".$method."'>";
                    }
                }
            }

        }
    }

    public static function closeForm() {
        echo "</form>";
    }

    public static function fieldsetOpen($legend) {
        echo "<fieldset>";
        if (isset($legend) && $legend != "") {
            forms::legend($legend);
        } else {
            
        }
    }
    
    public static function fieldsetClose() {
        echo "</fieldset>";
    }

    public static function legend($text) {
        echo "<legend>".$text."</legend>";
    }

    public static function input($name, $id, $val, $class, $label, $type, $js=false, $readonly=false) {
        if (isset($label) && $label != "") {
            if (isset($id) && $id != "") {
                $field = "<label for='".$id."'>".$label."</label><input ";
            } else {
                $field = "<label>".$label."</label><input ";
            }
        } else {
            $field = "<input ";
        }
        if (isset($type) && $type != "") {
            if ($type == 'password') {
                echo "<p>Please use forms::password() and not forms::input</p>";
            } else {
                if ($type == 'hidden' && $val == "") {
                    echo "<p>Hidden fields must provide a default value.</p>";
                } else {
                    $field .= "type='".$type."' ";
                }
            }
        } else {
            $field .= "type='text' ";
        }
        if (isset($name) && $name != "") {
            $field .= "name='".$name."' ";
        } else {
            $field .= "name='input' ";
        }
        if (isset($id) && $id != "") {
            $field .= "id='".$id."' ";
        } else {
            $field .= "";
        }
        if (isset($val) && $val != "") {
            $field .= "value='".$val."' ";
        } else {
            $field .= "";
        }
        if (isset($class) && $class != "") {
            $field .= "class='".$class."' ";
        } else {
            $field .= "";
        }
        if (isset($js) && $class != "") {
            $field .= $js." ";
        } else {
            $field .= "";
        }
        if ($readonly) {
             $field .= " readonly />";
        } else {
            if ($type == 'checkbox' && $val == "1") {
                $field .= " checked />";
            } else {
                $field .= " />";
            }
        }
        echo $field;
    }

    public static function textarea($name, $id, $val, $class, $label, $col, $row) {
        if (isset($label) && $label != "") {
            $field = "<label>".$label."</label><textarea ";
        } else {
            $field = "<textarea ";
        }
        if (isset($name) && $name != "") {
            $field .= "name='".$name."' ";
        } else {
            $field .= "name='textarea' ";
        }
        if (isset($id) && $id != "") {
            $field .= "id='".$id."' ";
        } else {
            $field .= "";
        }
        if (isset($class) && $class != "") {
            $field .= "class='".$class."' ";
        } else {
            $field .= "";
        }
        if (isset($col) && $col != "") {
            $field .= "cols='".$col."' ";
        } else {
            $field .= "";
        }
        if (isset($row) && $row != "") {
            $field .= "rows='".$row."' ";
        } else {
            $field .= "";
        }
        if (isset($val) && $val != "") {
            $field .= ">".$val."</textarea>";
        } else {
            $field .= "></textarea>";
        }
        
        echo $field;
    }

    public static function select($name, $id, $data, $default, $defval, $label, $selected=false, $db=false) {
        if (isset($label) && $label != "") {
            $select = "<label>".$label."</label><select ";
        } else {
            $select = "<select ";
        }
        if (isset($id) && $id != "") {
            $select .= " id='".$id."' ";
        }
        if (isset($name) && $name != "") {
            $select .= " name='".$name."'>";
        } else {
            echo "<p>Select Elememts require a name, please supply a valid name</p>";
        }
        if (isset($default) && $default != "") {
            $select .= "<option value='".$defval."'>".$default."</option>";
        } else {
            $select .= "";
        }
        if (isset($data)) {
            if (!$db) {
                if (is_array($data)) {
                    foreach($data as $key=>$val) {
                        if ($key == $val) {
                            if ($val == $selected) {
                                $select .= "<option value='".$val."' selected='selected'>".$val."</option>";
                            } else {
                                $select .= "<option value='".$val."'>".$val."</option>";
                            }
                        } else {
                            if ($key == $selected) {
                                $select .= "<option value='".$key."' selected='selected'>".$val."</option>";
                            } else {
                                $select .= "<option value='".$key."'>".$val."</option>";
                            }
                        }
                    }
                }
            } else {
                while ($options = DB::dbFetch($data,'assoc')) {
                    if ($selected && $selected != "" && $selected == $options['status']) {
                        $select .= "<option value='".$options['ID']."' selected='selected'>".$options['status']."</option>";
                    } else {
                        $select .= "<option value='".$options['ID']."'>".$options['status']."</option>";
                    }
                }
            }
        } else {
            echo "<p>Please supply a valid dataset/array</p>";
        }
        $select .= "</select>";
        echo $select;
    }

    public static function combo() {

    }

    public static function password() {

    }

    public static function processApplication($data) {
        if (is_array($data)) {
            if (array_key_exists('jobRef',$data)) {
                $submission = array('Name' => $data['clientName'],
                                    'Email' => $data['email'],
                                    'Phone' => $data['contactNo'],
                                    'Add_1' => $data['Add_1'],
                                    'Add_2' => $data['Add_2'],
                                    'Postcode' => $data['postcode'],
                                    'curriculumVitae' => mysql_real_escape_string($data['pasteCV']),
                                    'Comment' => 'Agent Comments'
                                    );
                DB::dbInsert("clients", $submission);
                $getID = cv::getCVNo();
                $register = array(	'applicant' => $data['clientName'],
                                    'contactno' => $data['contactNo'],
                                    'email' => $data['email'],
                                    'jobref' => $data['jobid'],
                                    'cvno' => $getID
                                );
                DB::dbInsert("applications", $register);
            } else {
                $submission = array('Name' => $data['clientName'],
                                    'Email' => $data['email'],
                                    'Phone' => $data['contactNo'],
                                    'Add_1' => $data['Add_1'],
                                    'Add_2' => $data['Add_2'],
                                    'Postcode' => $data['postcode'],
                                    'curriculumVitae' => mysql_real_escape_string($data['pasteCV']),
                                    'Comment' => 'Agent Comments'
                                    );
                DB::dbInsert("clients", $submission);
            }
			actions::clearArray($data);
            return true;
		} else {
            return false;
		}
    }

    public static function processContactForm($data) {
        if (is_array($data)) {
			$info = array(	'contactName' => $data['contactName'],
							'contactEmail' => $data['contactEmail'],
							'contactNumber' => $data['contactNumber'],
							'contactReason' => $data['contactReason']
						);
			DB::dbInsertContact("contacts", $info);
            /*  TODO:
             *          Deal with Mail stuff...
             */
			actions::clearArray($data);
            return true;
		} else {
            return false;
		}
    }

    public static function processAddJob($data) {
        
        if (is_array($data)) {
            $info = array(	'reference' => $data['reference'],
                            'title' => $data['title'],
							'descript' => mysql_real_escape_string($data['descript']),
                            'salary' => str_replace("£","&pound;",$data['salary']),
                            'location' => $data['location'],
							'owner' => $data['owner'],
							'posted' => $data['posted'],
                            'status' => $data['status']
						);
			DB::dbInsert("vacancies", $info);
            actions::clearArray($data);
            return true;
        } else {
            return false;
        }
    }

    public static function processUpdateJob($data) {
        if (is_array($data)) {
            $info = array(	'reference' => $data['reference'],
                            'title' => $data['title'],
							'descript' => mysql_real_escape_string($data['descript']),
                            'salary' => str_replace("£","&pound;",$data['salary']),
                            'location' => $data['location'],
							'owner' => $data['owner'],
							'posted' => $data['posted'],
                            'status' => $data['status']
						);
			DB::dbUpdate("vacancies", $info, $data['vacancyID']);
            actions::clearArray($data);
            return true;
        } else {
            return false;
        }
    }
}


?>

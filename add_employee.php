<?php
include('header.php');
$xml = new Xml();

$action = isset($_GET['action']) ? $_GET['action'] : 'Add';
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($action == "edit") {
    $result = $xml->readXML(EMPLOYEES_XML_FILE_NAME, EMPLOYEES_XML_FILE_TITLE, $id);
}
if ($action == "delete") {
    $result = $xml->readXML(EMPLOYEES_XML_FILE_NAME, EMPLOYEES_XML_FILE_TITLE);
    // remove array element
    unset($result['record'][$id]);

    //This function create a xml object with element root.
    $xml->generateXML($result);

    header('Location: index.php');
}

if (isset($_POST)) {
    $hidden_id = isset($_POST['hidden_id']) ? $_POST['hidden_id'] : '';
    $emp_name = isset($_POST['name']) ? $_POST['name'] : '';
    $team_name = isset($_POST['team_name']) ? $_POST['team_name'] : '';

    if ($emp_name) {
        
        $data = $xml->readXML(EMPLOYEES_XML_FILE_NAME, EMPLOYEES_XML_FILE_TITLE);
        // echo "<pre>";
        // print_r($data);

        // Add a new record
        if (!$hidden_id) {
            $count = 0;
            if ($data['record']) {
                $count = count($data['record']);
            }

            $newArr = $record = array();
            $id = 1 + $count;
            $data['record'][$id]['id'] = $id;
            $data['record'][$id]['name'] = $emp_name;
            $data['record'][$id]['team_name'] = $team_name;
        } else {
            // Update existing record
            $data['record'][$hidden_id]['id'] = $hidden_id;
            $data['record'][$hidden_id]['name'] = $emp_name;
            $data['record'][$hidden_id]['team_name'] = $team_name;
        }
        
        // append child record
        $newArr['title'] = $data['title'];
        $newArr['record'] = $data['record'];

        // print_r($newArr);
        // die;

        //This function create a xml object with element root.
        $xml->generateXML($newArr);

        header('Location: index.php');
        
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="mb-2 p-2">
                <a href="manage_employees.php">« Back to Manage Employees </a>
            </div>
            <div class="card bg-light mb-1">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 kn">
                    <div class="card-body mt-2 p-2">
                        <div id="success_msg"></div>
                        <h2 class="text-primary"><?php echo ucfirst($action); ?> Employee</h2>
                        <form method="POST" action="add_employee.php" name="EmployeeForm" onSubmit="return validateForm(this);">
                        <input type="hidden" name="hidden_id" value="<?php echo isset($result['id']) ? $result['id'] : ''; ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Employee Name" autocomplete="off" value="<?php echo isset($result['name']) ? $result['name'] : ''; ?>">
                            <span id="name_err" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="from_date">Team Name</label>
<input type="text" class="form-control" name="team_name" id="team_name" placeholder="Enter Team Name" autocomplete="off" value="<?php echo isset($result['team_name']) ? $result['team_name'] : ''; ?>">
                            <span id="team_id_err" class="text-danger"></span>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
<script type="text/javascript">
function validateForm()
{ 
    $(".text-danger").html('');
    var error = true;
    var errorInput;
    var name = document.forms["EmployeeForm"]["name"];
    var team_name = document.forms["EmployeeForm"]["team_name"];
    if (name.value == "")                                  
    { 
        $("#name_err").html('Please enter your name.');
        errorInput = name;
        error= false; 
    }
    if (team_name.value == "")    
    { 
        $("#team_id_err").html('Please choose your team.');
        errorInput = team_name; 
        error= false; 
    }
    if (!error) {
        errorInput.focus();
    }
    return error;
}
</script>
<?php include('footer.php');?>

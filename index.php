<?php
include('header.php');
$xml = new Xml();
$data = $xml->readXML(EMPLOYEES_XML_FILE_NAME, EMPLOYEES_XML_FILE_TITLE);
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card bg-light mb-1">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 kn">
                    <div class="card-body mt-2 p-2">
                        <div class="float-right">
                            <a href="add_employee.php" class="btn btn-success btn-sm">Add</a>
                        </div>
                        <div id="success_msg"></div>
                        <h2 class="text-primary">Manage Employees</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><strong>Nos</strong></th>
                                    <th><strong>Employee Name</strong></th>
                                    <th><strong>Team</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data['record']) {
                                    foreach ($data['record'] as $k => $result) {
                                ?>
                                <tr>
                                    <td><?php echo $result['id']; ?></td>
                                    <td><?php echo $result['name']; ?></td>
                                    <td><?php echo $result['team_name'] ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-success"
                                        href="add_employee.php?action=edit&id=<?php echo $result['id']; ?>">
                                        Edit
                                        </a>
                                        <a class="btn btn-sm btn-danger" 
                                        href="add_employee.php?action=delete&id=<?php echo $result['id']; ?>" onclick="return confirmDelete();">
                                        Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan=5>No Record Found</td></tr>";
                                }
                                ?>
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
<script>
function confirmDelete() {
    if (confirm('Are you sure you want to delete this record')) {
        return true;
    } else {
        return false;
    }
}
</script>
<?php include('footer.php');?>

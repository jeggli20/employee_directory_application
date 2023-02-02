<?php
$jobs = Job::select_all();
$employees = Employee::select_all();
$url_string = substr($_SERVER["REQUEST_URI"], 69, 3);
?>

<label for="first_name">First Name:</label>
<input type="text" name="employee[first_name]" id="first_name" placeholder="John" value="<?php echo $employee->first_name ?? "" ?>" />
<label for="last_name">Last Name:</label>
<input type="text" name="employee[last_name]" id="last_name" placeholder="Smith" value="<?php echo $employee->last_name ?? "" ?>" />
<label for="username">Username:</label>
<input type="text" name="employee[username]" id="username" placeholder="johnsmith" value="<?php echo $employee->username ?? "" ?>" />
<?php
if($url_string === "new") {
    echo "<label for='password'>Password:</label>";
    echo "<input type='password' name='employee[password]' id='password' placeholder='Password' />";
    echo "<label for='c_password'>Confirm Password:</label>";
    echo "<input type='password' name='employee[c_password]' id='c_password' placeholder='Confirm Password' />";
} else {
    echo "<button id='password-btn' type='button'>Change Password?</button>";
    echo "<label for='password' class='edit-password'>Password:</label>";
    echo "<input type='password' name='employee[password]' id='password' class='edit-password' placeholder='Password' />";
    echo "<label for='c_password' class='edit-password'>Confirm Password:</label>";
    echo "<input type='password' name='employee[c_password]' id='c_password' class='edit-password' placeholder='Confirm Password' />";
}
?>



<label for="email">Email:</label>
<input type="email" name="employee[email]" id="email" placeholder="johnsmith@gmail.com" value="<?php echo $employee->email ?? "" ?>" />
<label for="birthday">Birthday:</label>
<input type="date" name="employee[birthday]" id="birthday" value="<?php echo $employee->birthday ?? "" ?>" />
<label for="phone_number">Phone Number:</label>
<input type="text" name="employee[phone_number]" id="phone_number" placeholder="###-###-####" value="<?php echo $employee->phone_number ?? "" ?>" />
<label for="job">Job Title:</label>
<select name="employee[job_id]" id="job_id">
    <?php 
    foreach($jobs as $job) {
        if($job->id === $employee->job_id) {
            echo "<option value='" . $job->id . "' selected>" . $job->job_title . "</option>";
        } else {
            echo "<option value='" . $job->id . "'>" . $job->job_title . "</option>";
        }
    }
    ?>
</select>
<label for="supervisor">Supervisor:</label>
<select name="employee[supervisor_id]" id="supervisor_id">
    <option value="">N/A</option>
    <?php 
    foreach($employees as $emp) {
        if($emp->id === $employee->supervisor_id) {
            echo "<option value='" . $emp->id . "' selected>" . $emp->full_name() . "</option>";
        } else {
            echo "<option value='" . $emp->id . "'>" . $emp->full_name() . "</option>";
        }
    }
    ?>
</select>
<label for="date_started">Date Started:</label>
<input type="date" name="employee[date_started]" id="date_started" value="<?php echo (string) $employee->date_started ?? ""; ?>" />  
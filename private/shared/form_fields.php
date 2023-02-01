<?php
$jobs = Job::select_all();
$employees = Employee::select_all();
?>

<label for="first_name">First Name:</label>
<input type="text" name="employee[first_name]" id="first_name" placeholder="John" value="<?php echo $form_info["first_name"] ?? "" ?>" />
<label for="last_name">Last Name:</label>
<input type="text" name="employee[last_name]" id="last_name" placeholder="Smith" value="<?php echo $form_info["last_name"] ?? "" ?>" />
<label for="username">Username:</label>
<input type="text" name="employee[username]" id="username" placeholder="johnsmith" value="<?php echo $form_info["username"] ?? "" ?>" />
<label for="password">Password:</label>
<input type="password" name="employee[password]" id="password" placeholder="Password" value="<?php echo $form_info["password"] ?? "" ?>" />
<label for="c_password">Confirm Password:</label>
<input type="password" name="employee[c_password]" id="c_password" placeholder="Confirm Password" value="<?php echo $form_info["c_password"] ?? "" ?>" />
<label for="email">Email:</label>
<input type="email" name="employee[email]" id="email" placeholder="johnsmith@gmail.com" value="<?php echo $form_info["email"] ?? "" ?>" />
<label for="birthday">Birthday:</label>
<input type="date" name="employee[birthday]" id="birthday" value="<?php echo $form_info["birthday"] ?? "" ?>" />
<label for="phone_number">Phone Number:</label>
<input type="text" name="employee[phone_number]" id="phone_number" placeholder="###-###-####" value="<?php echo $form_info["phone_number"] ?? "" ?>" />
<label for="job">Job Title:</label>
<select name="employee[job_id]" id="job_id">
    <?php 
    foreach($jobs as $job) {
        echo "<option value='" . $job->id . "'>" . $job->job_title . "</option>";
    }
    ?>
</select>
<label for="supervisor">Supervisor:</label>
<select name="employee[supervisor_id]" id="supervisor_id">
    <option value="">N/A</option>
    <?php 
    foreach($employees as $employee) {
        echo "<option value='" . $employee->id . "'>" . $employee->full_name() . "</option>";
    }
    ?>
</select>
<label for="date_started">Date Started:</label>
<input type="date" name="employee[date_started]" id="date_started" value="<?php echo $form_info["date_started"] ?? "" ?>" />  
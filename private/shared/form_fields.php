<?php
$jobs = Job::select_all();
?>

<label for="first_name">First Name:</label>
<input type="text" name="employee[first_name]" id="first_name" placeholder="John" />
<label for="last_name">Last Name:</label>
<input type="text" name="employee[last_name]" id="last_name" placeholder="Smith" />
<label for="username">Username:</label>
<input type="text" name="employee[username]" id="username" placeholder="johnsmith" />
<label for="password">Password:</label>
<input type="password" name="employee[password]" id="password" placeholder="Password" />
<label for="c_password">Confirm Password:</label>
<input type="c_password" name="employee[c_password]" id="c_password" placeholder="Confirm Password" />
<label for="email">Email:</label>
<input type="email" name="employee[email]" id="email" placeholder="johnsmith@gmail.com" />
<label for="birthday">Birthday:</label>
<input type="date" name="employee[birthday]" id="birthday" />
<label for="phone_number">Phone Number:</label>
<input type="text" name="employee[phone_number]" id="phone_number" placeholder="###-###-####" />
<label for="job">Job Title:</label>
<select name="employee[job_id]" id="job">
    <?php 
    foreach($jobs as $job) {
        echo "<option value='" . $job->job_title . "'>" . $job->job_title . "</option>";
    }
    ?>
</select>
<label for="supervisor">Supervisor:</label>
<input type="text" name="employee[supervisor_id]" id="supervisor" placeholder="Supervisor" />
<label for="start_date">Date Started:</label>
<input type="date" name="employee[time_employed_days]" id="start_date" value="" />  
<?php
$jobs = Job::select_all(["sort"=>"job_title"]);
$employees = Employee::select_all(["sort"=>"first_name"]);
$url_string = substr($_SERVER["REQUEST_URI"], 69, 3);
?>

<?php
    if(!empty($employee->errors)) {
        echo "<div class='errors-container'>";
        echo "<ul class='errors-list'>";
        foreach($employee->errors as $error) {
            echo "<li class='error'>" . $error . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
?>
<div class="form-group">
    <h3>Basic Information</h3>
    <div class="form-row">
        <div class="input-group">
            <label for="first_name">First Name:</label>
            <input class="<?php if(isset($employee->errors['first_name'])) echo 'invalid'; ?>" type="text" name="employee[first_name]" id="first_name" placeholder="John" value="<?php echo $employee->first_name ?? "" ?>" />
        </div>
        <div class="input-group">
            <label for="last_name">Last Name:</label>
            <input class="<?php if(isset($employee->errors['last_name'])) echo 'invalid'; ?>" type="text" name="employee[last_name]" id="last_name" placeholder="Smith" value="<?php echo $employee->last_name ?? "" ?>" />
        </div>
    </div>
    <div class="form-row">
        <div class="input-group-row">
            <label for="username">Username:</label>
            <input class="<?php if(isset($employee->errors['username'])) echo 'invalid'; ?>" type="text" name="employee[username]" id="username" placeholder="johnsmith" value="<?php echo $employee->username ?? "" ?>" />
        </div>
    </div>
    <?php
        if($url_string === "new") {
            echo "<div class='form-row'>";
            echo    "<div class='input-group'>";
            echo        "<label for='password'>Password:</label>";
            if(isset($employee->errors['password'])) {
                echo    "<input class='invalid' type='password' name='employee[password]' id='password' placeholder='Password' />";
            } else {
                echo    "<input type='password' name='employee[password]' id='password' placeholder='Password' />";

            }
            echo    "</div>";
            echo    "<div class='input-group'>";
            echo        "<label for='c_password'>Confirm Password:</label>";
            if(isset($employee->errors['c_password'])) {
                echo    "<input class='invalid' type='password' name='employee[c_password]' id='password' placeholder='Confirm Password' />";
            } else {
                echo    "<input type='password' name='employee[c_password]' id='password' placeholder='Confirm Password' />";

            }            echo    "</div>";
            echo "</div>";
        } else {
            echo "<button class='btn' id='password-btn' type='button'>Change Password?</button>";
            echo "<div class='form-row'>";
            echo    "<div class='input-group'>";
            echo        "<label for='password' class='edit-password'>Password:</label>";
            if(isset($employee->errors['password'])) {
                echo    "<input class='invalid edit-password' type='password' name='employee[password]' id='password' placeholder='Password' />";
            } else {
                echo    "<input class='edit-password' type='password' name='employee[password]' id='password' placeholder='Password' />";
            }
            echo    "</div>";
            echo    "<div class='input-group'>";
            echo        "<label for='c_password' class='edit-password'>Confirm Password:</label>";
            if(isset($employee->errors['password'])) {
                echo    "<input class='invalid edit-password' type='password' name='employee[c_password]' id='password' placeholder='Confirm Password' />";
            } else {
                echo    "<input class='edit-password' type='password' name='employee[c_password]' id='password' placeholder='Confirm Password' />";
            }            echo    "</div>";
            echo "</div>";
        }
    ?>  
</div>
<div class="form-group">
    <h3>Contact Information</h3>
    <div class="form-row">
        <div class="input-group">
            <label for="email">Email:</label>
            <input class="<?php if(isset($employee->errors['email'])) echo 'invalid'; ?>" type="email" name="employee[email]" id="email" placeholder="johnsmith@gmail.com" value="<?php echo $employee->email ?? "" ?>" />
        </div>
        <div class="input-group">
            <label for="phone_number">Phone Number:</label>
            <input class="<?php if(isset($employee->errors['phone_number'])) echo 'invalid'; ?>" type="text" name="employee[phone_number]" id="phone_number" placeholder="###-###-####" value="<?php echo $employee->phone_number ?? "" ?>" />
        </div>
    </div>
</div>
<div class="form-group">
    <h3>Job Information</h3>
    <div class="form-row">
        <div class="input-group">
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
        </div>
        <div class="input-group">
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
        </div>
    </div>
</div>
<div class="form-group">
    <h3>Optional Information</h3>
    <div class="form-row">
        <div class="input-group">
            <label for="birthday">Birthday:</label>
            <input class="<?php if(isset($employee->errors['birthday'])) echo 'invalid'; ?>" type="date" name="employee[birthday]" id="birthday" value="<?php echo $employee->birthday ?? "" ?>" />
        </div>
        <div class="input-group">
            <label for="date_started">Date Started:</label>
            <input class="<?php if(isset($employee->errors['date_started'])) echo 'invalid'; ?>" type="date" name="employee[date_started]" id="date_started" value="<?php echo (string) $employee->date_started ?? ""; ?>" />  
        </div>
    </div>
</div>


<form id="register_form" class="user-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <fieldset>
        <legend>Registration Details</legend>
        <label for="firstname">Firstname: </label>
        <input value="<?php if (isset($firstname)) {
                            echo $firstname;
                        } ?>" type="text" name="firstname" id="firstname" minlength="3" maxlength="50" pattern="<?php echo Pattern::NAME; ?>" placeholder="Firstname" required>
        <br />
        <label for="lastname">Lastname: </label>
        <input value="<?php if (isset($lastname)) {
                            echo $lastname;
                        } ?>" type="text" name="lastname" id="lastname" minlength="3" maxlength="50" pattern="<?php echo Pattern::NAME; ?>" placeholder="Lastname" required>
        <br />
        <label for="password_01">Password: </label>
        <input type="password" name="password_01" id="password_01" minlength="10" maxlength="50" pattern="<?php echo Pattern::PASSWORD; ?>" placeholder="Password" required>
        <br />
        <label for="password_02">Confirm Password: </label>
        <input type="password" name="password_02" id="password_02" minlength="10" maxlength="50" pattern="<?php echo Pattern::PASSWORD; ?>" placeholder="Re-enter Password" required>
    </fieldset>

    <fieldset>
        <legend>Contact Details</legend>
        <label for="email">Email Address: </label>
        <input value="<?php if (isset($email)) {
                            echo $email;
                        } ?>" type="email" name="email" id="email" placeholder="Email" required>
        <br />
        <label for="phone">Contact Phone: </label>
        <input value="<?php if (isset($phone)) {
                            echo $phone;
                        } ?>" type="text" name="phone" id="phone" minlength="10" maxlength="10" pattern="<?php echo Pattern::PHONE; ?>" placeholder="Phone Number" required>
    </fieldset>

    <input type="submit" value="Register" name="submit">
</form>
<p class="prompt">Already registered? <a href="./login.php">Login here!</a></p>
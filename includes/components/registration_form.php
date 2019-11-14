<form action="register.php" method="post">
    <fieldset>
        <label for="firstname">Firstname: </label><input type="text" name="firstname" id="firstname" minlength="3" maxlength="50" pattern="<?php echo Pattern::NAME; ?>" required><br />
        <label for="lastname">Lastname: </label><input type="text" name="lastname" id="lastname" minlength="3" maxlength="50" pattern="<?php echo Pattern::NAME; ?>" required><br />
        <label for="password_01">Password: </label><input type="password" name="password_01" id="password_01" minlength="10" maxlength="50" pattern="<?php echo Pattern::PASSWORD; ?>" required><br />
        <label for="password_02">Confirm Password: </label><input type="password" name="password_02" id="password_02" minlength="10" maxlength="50" pattern="<?php echo Pattern::PASSWORD; ?>" required><br />
        <label for="email">Email Address: </label><input type="email" name="email" id="email" required><br />
        <label for="phone">Contact Phone: </label><input type="text" name="phone" id="phone" minlength="10" maxlength="10" pattern="<?php echo Pattern::PHONE; ?>" required><br />
        <input type="submit" value="Register" name="submit">
    </fieldset>
</form>
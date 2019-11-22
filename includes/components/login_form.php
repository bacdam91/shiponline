<form id="login_form" class="user-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <fieldset>
        <legend>Login</legend>
        <label for="customer-number">Customer Number: </label>
        <input value="<?php if (isset($customerNumber)) {
                            echo $customerNumber;
                        } ?>" type="number" name="customerNumber" id="customerNumber" minlength="3" maxlength="4" placeholder="Customer Number" required>
        <br />
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" minlength="10" maxlength="50" pattern="<?php echo Pattern::PASSWORD; ?>" placeholder="Password" required>
    </fieldset>
    <input type="submit" value="Login" name="submit">
</form>
<p class="prompt">Have not registered? <a href="./register.php">Register here!</a></p>
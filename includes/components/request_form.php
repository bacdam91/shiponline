<form id="request_form" class="user-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <fieldset>
        <legend>Item Information</legend>
        <label for="item-description">Item Description: </label>
        <input type="text" id="item-description" name="item-description" placeholder="Item Description">
        <br />
        <label for="weight">Weight: </label>
        <select name="weight" id="weight">
            <option value="">Select Weight</option>
            <?php
            for ($i = 2; $i <= 20; $i += 2) {
                ?>
                <option value="weight-<?php echo $i; ?>"><?php echo $i . "kg"; ?></option>
            <?php } ?>
        </select>
    </fieldset>

    <fieldset>
        <legend>Pick-up Information</legend>
        <label for="pu-address">Address: </label>
        <input type="text" id="pu-address" name="pu-address" placeholder="Address">
        <br />
        <label for="pu-suburb">Suburb: </label>
        <input type="text" id="pu-suburb" name="pu-suburb" placeholder="Suburb">
        <br />
        <label for="date">Preferred date: </label>
        <select name="date" id="date" class="sm">
            <option value="">Date</option>
            <?php
            for ($i = 1; $i <= 31; $i++) {
                ?>
                <option value="date-<?php echo $i; ?>"><?php echo $i < 10 ? "0" . $i : $i;; ?></option>
            <?php } ?>
        </select>
        <span>/</span>
        <select name="month" id="month" class="sm">
            <option value="">Month</option>
            <?php
            $month = explode(" ", "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec");
            for ($i = 1; $i <= 12; $i++) {
                ?>
                <option value="month-<?php echo $i; ?>"><?php echo $month[$i - 1]; ?></option>
            <?php } ?>
        </select>
        <span>/</span>
        <select name="year" id="year" class="sm">
            <option value="">Year</option>
            <?php
            for ($i = 0; $i < 100; $i++) {
                ?>
                <option value="year-<?php echo $i; ?>"><?php echo date("Y") + $i; ?></option>
            <?php } ?>
        </select>
        <br />
        <label for="hour">Preferred time: </label>
        <select name="hour" id="hour" class="sm">
            <option value="">Hour</option>
            <?php
            for ($i = 0; $i < 24; $i++) {
                ?>
                <option value="hour-<?php echo $i; ?>"><?php echo $i < 10 ? "0" . $i : $i; ?></option>
            <?php } ?>
        </select>
        <span>:</span>
        <select name="minute" id="minute" class="sm">
            <option value="">Minute</option>
            <?php
            for ($i = 0; $i < 60; $i += 5) {
                ?>
                <option value="minute-<?php echo $i; ?>"><?php echo $i < 10 ? "0" . $i : $i; ?></option>
            <?php } ?>
        </select>
    </fieldset>

    <fieldset>
        <legend>Delivery Information</legend>
        <label for="recipient">Recipient Name: </label>
        <input type="text" id="recipient" name="recipient" placeholder="Recipient Name">
        <br>
        <label for="del-address">Address: </label>
        <input type="text" id="del-address" name="del-address" placeholder="Address">
        <br>
        <label for="del-suburb">Suburb: </label>
        <input type="text" id="del-suburb" name="del-suburb" placeholder="Suburb">
        <br>
        <label for="del-state">State: </label>

        <?php

        $conn = connectToDatabase($servername, $db, $username, $password);
        $sql = "SELECT * FROM State";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        ?>

        <select name="state" id="state">
            <option value="">Select State</option>
            <?php
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option value="<?php echo $result["StateCode"]; ?>"><?php echo $result["StateName"]; ?></option>
            <?php } ?>
        </select>
    </fieldset>

    <input type="submit" value="Request" name="submit">
</form>
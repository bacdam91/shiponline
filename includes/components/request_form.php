<?php
$sql = "SELECT * FROM State";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<form id="request_form" class="user-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <fieldset>
        <legend>Item Information</legend>
        <label for="item-description">Item Description: </label>
        <input type="text" id="item-description" name="item-description" placeholder="Item Description" value="<?php if (isset($_POST["item-description"])) {
                                                                                                                    echo $_POST["item-description"];
                                                                                                                } ?>" minlength="3" maxlength="50" pattern="<?php echo Pattern::ITEM_DESCRIPTION; ?>" required>
        <br />
        <label for="weight">Weight: </label>
        <select name="weight" id="weight" required>
            <option value="">Select Weight</option>
            <?php
            for ($i = 2; $i <= 20; $i += 2) {
                ?>
                <option value="<?php echo $i; ?>" <?php if (isset($_POST["weight"]) && $weight == $i) {
                                                            echo "selected";
                                                        } ?>><?php echo $i . "kg"; ?></option>
            <?php } ?>
        </select>
    </fieldset>

    <fieldset>
        <legend>Pick-up Information</legend>
        <label for="pu-address">Address: </label>
        <input type="text" id="pu-address" name="pu-address" placeholder="Address" value="<?php if (isset($_POST["pu-address"])) {
                                                                                                echo $_POST["pu-address"];
                                                                                            } ?>" pattern="<?php echo Pattern::ADDRESS; ?>" minlength="5" maxlength="50" required>
        <br />
        <label for="pu-suburb">Suburb: </label>
        <input type="text" id="pu-suburb" name="pu-suburb" placeholder="Suburb" value="<?php if (isset($_POST["pu-suburb"])) {
                                                                                            echo $_POST["pu-suburb"];
                                                                                        } ?>" pattern="<?php echo Pattern::SUBURB; ?>" minlength="3" maxlength="50" required>
        <br />
        <label for="pu-state">State: </label>
        <select name="pu-state" id="pu-state" required>
            <option value="">Select State</option>
            <?php
            foreach ($result as $r) {
                ?>
                <option value="<?php echo $r["StateCode"]; ?>" <?php if (isset($_POST["pu-state"]) && $r["StateCode"] == $_POST["pu-state"]) {
                                                                        echo "selected";
                                                                    } ?>><?php echo $r["StateName"]; ?></option>
            <?php } ?>
        </select>
        <br />
        <label for="date">Preferred date: </label>
        <select name="date" id="date" class="sm" required>
            <option value="">Date</option>
            <?php
            for ($i = 1; $i <= 31; $i++) {
                ?>
                <option value="<?php echo $i < 10 ? "0" . $i : $i; ?>" <?php if (isset($_POST["date"]) && $_POST["date"] == $i) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $i < 10 ? "0" . $i : $i; ?></option>
            <?php } ?>
        </select>
        <span>/</span>
        <select name="month" id="month" class="sm" required>
            <option value="">Month</option>
            <?php
            $month = explode(" ", "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec");
            for ($i = 1; $i <= 12; $i++) {
                ?>
                <option value="<?php echo $i < 10 ? "0" . $i : $i; ?>" <?php if (isset($_POST["month"]) && $_POST["month"] == $i) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $month[$i - 1]; ?></option>
            <?php } ?>
        </select>
        <span>/</span>
        <select name="year" id="year" class="sm" required>
            <option value="">Year</option>
            <?php
            for ($i = 0; $i < 100; $i++) {
                ?>
                <option value="<?php echo date("Y") + $i; ?>" <?php if (isset($_POST["year"]) && $_POST["year"] == (date("Y") + $i)) {
                                                                        echo "selected";
                                                                    } ?>><?php echo date("Y") + $i; ?></option>
            <?php } ?>
        </select>
        <br />
        <label for="hour">Preferred time: </label>
        <select name="hour" id="hour" class="sm" required>
            <option value="">Hour</option>
            <?php
            for ($i = 0; $i < 24; $i++) {
                ?>
                <option value="<?php echo $i < 10 ? "0" . $i : $i; ?>" <?php if (isset($_POST["hour"]) && $_POST["hour"] == $i) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $i < 10 ? "0" . $i : $i; ?></option>
            <?php } ?>
        </select>
        <span>:</span>
        <select name="minute" id="minute" class="sm" required>
            <option value="">Minute</option>
            <?php
            for ($i = 0; $i < 60; $i += 5) {
                ?>
                <option value="<?php echo $i < 10 ? "0" . $i : $i; ?>" <?php if (isset($_POST["minute"]) && $_POST["minute"] == $i) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $i < 10 ? "0" . $i : $i; ?></option>
            <?php } ?>
        </select>
    </fieldset>

    <fieldset>
        <legend>Delivery Information</legend>
        <label for="recipient">Recipient Name: </label>
        <input type="text" id="recipient" name="recipient" placeholder="Recipient Name" value="<?php if (isset($_POST["recipient"])) {
                                                                                                    echo $_POST["recipient"];
                                                                                                } ?>" pattern="<?php echo Pattern::NAME; ?>" minlength="3" maxlength="50" required>
        <br>
        <label for="del-address">Address: </label>
        <input type="text" id="del-address" name="del-address" placeholder="Address" value="<?php if (isset($_POST["del-address"])) {
                                                                                                echo $_POST["del-address"];
                                                                                            } ?>" pattern="<? echo Pattern::ADDRESS ?>">
        <br>
        <label for="del-suburb">Suburb: </label>
        <input type="text" id="del-suburb" name="del-suburb" placeholder="Suburb" value="<?php if (isset($_POST["del-suburb"])) {
                                                                                                echo $_POST["del-suburb"];
                                                                                            } ?>" pattern="<?php echo Pattern::SUBURB; ?>" minlength="3" maxlength="50" required>
        <br>
        <label for="del-state">State: </label>
        <select name="del-state" id="del-state" required>
            <option value="">Select State</option>
            <?php
            foreach ($result as $r) {
                ?>
                <option value="<?php echo $r["StateCode"]; ?>" <?php if (isset($_POST["del-state"]) && $r["StateCode"] == $_POST["del-state"]) {
                                                                        echo "selected";
                                                                    } ?>><?php echo $r["StateName"]; ?></option>
            <?php } ?>
        </select>
    </fieldset>

    <input type="submit" value="Request" name="submit">
</form>
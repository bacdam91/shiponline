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
        <input type="text" id="item-description" name="item-description" placeholder="Item Description" value="<?php if (isset($itemDescription)) {
                                                                                                                    echo $itemDescription;
                                                                                                                } ?>" minlength="3" maxlength="50" pattern="<?php echo Pattern::ITEM_DESCRIPTION; ?>" required>
        <br />
        <label for="weight">Weight: </label>
        <select name="weight" id="weight">
            <option value="">Select Weight</option>
            <?php
            for ($i = 2; $i <= 20; $i += 2) {
                ?>
                <option value="<?php echo $i; ?>"><?php echo $i . "kg"; ?></option>
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
        <label for="pu-state">State: </label>
        <select name="pu-state" id="pu-state">
            <option value="">Select State</option>
            <?php
            foreach ($result as $r) {
                ?>
                <option value="<?php echo $r["StateCode"]; ?>"><?php echo $r["StateName"]; ?></option>
            <?php } ?>
        </select>
        <br />
        <label for="date">Preferred date: </label>
        <select name="date" id="date" class="sm">
            <option value="">Date</option>
            <?php
            for ($i = 1; $i <= 31; $i++) {
                ?>
                <option value="<?php echo $i < 10 ? "0" . $i : $i; ?>"><?php echo $i < 10 ? "0" . $i : $i; ?></option>
            <?php } ?>
        </select>
        <span>/</span>
        <select name="month" id="month" class="sm">
            <option value="">Month</option>
            <?php
            $month = explode(" ", "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec");
            for ($i = 1; $i <= 12; $i++) {
                ?>
                <option value="<?php echo $i < 10 ? "0" . $i : $i; ?>"><?php echo $month[$i - 1]; ?></option>
            <?php } ?>
        </select>
        <span>/</span>
        <select name="year" id="year" class="sm">
            <option value="">Year</option>
            <?php
            for ($i = 0; $i < 100; $i++) {
                ?>
                <option value="<?php echo date("Y") + $i; ?>"><?php echo date("Y") + $i; ?></option>
            <?php } ?>
        </select>
        <br />
        <label for="hour">Preferred time: </label>
        <select name="hour" id="hour" class="sm">
            <option value="">Hour</option>
            <?php
            for ($i = 0; $i < 24; $i++) {
                ?>
                <option value="<?php echo $i < 10 ? "0" . $i : $i; ?>"><?php echo $i < 10 ? "0" . $i : $i; ?></option>
            <?php } ?>
        </select>
        <span>:</span>
        <select name="minute" id="minute" class="sm">
            <option value="">Minute</option>
            <?php
            for ($i = 0; $i < 60; $i += 5) {
                ?>
                <option value="<?php echo $i < 10 ? "0" . $i : $i; ?>"><?php echo $i < 10 ? "0" . $i : $i; ?></option>
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
        <select name="del-state" id="del-state">
            <option value="">Select State</option>
            <?php
            foreach ($result as $r) {
                ?>
                <option value="<?php echo $r["StateCode"]; ?>"><?php echo $r["StateName"]; ?></option>
            <?php } ?>
        </select>
    </fieldset>

    <input type="submit" value="Request" name="submit">
</form>
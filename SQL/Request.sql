CREATE TABLE Request (
    RequestNumber INT UNSIGNED NOT NULL AUTO_INCREMENT,
    RequestDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PreferredPickUpDate TIMESTAMP NOT NULL,
    ItemDescription VARCHAR(255) NOT NULL,
    Weight DECIMAL(5,2) NOT NULL,
    PickUpAddress VARCHAR(255) NOT NULL,
    PickUpSuburb VARCHAR(255) NOT NULL,
    PickUpStateCode VARCHAR(3) NOT NULL,
    Recipient VARCHAR(50),
    DeliveryAddress VARCHAR(255) NOT NULL,
    DeliverySuburb VARCHAR(50) NOT NULL,
    DeliveryStateCode VARCHAR(3) NOT NULL,
    CustomerId INT UNSIGNED NOT NULL,
    PRIMARY KEY (RequestNumber),
    FOREIGN KEY (CustomerId) 
        REFERENCES Customer(CustomerId)
        ON UPDATE CASCADE 
        ON DELETE CASCADE,
    FOREIGN KEY (PickUpStateCode) REFERENCES State(StateCode)
        ON UPDATE CASCADE 
        ON DELETE RESTRICT,
    FOREIGN KEY (DeliveryStateCode) REFERENCES State(StateCode)
        ON UPDATE CASCADE 
        ON DELETE RESTRICT
);
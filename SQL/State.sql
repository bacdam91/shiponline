CREATE TABLE State (
    StateCode VARCHAR(3) NOT NULL,
    StateName VARCHAR(50) NOT NULL,
    PRIMARY KEY (StateCode)
);

INSERT INTO State VALUES 
    ("VIC", "Victoria"),
    ("NSW", "New South Wales"),
    ("NT", "Northern Territory"),
    ("SA", "South Australia"),
    ("QLD", "Queensland"), 
    ("WA", "Western Australia"), 
    ("TAS", "Tasmania"), 
    ("ACT", "Australian Capital Territory");
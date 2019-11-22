<?php

abstract class Pattern
{
    const NAME = "[a-zA-Z\ -']{3,50}";
    const PASSWORD = "(?=.+[a-z])(?=.+[A-Z])(?=.+[0-9])(?=.+[\!\@\#\$\%\&])[a-zA-Z0-9\!\@\#\$\%\&]{10,50}";
    const PHONE = "0[0-9]{9}";
    const ITEM_DESCRIPTION = "[a-zA-Z0-9\ \-\'\.\,\!]{3,50}";
}

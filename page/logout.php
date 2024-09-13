<?php

session_regenerate_id();
unset($_SESSION["userUID"]);

header("Location: /login");

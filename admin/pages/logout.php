<?php
unset($_SESSION['id_admin']);
unset($_SESSION['is_admin_login']);
unset($_SESSION['admin_login']);
redirect("?page=login");

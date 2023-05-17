<?php
{
    protected $con = null;


    public function __construct()
    {
        $host = "localhost";
        $user = "root";
        $password = "root";
        $dbname = "scandiweb";
        $this->con = mysqli_connect($host, $user, $password, $dbname);
        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

}

?>

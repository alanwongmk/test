<?php

# General Comments
# 1. Is is better to split each individual class into approprite file in filesystem, instead of having all classes saved in file single file
# 2. We either 'require'  this file, or use of __autoload function to require these file as require
# 3. This file will be easy managed when grow into significate size
# 4. No appropriate comment for each class and function

# 5. Assume we should use the the same database storage
# 6. During testing create all tables using InnnoDB storage engine


// Alan :
# Based class : baseObj should be defined as 'abstract' class

class baseObj
{
    public $mysql = null;
    //private $table = null;
    protected $table = null;
    #alan
    #should define the table property as protected

    public function __construct ()
    {
        //$this->mysql = new mysqli("localhost", "user", "password", "database");
        $this->mysql = new mysqli("localhost", "root", "", "property");

        # Hardcoding of database related into, should be stored in some kind of configuration file instead.
        # This is especially the case for handling of development, testing and production servers
        # For the purpose of testing, changed above database attributes deemed appropriated.
        
        if ($this->mysql->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->mysql->connect_errno . ") " . $this->mysql->connect_error;
        }
    }

    public function get ($id, $field)
    {
        return $this->mysql->query("SELECT $field FROM $table WHERE ID = $id");
    }

    public function getAll ($id)
    {
        //$res = $this->mysql->query("SELECT * FROM $table WHERE ID = $id");
        $res = $this->mysql->query("SELECT * FROM $this->table WHERE ID = $id");
        # should be $this->table;
        
        
        return $res->fetch_assoc();
    }
}

class propertyData extends baseObj
{
    public $id = null;
    public $type = null;
    public $title = null;
    public $address = null;
    public $bedroom = null;
    public $livingroom = null;
    public $diningroom = null;
    protected $hdbblock = null;
    private $swimmingPool = null;

    //private $table = 'Property';
    protected $table = 'Property';
    //Should define this attribute as protected ?????

    public function getType ($ID) { $Type = $this->get( $ID, 'Type'); return $Type; }
    public function getTitle ($ID) { $Title = $this->get( $ID, 'Title') ; return $Type;}
    public function getAddress ($ID) { $Address = $this->get( $ID, 'Address') ; return $Address;}
    public function getBedroom ($ID) { $Bedroom = $this->get( $ID, 'Bedroom') ; return $Bedroom;}
    public function getLivingroom ($ID) { $livingroom = $this->get( $ID, 'Living_room') ; return $livingroom;}
    public function getDiningroom ($ID) { $diningroom = $this->get( $ID, 'Diningroom') ; return $diningroom;}
}

class hdbData extends propertyData
{
    ##private $table = 'HDB';
    #this is not required, since already difined in base class : baseObj;
    #Created a constructor to set the table appropriately
    public function __construct()
    {
        #need to involve the base class constructor
        parent::__construct();
        $this->table = 'HDB';
    }
    
    
    public function getHDBBlock ($ID)
    {
        $this->hdbblock = $this->get($ID, 'HDBBlock');
        return $this->hdbblock;
    }
}

class condoData extends propertyData
{
    //private $table = 'ConDO';
    #this is not required, since already difined in base class : baseObj;
    #Created a constructor to set the table appropriately

    public function __construct()
    {
        $this->table = 'ConDO';
    }
    
    public function gotSwimmingPool ($ID)
    {
        return $this->get($ID, 'SwimmingPool');
    }
}


?>
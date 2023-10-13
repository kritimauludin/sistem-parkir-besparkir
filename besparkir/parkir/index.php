<?php

class Constants
{
    static $DB_SERVER="localhost";
    static $DB_NAME="db_parkir";//parkir
    static $USERNAME="root";
    static $PASSWORD="";

    static $SQL_SELECT_ALL="SELECT * FROM tb_daftar_parkir";

}

class Spacecrafts
{
    /*******************************************************************************************************************************************/
    /*
       1. KONEKSIKAN KEDATABASE.
       2. KEMBALIKAN OBJECT.
    */
    public function connect()
    {
        $con=new mysqli(Constants::$DB_SERVER,Constants::$USERNAME,Constants::$PASSWORD,Constants::$DB_NAME);
        if($con->connect_error)
        {
            return null;
        }else
        {
            return $con;
        }
    }
    public function select()
    {
        $con=$this->connect();
        if($con != null)
        {
            $result=$con->query(Constants::$SQL_SELECT_ALL);
            if($result->num_rows>0)
            {
                $spacecrafts=array();
                while($row=$result->fetch_array())
                {
                    array_push($spacecrafts, array
                    (//"id"=>$row['id'],
                    "kode"=>$row['kode'],
                    "plat"=>$row['plat_nomor'],
                    "jam_masuk"=>$row['jam_masuk'], 
                    "tanggal"=>$row['tanggal'],     
                    /*"jam_keluar"=>$row['jam_keluar'],              
                    "tempat_parkir"=>$row['tempat_parkir'], */
                    "total_bayar"=>$row['total'],
                    //"image_url"=>$row['image_url'],
                    "status_parkir"=>$row['status']));
                }
                print(json_encode(array_reverse($spacecrafts)));
            }else
            {
                print(json_encode(array("PHP EXCEPTION : CAN'T RETRIEVE FROM MYSQL. ")));
            }
            $con->close();

        }else{
            print(json_encode(array("PHP EXCEPTION : CAN'T CONNECT TO MYSQL. NULL CONNECTION.")));
        }
    }
}
$spacecrafts=new Spacecrafts();
$spacecrafts->select();

//end

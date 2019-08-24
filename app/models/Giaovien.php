<?php

 /**
  * Admin Class
  * Admin Class inherits from User.
  *
  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
  * @author     Omar El Gabry <omar.elgabry.93@gmail.com>
  */

class Giaovien extends Model{

    /**
     * get all users in the database
     *
     * @access public
     * @param  string  $name
     * @param  string  $email
     * @param  string  $role
     * @param  integer $pageNum
     * @return array
     *
     */
    public function getGiaovien($name = null, $ngaySinh = null, $diaChi = null, $pageNum = 1){

        // validate user inputs
        $validation = new Validation();
        if(!$validation->validate([
            'User Name' => [$name,  'maxLen(30)'],
            'Ngay Sinh'     => [$ngaySinh, 'maxLen(10)'],
            'Dia Chi'      => [$diaChi,  'maxLen(20)']])){
            $this->errors  = $validation->errors();
            return false;
        }

        // in $options array, add all possible values from user, and their name parameters
        // then applyOptions() method will see if value is not empty, then add it to our query
        $options = [
            $name      => "ten LIKE :name ",
            $ngaySinh     => "ngaysinh LIKE :ngaysinh ",
            $diaChi      => "diachi = :diachi "
        ];

        // get options query
        $options = $this->applyOptions($options, "AND ");
        $options = empty($options)? "": "WHERE " . $options;

        $values = [];
        if (!empty($name))  $values[":name"]  = "%". $name ."%";
		if (!empty($ngaySinh)) $values[":ngaysinh"] = "%".$ngaySinh."%";
        if (!empty($diaChi))  $values[":diachi"]  = $diaChi;

        // get pagination object so that we can add offset and limit in our query
        $pagination = Pagination::pagination("giaovien", $options, $values, $pageNum);
        $offset     = $pagination->getOffset();
        $limit      = $pagination->perPage;

        $database   = Database::openConnection();
        $query   = "SELECT id, ten, ngaysinh, diachi FROM giaovien ";
        $query  .= $options;
        $query  .= "LIMIT $limit OFFSET $offset";

        $database->prepare($query);
        $database->execute($values);
        $giaovien = $database->fetchAllAssociative();

        return array("giaovien" => $giaovien, "pagination" => $pagination);
     }

    public function createGiaovien($content,$ngaySinh,$diaChi){

        $database = Database::openConnection();
        $query    = "INSERT INTO giaovien (ten, ngaysinh, diachi) VALUES (:ten,:ngaysinh,:diachi)";
        $database->prepare($query);
        $database->bindValue(':ten', $content);
		$database->bindValue(':ngaysinh', $ngaySinh);
		$database->bindValue(':diachi', $diaChi);
        $database->execute();

        if($database->countRows() !== 1){
            throw new Exception("Couldn't create Giao vien");
        }

        return true;
	}

    public function getGiaovienID($Id){

		$database = Database::openConnection();
        $database->getById("giaovien", $Id);

        if($database->countRows() !== 1){
            throw new Exception("Giao vien ID " .  $Id . " doesn't exists");
        }

        $id = $database->fetchAssociative();
        $id["id"]    = (int)$id["id"];
        return $id;
	}

    public function updateGiaovien($sinhvienId,$name,$ngaySinh,$diaChi){

        $validation = new Validation();
        if(!$validation->validate([
             "ten" => [$name, "minLen(4)|maxLen(30)"]
			])){
             $this->errors = $validation->errors();
             return false;
         }

         if($name){

             $options = [
                 $name     => "ten = :name ",
                 $ngaySinh => "ngaysinh = :ngaysinh ",
                 $diaChi     => "diachi = :diachi "
             ];

             $database = Database::openConnection();
             $query   = "UPDATE giaovien SET ";
             $query  .= $this->applyOptions($options, ", ");
             $query  .= "WHERE id = :id LIMIT 1 ";
             $database->prepare($query);

             if($name) {
                 $database->bindValue(':name', $name);
             }
			 if($ngaySinh) {
                 $database->bindValue(':ngaysinh', $ngaySinh);
             }
			 if($diaChi) {
                 $database->bindValue(':diachi', $diaChi);
             }
             $database->bindValue(':id', $sinhvienId);
             $result = $database->execute();
             if(!$result){
                 throw new Exception("Couldn't update giao vien");
             }
         }

         return true;
     }

    /**
     *  Update info of a passed user id
     *
     * @access public
     * @param  integer $userId
     * @param  integer $adminId
     * @param  string  $name
     * @param  string  $password
     * @param  string  $role
     * @return bool
     * @throws Exception If password couldn't be updated
     *
     */
   
    /**
     * Delete a user.
     *
     * @param  string  $adminId
     * @param  integer $userId
     * @throws Exception
     */
    public function deleteGiaovien($userId){

        $database = Database::openConnection();
        $database->deleteById("giaovien", $userId);

        if ($database->countRows() !== 1) {
            throw new Exception ("Couldn't delete user");
        }
    }

     /**
      * Counting the number of users in the database.
      *
      * @access public
      * @static static  method
      * @return integer number of users
      *
      */
    public function countUsers(){

         return $this->countAll("giaovien");
     }

    public function getUsersData(){

        $database = Database::openConnection();

        $database->prepare("SELECT ten, ngaysinh, diachi FROM giaovien");
        $database->execute();

        $users = $database->fetchAllAssociative();
        $cols  = array("Name", "Ngày Sinh", "Địa Chỉ");

        return ["rows" => $users, "cols" => $cols, "filename" => "giaovien"];
    }
     /**
      * Get the backup file from the backup directory in file system
      *
      * @access public
      * @return array
      */
    
    /**
     * get users data.
     * Use this method to download users info in database as csv file.
     *
     * @access public
     * @return array
     */
   

 }
   
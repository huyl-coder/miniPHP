<?php

 /**
  * Admin Class
  * Admin Class inherits from User.
  *
  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
  * @author     Omar El Gabry <omar.elgabry.93@gmail.com>
  */

class Sinhvien extends Model{

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
    public function getSinhvien($name = null, $ngaySinh = null, $diaChi = null, $pageNum = 1){

        // validate user inputs
        $validation = new Validation();
        if(!$validation->validate([
            'User Name' => [$name,  'maxLen(30)'],
            'Ngay Sinh'     => [$ngaySinh, 'maxLen(10)'],
            'Dia Chi'      => [$diaChi,  'maxLen(30)']])){
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
        $pagination = Pagination::pagination("sinhvien", $options, $values, $pageNum);
        $offset     = $pagination->getOffset();
        $limit      = $pagination->perPage;

        $database   = Database::openConnection();
        $query   = "SELECT id, ten, ngaysinh, diachi FROM sinhvien ";
        $query  .= $options;
        $query  .= "LIMIT $limit OFFSET $offset";

        $database->prepare($query);
        $database->execute($values);
        $sinhvien = $database->fetchAllAssociative();

        return array("users" => $sinhvien, "pagination" => $pagination);
     }

    public function createSinhvien($content,$ngaySinh,$diaChi){

        $database = Database::openConnection();
        $query    = "INSERT INTO sinhvien (ten, ngaysinh, diachi) VALUES (:ten,:ngaysinh,:diachi)";
        $database->prepare($query);
        $database->bindValue(':ten', $content);
		$database->bindValue(':ngaysinh', $ngaySinh);
		$database->bindValue(':diachi', $diaChi);
        $database->execute();

        if($database->countRows() !== 1){
            throw new Exception("Couldn't create sinh vien");
        }

        return true;
	}

    public function getSinhvienID($Id){

		$database = Database::openConnection();
        $database->getById("sinhvien", $Id);

        if($database->countRows() !== 1){
            throw new Exception("Sinh vien ID " .  $Id . " doesn't exists");
        }

        $id = $database->fetchAssociative();
        $id["id"]    = (int)$id["id"];
        return $id;
	}

    public function updateSinhvien($sinhvienId,$name,$ngaySinh,$diaChi){

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
             $query   = "UPDATE sinhvien SET ";
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
                 throw new Exception("Couldn't update sinh vien");
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
    public function deleteSinhvien($userId){

        $database = Database::openConnection();
        $database->deleteById("sinhvien", $userId);

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

         return $this->countAll("sinhvien");
     }

    public function getUsersData(){

        $database = Database::openConnection();

        $database->prepare("SELECT ten, ngaysinh, diachi FROM sinhvien");
        $database->execute();

        $users = $database->fetchAllAssociative();
        $cols  = array("Name", "Ngày Sinh", "Nơi Sinh");

        return ["rows" => $users, "cols" => $cols, "filename" => "sinhvien"];
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
   
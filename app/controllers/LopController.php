<?php

/**
 * The admin controller
 *
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author     Omar El Gabry <omar.elgabry.93@gmail.com>
 *
 */

class LopController extends Controller {

    /**
     * A method that will be triggered before calling action method.
     * Any changes here will reflect then on Controller::triggerComponents() method
     *
     */
    public function beforeAction(){

        parent::beforeAction();

		$action = $this->request->param('action');
        $actions = ['getLop', 'createLop', 'updateLop', 'addSV', 'xoaSV', 'deleteLop'];

        // define the action methods that needs to be triggered only through POST & Ajax request.
        $this->Security->requireAjax($actions);
        $this->Security->requirePost($actions);

        // You need to explicitly define the form fields that you expect to be returned in POST request,
        // if form field wasn't defined, this will detected as form tampering attempt.
        switch($action){
            case "getLop":
                $this->Security->config("form", [ 'fields' => ['name', 'giaovien', 'sinhvien', 'page']]);
                break;
			case "createLop":
                $this->Security->config("form", [ 'fields' => ['name', 'giaovien']]);
                break;
			 case "updateLop":
                $this->Security->config("form", [ 'fields' => ['user_id', 'name', 'giaovien']]);
                break;
			case "addSV":
                $this->Security->config("form", [ 'fields' => ['user_id', 'name']]);
                break;
			case "xoaSV":
                $this->Security->config("form", [ 'fields' => ['user_id', 'name']]);
                break;
            case "deleteLop":
                $this->Security->config("form", [ 'fields' => ['lop_id']]);
                break;
        }
    }

    /**
     * show all users
     *
     */
    public function index(){

        Config::setJsConfig('curPage', "lop");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'lop/index.php');
    }

    /**
     * get users by name, email & role
     *
     */
    public function getLop(){

        $name     = $this->request->data("name");
		$giaoVien  = $this->request->data("giaovien");
		$sinhVien  = $this->request->data("sinhvien");
        $pageNum  = $this->request->data("page");
        $usersData = $this->lop->getLop($name, $giaoVien, $sinhVien, $pageNum);

        if(!$usersData){
            $this->view->renderErrors($this->lop->errors());
        } else{

            $usersHTML       = $this->view->render(Config::get('VIEWS_PATH') . 'lop/lop.php', array("giaovien" => $usersData["giaovien"]));
            $paginationHTML  = $this->view->render(Config::get('VIEWS_PATH') . 'pagination/default.php', array("pagination" => $usersData["pagination"]));
            $this->view->renderJson(array("data" => ["giaovien" => $usersHTML, "pagination" => $paginationHTML]));
        }
    }

    /**
     * view a user
     *
     * @param integer|string $userId
     */
   
    /**
     * delete a user
     *
     */
    public function addSinhvien($userId=0){

		$userId = Encryption::decryptId($userId);
		Config::setJsConfig('curPage', "lop");
		Config::setJsConfig('lopId', Encryption::encryptId($userId));
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'lop/addSinhvien.php');
	}

    public function deleteSinhvien($userId=0){

		$userId = Encryption::decryptId($userId);
        Config::setJsConfig('curPage', "lop");
        Config::setJsConfig('sinhvienId', Encryption::encryptId($userId));

        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'lop/deleteSinhvien.php', array("sinhvienId" => $userId));
	}

    public function deleteLop(){

        $userId = Encryption::decryptIdWithDash($this->request->data("lop_id"));
        $this->lop->deleteLop($userId);
        $this->view->renderJson(array("success" => true));
    }

    public function add(){

		Config::setJsConfig('curPage', "lop");
		$this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'lop/create.php');
	}

    public function createLop(){

		$content  = $this->request->data("name");
		$giaoVien  = $this->request->data("giaovien");
		$lop = $this->lop->createLop($content, $giaoVien);
		$this->index();
	}
    /**
     * view backups if exist
     *
     */
    public function viewLop($userId = 0){

        $userId = Encryption::decryptId($userId);
        Config::setJsConfig('curPage', "lop");
        Config::setJsConfig('lopId', Encryption::encryptId($userId));

        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'lop/viewLop.php', array("lopId" => $userId));
    }

    public function updateLop(){

        $sinhvienId     = Encryption::decryptId($this->request->data("user_id"));
        $name       = $this->request->data("name");
		$giaoVien       = $this->request->data("giaovien");
        $result = $this->lop->updateLop($sinhvienId, $name, $giaoVien);

        if(!$result){
            $this->view->renderErrors($this->lop->errors());
        }else{
			$this->view->renderSuccess("Table Lop has been updated.");
        }
    }

    public function addSV(){

        $sinhvienId     = Encryption::decryptId($this->request->data("user_id"));
        $name       = $this->request->data("name");
		$show=$this->lop->showSV($sinhvienId);
		foreach($show as $value){
			if($value["idsinhvien"]==$name){
				echo $this->view->renderErrors('Student already exists');
				exit;
			}
		}
        $result = $this->lop->addSV($sinhvienId, $name);
        if(!$result){
            $this->view->renderErrors($this->lop->errors());
        }else{
			$this->view->renderSuccess("Add students to class.");
        }
    }

    public function xoaSV(){

        $sinhvienId     = Encryption::decryptId($this->request->data("user_id"));
		$name       = $this->request->data("name");
        $result = $this->lop->xoaSV($sinhvienId, $name);
        if(!$result){
            $this->view->renderErrors($this->lop->errors());
        }else{
			$this->view->renderSuccess("Deleted students from class.");
        }
    }

    public function isAuthorized(){

        $action = $this->request->param('action');
        $role = Session::getUserRole();
        $resource = "giaovien";

        // only for admins
        Permission::allow('admin', $resource, ['*']);

        // only for normal users
        Permission::allow('user', $resource, ['index', 'getLop']);

        $todoId = $this->request->data("giaovien_id");

        if(!empty($todoId)){
            $todoId = Encryption::decryptIdWithDash($todoId);
        }

        $config = [
            "table" => "giaovien",
            "id" => $todoId];

        return Permission::check($role, $resource, $action, $config);
    }

 }

<?php

/**
 * The admin controller
 *
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author     Omar El Gabry <omar.elgabry.93@gmail.com>
 *
 */

class SinhvienController extends Controller {

    /**
     * A method that will be triggered before calling action method.
     * Any changes here will reflect then on Controller::triggerComponents() method
     *
     */
    public function beforeAction(){

        parent::beforeAction();

		$action = $this->request->param('action');
        $actions = ['getSinhvien', 'createSinhvien', 'updateSinhvien', 'deleteSinhvien'];

        // define the action methods that needs to be triggered only through POST & Ajax request.
        $this->Security->requireAjax($actions);
        $this->Security->requirePost($actions);

        // You need to explicitly define the form fields that you expect to be returned in POST request,
        // if form field wasn't defined, this will detected as form tampering attempt.
        switch($action){
            case "getSinhvien":
                $this->Security->config("form", [ 'fields' => ['name', 'ngaysinh', 'diachi', 'page']]);
                break;
			case "createSinhvien":
                $this->Security->config("form", [ 'fields' => ['name', 'ngaysinh', 'diachi']]);
                break;
			 case "updateSinhvien":
                $this->Security->config("form", [ 'fields' => ['user_id', 'name', 'ngaysinh', 'diachi']]);
                break;
            case "deleteSinhvien":
                $this->Security->config("form", [ 'fields' => ['sinhvien_id']]);
                break;
        }
    }

    /**
     * show all users
     *
     */
    public function index(){

        Config::setJsConfig('curPage', "sinhvien");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'sinhvien/index.php');
    }

    /**
     * get users by name, email & role
     *
     */
    public function getSinhvien(){

        $name     = $this->request->data("name");
		$ngaySinh  = $this->request->data("ngaysinh");
		$diaChi    = $this->request->data("diachi");
        $pageNum  = $this->request->data("page");
        $usersData = $this->sinhvien->getSinhvien($name, $ngaySinh, $diaChi, $pageNum);

        if(!$usersData){
            $this->view->renderErrors($this->sinhvien->errors());
        } else{

            $usersHTML       = $this->view->render(Config::get('VIEWS_PATH') . 'sinhvien/sinhvien.php', array("sinhvien" => $usersData["users"]));
            $paginationHTML  = $this->view->render(Config::get('VIEWS_PATH') . 'pagination/default.php', array("pagination" => $usersData["pagination"]));
            $this->view->renderJson(array("data" => ["sinhvien" => $usersHTML, "pagination" => $paginationHTML]));
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
    public function deleteSinhvien(){

        $userId = Encryption::decryptIdWithDash($this->request->data("sinhvien_id"));
        $this->sinhvien->deleteSinhvien($userId);
        $this->view->renderJson(array("success" => true));
    }

    public function add(){

		Config::setJsConfig('curPage', "sinhvien");
		$this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'sinhvien/create.php');
	}

    public function createSinhvien(){

		$content  = $this->request->data("name");
		$ngaySinh  = $this->request->data("ngaysinh");
		$diaChi  = $this->request->data("diachi");
		$sinhvien = $this->sinhvien->createSinhvien($content, $ngaySinh, $diaChi);
		if(!$sinhvien){
            $this->view->renderErrors($this->sinhvien->errors());
        }else{
			$this->index();
        }
	}
    /**
     * view backups if exist
     *
     */
    public function viewSinhvien($userId = 0){

        $userId = Encryption::decryptId($userId);
        Config::setJsConfig('curPage', "sinhvien");
        Config::setJsConfig('sinhvienId', Encryption::encryptId($userId));

        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'sinhvien/viewSinhvien.php', array("sinhvienId" => $userId));
    }

    public function updateSinhvien(){

        $sinhvienId     = Encryption::decryptId($this->request->data("user_id"));
        $name       = $this->request->data("name");
		$ngaySinh       = $this->request->data("ngaysinh");
		$diaChi       = $this->request->data("diachi");
        $result = $this->sinhvien->updateSinhvien($sinhvienId, $name, $ngaySinh, $diaChi);

        if(!$result){
            $this->view->renderErrors($this->sinhvien->errors());
        }else{
			$this->view->renderSuccess("Table Sinh Vien has been updated.");
        }
    }

    public function isAuthorized(){

        $action = $this->request->param('action');
        $role = Session::getUserRole();
        $resource = "sinhvien";

        // only for admins
        Permission::allow('admin', $resource, ['*']);

        // only for normal users
        Permission::allow('user', $resource, ['index', 'getSinhvien']);

        $todoId = $this->request->data("sinhvien_id");

        if(!empty($todoId)){
            $todoId = Encryption::decryptIdWithDash($todoId);
        }

        $config = [
            "table" => "sinhvien",
            "id" => $todoId
		];

        return Permission::check($role, $resource, $action, $config);
    }

 }

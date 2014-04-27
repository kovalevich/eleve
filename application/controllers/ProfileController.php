<?php

class ProfileController extends Zend_Controller_Action
{

    private $_user;

    public function init()
    {
        $this->_user = Zend_Registry::get('user');
        if (!$this->_user) {
            $this->_helper->redirector('index', 'index');
        }
    }

    public function indexAction()
    {
        if ($this->_user->id) {

            $form = new Application_Form_Profile();
            $mapper = new Models_Users_Mapper();

            if ($this->_request->isPost() && $form->isValid($this->_request->getPost())){
                $mapper->getRow($this->_user->id);
                if (!empty($form->images)) {
                    $mapper_images = new Models_Images_Mapper();
                    $mapper_images->loadImages($form->images, $this->_user->id);
                }
                $mapper->fill($form->getValues());
                $mapper->save();
            }

            $profile = $mapper->getUser($this->_user->id);
            $mapper_images = new Models_Images_Mapper();
            $profile->photos = $mapper_images->getImages($profile->id);
            $form->populate($profile->_toArray());

            $this->view->form = $form;
            $this->view->profile = $profile;
        }
    }

    public function deleteimageAction()
    {
        if ($this->_user->id) {
            $id = $this->_request->getParam('id');
            if ($id) {
                $mapper = new Models_Images_Mapper();
                $mapper->delete($id);
            }
        }
    }

    public function addimageAction()
    {
        $this->_helper->layout()->disableLayout();
        if ($this->_user->id) {

            define ("MAX_SIZE","9000");


            $valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
            if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
            {

                $uploaddir = "uploads/"; //a directory inside
                foreach ($_FILES['photos']['name'] as $name => $value)
                {

                    $filename = stripslashes($_FILES['photos']['name'][$name]);
                    $size=filesize($_FILES['photos']['tmp_name'][$name]);
                    //get the extension of the file in a lower case format
                    $ext = 'jpg';
                    $ext = strtolower($ext);

                    if(in_array($ext,$valid_formats))
                    {
                        if ($size < (MAX_SIZE*1024))
                        {
                            $image_name=time().$filename;
                            echo "<img src='".$uploaddir.$image_name."' class='imgList'>";
                            $newname=$uploaddir.$image_name;

                            if (move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname))
                            {
                                $time=time();
                                //mysql_query("INSERT INTO user_uploads(image_name,user_id_fk,created) VALUES('$image_name','$session_id','$time')");
                            }
                            else
                            {
                                echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>';
                            }

                        }
                        else
                        {
                            echo '<span class="imgList">You have exceeded the size limit!</span>';

                        }

                    }
                    else
                    {
                        echo '<span class="imgList">Unknown extension!</span>';

                    }

                }
            }

        }
    }

}
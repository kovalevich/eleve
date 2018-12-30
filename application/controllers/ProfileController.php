<?php

class ProfileController extends Zend_Controller_Action
{

    private $_user, $_config;

    public function init()
    {
        $this->_config = Zend_Registry::get('_config')->my;
        $mapper = new Models_Users_Mapper();
        $this->_user = $mapper->getRow($this->getParam('id'));
        $login_user = Zend_Registry::get('user');
        if (!$this->_user->id || ($this->_user->id != $login_user->id && $this->_user->role == 'admin')) {
            $this->redirect('/news');
        }
        $this->view->user = $this->_user;
    }

    public function indexAction()
    {
        if ($this->_user->id) {

            $form = new Application_Form_Profile();
            $form->setAction('/profile/'.$this->_user->id);
            $mapper = new Models_Users_Mapper($this->_user->id);
            if($this->getParam('public_id') && $this->getParam('public_id') !== $mapper->public_id) {
                if(!$mapper->checkId($this->getParam('public_id'))) {
                    $mapper->public_id = $this->getParam('public_id');
                    $mapper->save();
                }
            }
            if ($this->_request->isPost() && $form->isValid($this->_request->getPost())){
                if (!empty($form->images)) {
                    $mapper_images = new Models_Images_Mapper();
                    $mapper_images->loadImages($form->images, $this->_user->id);
                }
                $mapper->fill($form->getValues());
                $mapper->goal_1 = $form->goal_1->getValue() ? 1 : 0;
                $mapper->goal_2 = $form->goal_2->getValue() ? 1 : 0;
                $mapper->goal_3 = $form->goal_3->getValue() ? 1 : 0;
                $mapper->goal_4 = $form->goal_4->getValue() ? 1 : 0;
                $mapper->goal_5 = $form->goal_5->getValue() ? 1 : 0;
                $mapper->goal_6 = $form->goal_6->getValue() ? 1 : 0;
                $mapper->goal_7 = $form->goal_7->getValue() ? 1 : 0;
                $mapper->goal_8 = $form->goal_8->getValue() ? 1 : 0;
                $mapper->goal_9 = $form->goal_9->getValue() ? 1 : 0;
                $mapper->goal_10 = $form->goal_10->getValue() ? 1 : 0;
                $mapper->goal_11 = $form->goal_11->getValue() ? 1 : 0;

                $mapper->prof_1 = $form->prof_1->getValue() ? 1 : 0;
                $mapper->prof_2 = $form->prof_2->getValue() ? 1 : 0;
                $mapper->prof_3 = $form->prof_3->getValue() ? 1 : 0;
                $mapper->prof_4 = $form->prof_4->getValue() ? 1 : 0;
                $mapper->prof_5 = $form->prof_5->getValue() ? 1 : 0;
                $mapper->prof_6 = $form->prof_6->getValue() ? 1 : 0;
                $mapper->prof_7 = $form->prof_7->getValue() ? 1 : 0;
                $mapper->prof_8 = $form->prof_8->getValue() ? 1 : 0;
                $mapper->prof_9 = $form->prof_9->getValue() ? 1 : 0;
                $mapper->prof_10 = $form->prof_10->getValue() ? 1 : 0;

                if($form->date_brit->getValue()){
                    $mapper->date_brit = date('Y-m-d', strtotime($form->date_brit->getValue()));
                }

                if($this->getParam('cur_password') &&
                    $this->getParam('new_password') &&
                    $this->getParam('new_password') == $this->getParam('new_password1') &&
                    md5(md5($this->getParam('cur_password')).md5($this->_config->salt)) == $mapper->password
                ) {
                    $mapper->setPassword($this->getParam('new_password'));
                }

                $mapper->save();
            }

            $profile = $mapper->convertRow();
            $mapper_images = new Models_Images_Mapper();
            $profile->photos = $mapper_images->getImages($profile->id);
            $form->populate($mapper->getArray());
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
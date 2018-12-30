<?php
/**
 *
 * @author kovalevich
 * @version
 */
require_once 'Zend/View/Interface.php';

/**
 * Formselect helper
 *
 * @uses viewHelper Zend_View_Helper
 */
class Zend_View_Helper_Usermenu
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function usermenu ()
    {
        $user = Zend_Registry::get('user');
        if ($user) {
            $xhtml = '
                <div class="login_box">
                    <h2>' . $this->view->translate(_('Login')) . ':</h2>
                    <p>' . $this->view->translate(_('Hello')) . ', <br>
                    <span>' . $user->name . '</span>.</p>
                    <ul>
                        <li><a href="/profile/' . $user->id . '">' . $this->view->translate(_('My profile')) . '</a></li>
                        <li><a href="/castings">' . $this->view->translate(_('Castings')) . ' (' . count($user->subscribes) . ')</a></li>
                    </ul>
                    <a href="/auth/logout" class="loguot">' . $this->view->translate(_('Logout')) . '</a>
		        </div>
            ';
        }
        else {
            $xhtml = '
                <form action="/auth/login" method="post">
                    <div class="form_login">
                        <h2>' . $this->view->translate(_('Login')) . ':</h2>
                        <input class="tx" type="text" value="" name="email" placeholder="' . $this->view->translate(_('email')) . '">
                        <div class="in_box">
                            <input class="tx" type="password" value="" name="password" placeholder="' . $this->view->translate(_('password')) . '">
                            <input class="btn_login" type="submit" value="">
                        </div>
                        <a href="/registration/forgotpass">' . $this->view->translate(_('Forgot password')) . '</a>
                    </div>
                </form>
            ';
        }
        return $xhtml;
    }

    /**
     * Sets the view field
     *
     * @param $view Zend_View_Interface
     */
    public function setView (Zend_View_Interface $view)
    {
        $this->view = $view;
    }
}

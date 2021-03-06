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
                    <h2>Login:</h2>
                    <p>Здравствуйте, <br>
                    <span>' . $user->name . '</span>.</p>
                    <ul>
                        <li><a href="/profile">Мой профиль</a></li>
                        <li><a href="#">Кастинги (5)</a></li>
                    </ul>
                    <a href="/auth/logout" class="loguot">Logout</a>
		        </div>
            ';
        }
        else {
            $xhtml = '
                <form action="/auth/login" method="post">
                    <div class="form_login">
                        <h2>Login:</h2>
                        <input class="tx" type="text" value="" name="email" placeholder="login">
                        <div class="in_box">
                            <input class="tx" type="password" value="" name="password" placeholder="password">
                            <input class="btn_login" type="submit" value="">
                        </div>
                        <a href="#">Forgot password</a>
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

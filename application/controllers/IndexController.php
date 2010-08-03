<?php

class IndexController extends Zend_Controller_Action
{

    protected $_form = null;

    public function indexAction()
    {
        
    }

    public function loginAction ()
    {
        $form = new Form_Login();
        $this->view->form = $form;
        if ($this->_request->isPost()) {
            $dados = $this->_request->getPost();
            if ($form->isValid($dados)) {
                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('database'), 'usuarios_sistema', 'log_usua', 'sen_usua');
                $authAdapter->setIdentity($dados['login'])->setCredential(sha1(strtoupper($dados['senha'])));
                //$authAdapter->setIdentity($dados['login'])->setCredential(strtoupper($dados['senha']));
                $result = $authAdapter->authenticate();
                if ($result->isValid()) {
                    $auth = Zend_Auth::getInstance();
                    $data = $authAdapter->getResultRowObject(null, 'sen_usua');
                    $auth->getStorage()->write($data);
                    $this->_redirect($this->_redirectUrl);
                } else {
					$this->_helper->FlashMessenger(array('mensagemerro' => IndexController::LoginFailure( strtoupper($dados ['login']), $result->getCode () )));
                }
                
            }
        }
    }

    
    public function logoutAction ()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect('/index/index');
    }

    
	static function LoginFailure($username, $code = '') {
		switch ($code) {
			case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND :
				$reason = 'Usuário não existe';
				break;
			case Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS :
				$reason = 'Existe mais de um usuário com este login';
				break;
			case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID :
				$reason = 'Senha inválida';
				break;
			default :
				$reason = '';
		}
		
		$message = sprintf ( 'Falha no login para o usuário "%s".', $username );
		
		if (strlen ( $reason ) > 0)
			$message .= sprintf ( ' (%s)', $reason );
		return $message;
	}
    
    

}







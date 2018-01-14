<?php
namespace App\Controllers;
use App\Core\Controller,
    App\Library\FacebookApp,
    App\Validations\Users,
    App\Models\Users AS ModelUser,
    App\Helpers\Alert;
use App\Helpers\Helper;

class loginController extends Controller
{
    public function index()
    {
        $fb = new FacebookApp([
            'app_id' => 'SEU_ID_DO_APP',
            'app_secret' => 'SUA_PALAVRA_SECRETA',
            'default_graph_version' => 'VERSA_DO_SEUAPP (v2.8)',
            //'default_access_token' => '{access-token}', // opcional
        ]);
        /* Setar a view de login */
        $fb->setPageLogin(BASE."login");
        /* Setar a view após se logar */
        $fb->setRedirectLogin(BASE."home");
        /* Recebe a lista de URIs de redirecionamento do OAuth válidos */
        $helper = $fb->getRedirectLoginHelper();
        /* Permissão opcional */
        $permissions = ['email'];
        /*Recebe o Token */
        $accessToken = $fb->getTokenAccess($helper);
        /* Seta quais dados deseja retornar do usuario logado */
        $fb->setReturnFields('name,last_name, picture, email, gender,age_range,link,cover');
        /* Valida e atualiza o tempo de vida do Token*/
        $fb->login($helper,$permissions,$accessToken);
        /* Recupera a url para conexao após todas as configurações*/
        $this->data['loginUrl']=$fb->getLoginUrl();
        /* Criamos as sessões com os dados desejados*/
        $_SESSION['id'] = $fb->getDataUser()['id'];
        $_SESSION['nome'] = $fb->getDataUser()['name'];
        $_SESSION['email'] = $fb->getDataUser()['email'];
        $_SESSION['picture'] = $fb->getDataUser()['picture']['url'];

        /* Daqui para baixo apenas verificamos se o email do face
           já existe cadastrado no banco e se existe a gente atualiza os dados, 
           caso contrario a gente cadastra*/
        $dados_form = [
            'id' => $fb->getDataUser()['id'],
            'nome' => $fb->getDataUser()['name'],
            'senha' => '',
            'email' => $fb->getDataUser()['email'],
            'picture' => $fb->getDataUser()['picture']['url']
        ];
        $validation = new Users($dados_form);
        if(!empty($dados_form['id'])) {
            $user = new ModelUser();
            if (!$user->selectByEmail($validation->getValidatedData()['email'])) {
                $user->LoginCreate($validation->getValidatedData());
            } else {
                $user->UpdateLoginFacebook($validation->getValidatedData());
            }
        }
        $this->loadView("login-facebook/index",$this->getData());
    }

    public function add()
    {
        $this->loadView('login-facebook/create-login');
    }

    public function create()
    {
        $validation = new Users(filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING));

        /* se não houve erros na validação*/
        if(!$validation->Erros()){
//            $dados_form = $validation->getValidatedData();
            $user = new ModelUser();
            /* se não existe email igual cadastrado*/
            if(!$user->selectByEmail($validation->getValidatedData()['email'])){
                if($user->LoginCreate($validation->getValidatedData())){
                    $this->data['retorno'] = Alert::AjaxSuccess("\o/, Novo <strong>Usuário</strong> cadastrado com sucesso!");
                }else{
                    $this->data['retorno'] = Alert::AjaxDanger("Opa,algo deu errado, contate o administrado!");
                }
            }else{
                $this->data['retorno'] = Alert::AjaxWarning("Opa, já existe este <strong>E-Mail</strong> cadastrado!");
            }

        }else{
            $this->data['retorno'] = Alert::AjaxDanger($validation->getErros());
        }

        echo json_encode($this->getData());
        exit();
    }

    public function logon()
    {
        $validation = new Users(filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING));

        /* se não houve erros na validação*/
        if(!$validation->Erros()){
//            $dados_form = $validation->getValidatedData();
            $user = new ModelUser();
            /* se o email digitado existe*/
            if($user->selectByEmail($validation->getValidatedData()['email'])){
                /*se email e senha existem e se equivalem*/
                if($user->login($validation->getValidatedData())){
                    $this->data['retorno'] = Alert::AjaxSuccess("Seja bem vindo <strong>{$validation->getValidatedData()['email']}</strong>");
                    $this->data['redirect'] = Alert::AjaxRedirect("home");
                }else{
                    $this->data['retorno'] = Alert::AjaxWarning("Campo <strong>Senha</strong> <strong>Não</strong> confere!");

                }
            }else{
                $this->data['retorno'] = Alert::AjaxWarning("Opa, <strong>E-Mail</strong> <strong>Não</strong> cadastrado!");
            }

        }else{
            $this->data['retorno'] = Alert::AjaxDanger($validation->getErros());
        }

        echo json_encode($this->getData());
        exit();
    }

    public function logout()
    {
        unset($_SESSION['face_access_token']);
        unset($_SESSION['nome']);
        unset($_SESSION['email']);
        unset($_SESSION['picture']);
        session_destroy();
        Helper::Redirect("login");
    }


}

<?php
/*
 * Class FacebookApp
 * @author Luciano Charles de Souza
 * 15/01/2018 06:30
 */
namespace App\Library;
use Facebook\Facebook;

class FacebookApp extends Facebook
{
    private $url;
    private $urlRedirect;
    private $fields;
    private $loginUrl;
    private $dataUser;

    public function getTokenAccess($helper)
    {
        try {
            if (isset($_SESSION['face_access_token'])) {
                $accessToken = $_SESSION['face_access_token'];
            } else {
                $accessToken = $helper->getAccessToken();
            }
            return $accessToken;
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            Die('Graph retornou um erro: ' . $e->getMessage());
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo Die('Facebook SDK retornou um erro: ' . $e->getMessage());
            exit;
        }
    }

    public function login($helper,$permissions,$accessToken)
    {
          if (!isset($accessToken)) {
            $this->loginUrl = $helper->getLoginUrl($this->url, $permissions);
         } else {
              $this->loginUrl = $helper->getLoginUrl($this->url, $permissions);
            //Usuário ja autenticado
            if (isset($_SESSION['face_access_token'])) {
                Facebook::setDefaultAccessToken($_SESSION['face_access_token']);
            }//Usuário não está autenticado
            else {
                $_SESSION['face_access_token'] = (string)$accessToken;
                $oAuth2Client = Facebook::getOAuth2Client();
                $_SESSION['face_access_token'] = (string)$oAuth2Client->getLongLivedAccessToken($_SESSION['face_access_token']);
                Facebook::setDefaultAccessToken($_SESSION['face_access_token']);
            }

            try {
                // Returna um objeto de Facebook\FacebookResponse
                $response = Facebook::get("/me?fields={$this->fields}");
                $this->dataUser = $response->getGraphUser();

                header("Location: ".$this->urlRedirect);

            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph retornou um erro: ' . $e->getMessage();
                exit;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK retornou um erro: ' . $e->getMessage();
                exit;
            }
        }

    }
    public function getLoginUrl()
    {
        return $this->loginUrl;
    }
    public function setPageLogin($url)
    {
        $this->url = $url;
    }
    public function setRedirectLogin($urlRedirect)
    {
    $this->urlRedirect = $urlRedirect;
    }
    public function setReturnFields($fields)
    {
        $this->fields = $fields;
    }
    public function getDataUser(){
        return $this->dataUser;
    }
}

<?php

namespace App\Controllers;

use App\Helpers\FlashMessage;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use DI\Container;

class ContactController extends BaseController
{
    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    public function index(Request $request, Response $response, array $args): Response
    {
        $data = [
            'title' => 'Contact Us',
            'message' => 'We would love to hear from you!'
        ];

        return $this->render($response, 'contactPage.php', $data);
    }

    public function submit(Request $request, Response $response, array $args): Response
    {
        $formData = $request->getParsedBody();

        FlashMessage::success('Your message has been sent successfully!');

        return $this->redirect($request, $response, 'contact.index');
    }
}

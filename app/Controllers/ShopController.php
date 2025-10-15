<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Domain\Models\ShopModel;
use DI\Container;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function DI\string;

class ShopController extends BaseController
{
    public function __construct(Container $container, private ShopModel $shopModel) {
        parent::__construct($container);
    }

    public function getShops(Request $req, Response $res, array $args): Response {
        $cafes = $this->shopModel->fetchShops();
        $data['cafes'] = $cafes;
        $data['page_title'] = 'List of shops';
        $data['title'] = 'List of available shops';
        // the $cafes variable is stored in the $data variable
        return $this->render($res, 'shopView.php', $data);;
    }

    public function getShop(Request $req, Response $res, array $args) : Response {
        $id = $args['id'];
        // dd($id);

        $cafe = $this->shopModel->fetchShop($id);
        $reviews = $this->shopModel->fetchReviews($id);
        $drinks = $this->shopModel->fetchDrinks($id);

        $data = [
            "cafe" => $cafe,
            "page_title" => $cafe["name"],
            "average_rating" => round($reviews['average_rating'], 1),
            "total_ratings" => $reviews['total_reviews'],
            "drinks" => $drinks,
        ];

        return $this->render($res, 'detailsView.php', $data);
    }

    public function searchShops(Request $req, Response $res, array $args) : Response {
        $searchParams = $req->getQueryParams()['prefix'];
        $searchOption = $req->getQueryParams()['searchOption'];

        try {
            $data = [
                "cafes" => $this->shopModel->searchShops(searchKeyword: $searchParams, filterType: $searchOption)
            ];

        } catch (\InvalidArgumentException $th) {
            return $this->render($res, 'shopView.php', []);
        }

        return $this->render($res, 'shopView.php', $data);
    }
}
?>

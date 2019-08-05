<?php
namespace PangyaCalculateMiddleware;

include_once('iRouterBuilder.php');
include_once('PinGenerator.php');

use Slim\Http\Request;
use Slim\Http\Response;

class PinRouterBuilder implements iRouterBuilder {
    public static function createRouter ($decorator) 
    {
        return function (Request $request, Response $response, array $args) use ($decorator) {
            if( !isset($args['club']) || !isset($args['power1w']) ) {
                return json_encode([]);
            }

            $club = $args['club'];

            $power1w = $args['power1w'];

            $generator = new PinGenerator($decorator['prefix'] . strtoupper($club) . '.xls', $decorator['shotType']);

            try {
                $response = $generator->getPinValues($power1w);
            } catch (Exception $exception) {
                return json_encode([]);
            }

            return json_encode($response);
        };
    }
}

<?php

namespace PalmNeko\Camagru\Presentation\API\Images;

use PalmNeko\Camagru\Application\Image\GetAll\GetAllImage;
use PalmNeko\Camagru\Application\Image\GetAll\GetAllImageCommand;
use PalmNeko\Camagru\Client\InContainer\MySQLClient;
use PalmNeko\Camagru\Infrastructure\MySQL\Repository\ImageRepository;
use PalmNeko\Camagru\Infrastructure\MySQL\TransactionManager;
use PalmNeko\Camagru\Presentation\Http\HandlerResult;
use PalmNeko\Camagru\Presentation\Http\IRequestHandler;

class GetAllImages implements IRequestHandler
{
    public function invoke(): HandlerResult
    {
        $client = MySQLClient::staticClient();
        $service = new GetAllImage(new ImageRepository($client), new TransactionManager($client));
        $images = $service->execute(new GetAllImageCommand());
        $response = [];
        foreach ($images->gen() as $image) {
            $response[] = [
                "id" => $image->id
            ];
        }
        echo json_encode($response);
        http_response_code(200);
        return new HandlerResult(false);
    }
}

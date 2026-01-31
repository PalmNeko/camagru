<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;

function createS3Client() {
    return new S3Client([
        'region' => 'local-rust-fs',
        'version' => 'latest',
        'endpoint' => 'http://' . getenv('S3_SERVER_DOMAINS') . ':' . getenv('S3_PORT'),
        'use_path_style_endpoint' => true,
        'credentials' => [
            'key' => getenv('S3_ACCESS_KEY'),
            'secret' => getenv('S3_SECRET_KEY'),
        ]
    ]);
}


function createBucketIfNotExists($client) {
    $bucketName = getenv('S3_BUCKET_NAME');
    if ($client->doesBucketExistV2($bucketName) == false)
    {
        try {
            $result = $client->createBucket([
                        'Bucket' => $bucketName,
                    ]);
            echo 'Created Bucket: ' . $bucketName;
        } catch(AwsException $e) {
            echo 'Error: ' . $e->getAwsErrorMessage();
            exit;
        }
    }
}

?>

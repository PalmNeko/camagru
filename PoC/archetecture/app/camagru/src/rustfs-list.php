<?php

require 'require_rustfsclient.php';

$client = createS3Client();
createBucketIfNotExists($client);

$results = $client->listBuckets();
print_r($results);

$bucketName = getenv('S3_BUCKET_NAME');

try {
    $contents = $client->listObjectsV2([
        'Bucket' => $bucketName,
    ]);
    if (!isset($contents['Contents'])) {
        echo "Bucket is empty\n";
        return;
    }
    echo "The contents of your bucket are: \n";
    echo "<div>";
    foreach ($contents['Contents'] as $content) {
        $request = $client->createPresignedRequest(
            $client->getCommand('GetObject', [
                'Bucket' => $bucketName,
                'Key' => $content['Key'],
            ]),
            '+1 hour'
        );

        // From the resulting RequestInterface object, you can get the URL.
        $presignedUrl = (string) $request
            ->getUri()
            ->withHost(getenv('S3_PRESIGNED_EXPOSE_DOMAIN'))
            ->withPort(getenv('S3_PRESIGNED_EXPOSE_PORT'));
        echo "<img width=\"100px\" src=\"$presignedUrl\"" . "/>" . "\n";
    }
    echo "</div>";
} catch (Exception $exception) {
    echo "Failed to list objects in camagru with error: " . $exception->getMessage();
    exit("Please fix error with listing objects before continuing.");
}
?>

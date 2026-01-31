<?php
require 'require_rustfsclient.php';

$bucket = getenv('S3_BUCKET_NAME');
$key = basename($_FILES['userfile']['name']);
$file_path = $_FILES['userfile']['tmp_name'];

echo '<pre>';
try {
    $client = createS3Client();
    createBucketIfNotExists($client);

    $content_type = mime_content_type($file_path);
    $result = $client->putObject([
        'Bucket' => $bucket,
        'Key' => $key,
        'SourceFile' => $file_path,
        'ContentType' => $content_type,
    ]);
} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";

?>

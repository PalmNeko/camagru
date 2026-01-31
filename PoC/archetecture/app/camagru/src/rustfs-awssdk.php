<?php

require 'require_rustfsclient.php';

$client = createS3Client();
createBucketIfNotExists($client);

$results = $client->listBuckets();
print_r($results);
?>

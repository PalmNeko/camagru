<?php
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    $file = '/var/www/uploads' . $_SERVER["REQUEST_URI"];
    if (!is_file($file)) {
        http_response_code(404);
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $file);
    finfo_close($finfo);

    header('Content-Type: ' . $mime);
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
} else {
    echo "<p>Welcome to PHP</p>";
}
?>
<h1>mail</h1>
<form enctype="multipart/form-data" action="mail.php" method="POST">
    メールアドレス：<input name="email" type="email">
    件名：<input name="subject" type="text">
    本文：<textarea name="body"></textarea>
    <input type="submit" value="メールを送信" />
</form>
<h1>hello</h1>
<!-- データのエンコード方式である enctype は、必ず以下のようにしなければなりません -->
<form enctype="multipart/form-data" action="uploads.php" method="POST">
    <!-- MAX_FILE_SIZE は、必ず "file" input フィールドより前になければなりません -->
    <!-- <input type="hidden" name="MAX_FILE_SIZE" value="100000" /> -->
    <!-- input 要素の name 属性の値が、$_FILES 配列のキーになります -->
    このファイルをアップロード: <input name="userfile" type="file" />
    <input type="submit" value="ファイルを送信" />
</form>
<?php
echo "Hello world!!!";
$image_paths = glob("/var/www/uploads/*.{png,gif,jpg,jpeg}", GLOB_BRACE);
foreach($image_paths as $image_path) {
    $encoded_url = urlencode(basename($image_path));
    echo "<img src=\"$encoded_url\" />";
}

print_r($image_paths);
// echo $SCRIPT_FILENAME;
phpinfo();
?>

<?php
function get_escaped($map, $property)
{
    return htmlspecialchars($map[$property]);
}

mb_language("Japanese");
mb_internal_encoding("UTF-8");
if (mb_send_mail($_POST["email"], $_POST["subject"], $_POST["body"])) {
    echo "メールを送信しました！";
}
else {
    echo "送信できませんでした･･･";
}
echo "1";
print_r($_POST);
?>

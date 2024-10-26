<?php
session_start();
$folder_path = '../../public/img/Banner';
$image_files_list = glob($folder_path . '/*.png');
isset($_SESSION['Banner']) ? '' : $_SESSION['Banner'] = 0;
if ($_SESSION['Banner'] == (count($image_files_list) - 1)) {
    $_SESSION['Banner'] = 0;
} else {
    $_SESSION['Banner']++;
}
?>
<img src="<?php echo $image_files_list[$_SESSION['Banner']]; ?>" alt="">
<?php
header('Refresh: 10s; url=slide.php') ?>
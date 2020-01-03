<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8"/>
    <title>SuperDinero | <?= $page_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <?php if (isset($styles)) {
        $lambda = function() use ($styles) {
            $slash = DIRECTORY_SEPARATOR;
            foreach ($styles as $each) {
              $version = filemtime(str_replace("system".$slash,"",BASEPATH) . str_replace("\\",$slash, $each));
              echo '<link rel="stylesheet" href="' . site_url($each) . '?v=' . $version . '" type="text/css" /> ' . "\n";
            }
        };
        $lambda();
    } ?>
    <link rel="shortcut icon" href="<?= site_url('assets/ico.png') ?>"/>
</head>
<body class="h-screen w-screen flex flex-row">
    <?php $this->load->view('/admin/layout/sidebar') ?>
    <div class='w-full bg-gray-200 container mx-auto'>
        <div class="overflow-y-auto h-full">
            <?php $this->load->view('/admin/layout/topbar') ?>
            <div class='px-4 pb-4 pt-20'>
                <?php $this->load->view('/admin/pages/' . $page) ?>
            </div>
        </div>
    </div>
<script>window.site_url = '<?= site_url() ?>'</script>
<?php if (isset($scripts)) {
    $lambda = function() use ($scripts) {
        $slash = DIRECTORY_SEPARATOR;
        foreach ($scripts as $each) {
          $version = filemtime(str_replace("system".$slash,"",BASEPATH) . str_replace("\\",$slash, $each));
          echo '<script type="text/javascript" src="' . site_url($each) . '?v=' . $version . '"></script>' . "\n";
        }
    };
    $lambda();
} ?>
</body>
</html>
<div class='flex flex-col justify-between w-64 bg-green-500'>
    <div class='flex flex-col'>
        <div class="h-16">
            <img src="<?= site_url('assets/images/logo-white.png') ?>" class=' px-4 w-full' alt="">
        </div>
        <?php $menu = [
            ['id' => 'partners', 'title' => 'Asociados'],
            ['id' => 'credits', 'title' => 'Tipos de creditos'],
            ['id' => 'categories', 'title' => 'Categorias'],
            ['id' => 'states', 'title' => 'Estados'],
            ['id' => 'amounts', 'title' => 'Montos'],
            ['id' => 'params', 'title' => 'Parametros']
        ] ?>
        <ul class='mt-6 text-gray-100'>
            <?php foreach ($menu as $key => $value) { ?>
                <li class='px-4 py-2 cursor-pointer border-b <?= $key == 0 ? 'border-t' : '' ?> border-green-600 hover:bg-green-700 <?= $value['id'] == $page_id ? 'bg-green-700' : '' ?>'>
                    <a href='<?= site_url('admin/' . $value['id']) ?>' class='flex flex-row items-center ml-2'>
                        <?php if ($value['id'] == $page_id){ ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class='fill-current h-4 mr-2' viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M18.59 13H3a1 1 0 0 1 0-2h15.59l-5.3-5.3a1 1 0 1 1 1.42-1.4l7 7a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.42-1.4l5.3-5.3z"/></svg>
                        <?php } ?>
                        <span><?= $value['title'] ?></span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class='flex flex-row justify-center mb-4'>
        <a href="javascript:;" class='text-xs font-semibold uppercase tracking-wide text-gray-100 hover:text-green-800'>Cerrar sesion</a>
    </div>
</div>
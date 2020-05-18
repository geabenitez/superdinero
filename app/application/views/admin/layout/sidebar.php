<div class='flex flex-col justify-between w-64 bg-green-500'>
    <div class='flex flex-col'>
        <div class="h-16">
            <img src="<?= site_url('assets/images/logo-white.png') ?>" class=' px-4 w-full' alt="">
        </div>
        <?php $menu = [
            ['profiles' => [1, 2], 'id' => 'generator', 'title' => 'Generador'],
            ['profiles' => [1], 'id' => 'logs', 'title' => 'Log de códigos'],
            ['profiles' => [1], 'id' => 'partners', 'title' => 'Asociados'],
            ['profiles' => [1], 'id' => 'credits', 'title' => 'Tipos de creditos'],
            ['profiles' => [1], 'id' => 'categories', 'title' => 'Categorias'],
            ['profiles' => [1], 'id' => 'states', 'title' => 'Estados'],
            ['profiles' => [1], 'id' => 'amounts', 'title' => 'Montos'],
            ['profiles' => [1], 'id' => 'documents', 'title' => 'Documentos'],
            ['profiles' => [1], 'id' => 'records', 'title' => 'Records crediticios'],
            ['profiles' => [1], 'id' => 'methods', 'title' => 'Metodos de pago'],
            ['profiles' => [1], 'id' => 'users', 'title' => 'Usuarios'],
        ] ?>
        <ul class='mt-6 text-gray-100'>
            <?php foreach ($menu as $key => $value) { if(in_array($this->session->userdata['profile'], $value['profiles'])){ ?>
                <li class='px-4 py-2 cursor-pointer border-b <?= $key == 0 ? 'border-t' : '' ?> border-green-600 hover:bg-green-700 <?= $value['id'] == $page_id ? 'bg-green-700' : '' ?>'>
                    <a href='<?= site_url('admin/' . $value['id']) ?>' class='flex flex-row items-center ml-2'>
                        <?php if ($value['id'] == $page_id){ ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class='fill-current h-4 mr-2' viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M18.59 13H3a1 1 0 0 1 0-2h15.59l-5.3-5.3a1 1 0 1 1 1.42-1.4l7 7a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.42-1.4l5.3-5.3z"/></svg>
                        <?php } ?>
                        <span><?= $value['title'] ?></span>
                    </a>
                </li>
            <?php } } ?>
        </ul>
    </div>
    <div class='flex flex-row justify-center mb-4'>
        <a href="<?= site_url('logout')?>" class='text-xs font-semibold uppercase tracking-wide text-gray-100 hover:text-green-800'>Cerrar sesion</a>
    </div>
</div>
<script>
    const inactivityTime = function () {
        let time;
        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;

        function logout() {
            location.href = '/logout'
        }

        function resetTimer() {
            clearTimeout(time);
            time = setTimeout(logout, 1000*60*90)
        }
    };

    window.onload = function() {
        inactivityTime(); 
    }
</script>
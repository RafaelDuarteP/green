<?php


/**
 * Gera a sidebar com o link ativo
 * @param Cliente $user
 * @param int $active
 * @return void
 */
function getSideBar(Cliente $user, int $active)
{
    $actives = ['', '', ''];
    $actives[$active - 1] = 'active';

    echo <<<HTML
<div class="col-3 sidebar">
    <div class="row justify-content-center">
        <div class="col-12 title my-5">
            <h2 class="text-center"> Olá
                <strong>
                    {$user->getNome()}
                </strong>
            </h2>
        </div>
        <div class="col-12 divisor"></div>
        <a href="home" class="col-12 link-card my-4 {$actives[0]}">
            <div class="link-text">
                <p>Meus dados</p> <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>
        <div class="divisor col-11"></div>
        <a href="orcamentos" class="col-12 link-card my-4 {$actives[1]}">
            <div class="link-text">
                <p>Orçamentos</p> <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>
        <div class="divisor col-11"></div>
        <a href="pedidos" class="col-12 link-card my-4 {$actives[2]}">
            <div class="link-text">
                <p>Pedidos</p> <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>
        <div class="divisor col-11"></div>
    </div>
</div>
HTML;
}
function getSideBarRestricted(int $active)
{
    $actives = ['', '', '', '', ''];
    $actives[$active - 1] = 'active';

    echo <<<HTML
<div class="col-3 sidebar">
    <div class="row justify-content-center">
        <a href="home" class="col-12 link-card my-4 {$actives[0]}">
            <div class="link-text">
                <p>Clientes</p> <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>
        <div class="divisor col-11"></div>
        <a href="orcamentos" class="col-12 link-card my-4 {$actives[1]}">
            <div class="link-text">
                <p>Orçamentos</p> <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>
        <div class="divisor col-11"></div>
        <a href="pedidos" class="col-12 link-card my-4 {$actives[2]}">
            <div class="link-text">
                <p>Pedidos</p> <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>
        <div class="divisor col-11"></div>
        <a href="testes" class="col-12 link-card my-4 {$actives[3]}">
            <div class="link-text">
                <p>Testes</p> <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>
        <div class="divisor col-11"></div>
        <a href="adms" class="col-12 link-card my-4 {$actives[4]}">
            <div class="link-text">
                <p>Administradores</p> <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>
        <div class="divisor col-11"></div>
    </div>
</div>
HTML;
}
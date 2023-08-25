<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/home.css">
<title>Home</title>


<?php
include_once "./components/header.php";
?>

<section class="container-fluid px-4">
    <div class="row h-100">
        <?php
        include_once "./components/sidebar.php";
        getSideBar($user, 1);
        ?>

        <div class="col-9">
            <div class="row py-3 justify-content-center">
                <div class="col-11 card-info my-4">
                    <span>Nome</span>
                    <p>
                        <?php echo $user->getNome() ?>
                    </p>
                    <span class="editar">Editar <i class="fa-solid fa-chevron-right"></i></span>
                </div>
                <div class="col-11 card-info my-4">
                    <span>Razão social</span>
                    <p>
                        <?php echo $user->getRazaoSocial() ?>
                    </p>
                    <span class="editar">Editar <i class="fa-solid fa-chevron-right"></i></span>
                </div>
                <div class="col-11 card-info my-4">
                    <span>Email</span>
                    <p>
                        <?php echo $user->getEmail() ?>
                    </p>
                    <span class="editar">Editar <i class="fa-solid fa-chevron-right"></i></span>
                </div>
                <div class="col-11 card-info my-4">
                    <span>CNPJ</span>
                    <p>
                        <?php
                        function maskCnpj($cnpj)
                        {
                            $mask = "##.###.###/####-##";

                            $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

                            $maskedCnpj = '';
                            $k = 0;

                            for ($i = 0; $i < strlen($mask); $i++) {
                                if ($mask[$i] == '#') {
                                    if (isset($cnpj[$k]))
                                        $maskedCnpj .= $cnpj[$k++];
                                } else {
                                    if (isset($mask[$i]))
                                        $maskedCnpj .= $mask[$i];
                                }
                            }

                            return $maskedCnpj;
                        }

                        $maskedCnpj = maskCnpj($user->getCnpj());

                        echo $maskedCnpj; // Saída: 12.345.678/9012-34
                        
                        ?>
                    </p>
                    <span class="editar">Editar <i class="fa-solid fa-chevron-right"></i></span>
                </div>
                <div class="col-11 card-info my-4">
                    <span>Senha</span>
                    <p>
                        <?php
                        for ($i = 0; $i < 8; $i++)
                            echo '*' ?>
                        </p>
                        <span class="editar">Editar <i class="fa-solid fa-chevron-right"></i></span>
                    </div>
                    <div class="col-11 card-info my-4">
                        <span>Endereço</span>
                        <p>
                            Endereço
                        </p>
                        <span class="editar">Editar <i class="fa-solid fa-chevron-right"></i></span>
                    </div>
                </div>
            </div>

        </div>

    </section>
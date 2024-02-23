<header class="bg-dark py-2 py-md-0 sticky-top z-2">
        <div class="container px-0">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">

                    <div class="navbar-brand col-md-2 col-sm-10">
                        <a class="text-light" href="#">E-Commercer</a>
                    </div>

                    <button class="navbar-toggler d-lg-none focus-ring focus-ring-light"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars text-light fs-1"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

                        <form class="d-flex w-100 py-4" role="search">
                            <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
                            <button class="btn btn-outline-light " type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>

                        <ul class="navbar-nav col col-sm-12 col-lg-8 col-xl-6 mb-lg-0 justify-content-end">
                            <li class="nav-item px-0 px-sm-0 w-100 d-md-flex justify-content-lg-center align-items-md-center"><a class="nav-link text-light" aria-current="" href="../view/index.php">Inicio</a></li>
                            <li class="nav-item px-0 px-sm-0 w-100 d-md-flex justify-content-lg-center align-items-md-center"><a class="nav-link text-light" aria-current="" href="../view/produtos">Produtos</a></li>
                            <?php
                              

                                if($_SESSION["id_usuario"] == 0){
                                    echo "<li class='nav-item px-0 px-sm-0 w-100 d-md-flex justify-content-lg-center align-items-md-center'><a class='nav-link text-light' aria-current='' href='login.php'>Entar <i class='fa-solid fa-user'></i></a></li>";
                                    echo "<li class='nav-item px-0 px-sm-0 w-100 d-md-flex justify-content-lg-center align-items-md-center'><a class='nav-link text-light' aria-current='' href='criar_conta.php'>Criar Conta </i><i class='fa-solid fa-right-to-bracket'></i></a></li>";
                                }

                                if($_SESSION["id_usuario"] != 0 AND $_SESSION["id_tipo_usuario"] == 1){
                                    //echo "<li class='nav-item px-0 px-sm-0 w-100 d-md-flex justify-content-lg-center align-items-md-center'><a class='nav-link text-light' aria-current='' href='../admin/'>Admin / <i class='fa-solid fa-folder'></i></a></li>";
                                    echo "
                                            <li class='nav-item px-0 px-sm-0 w-100 d-md-flex justify-content-lg-center align-items-md-center'>
                                                <a class='nav-link dropdown-toggle text-light' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                Admin <i class='fa-solid fa-folder'></i>
                                                </a>
                                                <ul class='dropdown-menu dropdown-menu-lg-end p-4'>
                                                    <li class='mb-lg-2'><a class='dropdown-item' href='../admin/produtos.php'>Produtos</a></li>
                                                    <li class='mb-lg-2'><a class='dropdown-item' href='../admin/cadastro_produto.php'>Cadastrar Produtos</a></li>
                                                    <li class='mb-lg-2'><a class='dropdown-item' href='../admin/categorias.php'>Categorias</a></li>
                                                    <li class='mb-lg-2'><a class='dropdown-item' href='../admin/cadastro_categoria.php'>Cadastrar Categorias</a></li>
                                                    <li class='mb-lg-2'><a class='dropdown-item' href='../admin/fornecedores.php'>Fornecedores</a></li>
                                                    <li class='mb-lg-2'><a class='dropdown-item' href='../admin/cadastro_fornecedor.php'>Cadastro Fornecedor</a></li>
                                                </ul>
                                            </li>
                                        ";
                                }
                                
                                if ($_SESSION["id_usuario"] != 0) {
                                    echo "
                                        <li class='nav-item px-0 px-sm-0 w-100 d-md-flex justify-content-lg-center align-items-md-center'>
                                            <a class='nav-link text-primary' aria-current='' href='perfil.php'> Perfil <i class='fa-solid fa-user'></i></a>
                                        </li>

                                        <li class='nav-item px-0 px-sm-0 w-100 d-md-flex justify-content-lg-center align-items-md-center'>
                                            <a class='nav-link text-danger' aria-current='' href='logoff.php'> Sair <i class='fa-solid fa-right-from-bracket'></i></a>
                                        </li>
                                        
                                    ";
                                }
                            
                            ?>

                        </ul>
                    </div>
                </div>
              </nav>
        </div>
</header>
<nav class="navbar navbar-default menu">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><?php echo strtoupper($_SESSION["nomeLogado"]);  ?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <?php if(isset($_SESSION["isMod"]) && $_SESSION["isMod"]): ?>
                <li class="novoAlimento"><a href="novoAlimento">Novo Alimento</a></li>
                <li class="editarAlimentos"><a href="editarAlimentos">Editar Alimentos</a></li>
                <li class="listaUsuarios"><a href="listaUsuarios">Lista de Usuarios</a></li>
              <?php endif; ?>
              <li class="dietas"><a href="dietas">Dietas</a></li>
              <li class="sair"><a href="sair">Sair</a></li>              
            </ul>            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
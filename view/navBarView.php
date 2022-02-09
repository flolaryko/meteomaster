
<nav class="navbar navbar-expand-lg navbar-light bg-light rounded" aria-label="Twelfth navbar example">
      <div class="container-fluid" >
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
          <ul class="navbar-nav">
        
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
            </li>
           
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-bs-toggle="dropdown" aria-expanded="false">Rechercher</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown10">
                <li><a class="dropdown-item" href="index.php?page=graphicView">Par lieu</a></li>
                <li><a class="dropdown-item" href="index.php?page=graphiComparView">Par période</a></li>
                
              </ul>
            </li>
            <?php if (empty($_SESSION['login'])) : ?> 
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php?page=loginView">Mode admin</a>
            </li>
            <?php endif; ?>
<?php if (!empty($_SESSION['login'])) : ?> 
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-bs-toggle="dropdown" aria-expanded="false">Menu Admin</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown10">
                <li><a class="dropdown-item" href="index.php?page=ajouLieuView">Enregistrer un lieu</a></li>
              </ul>
            </li>
            
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php?etat=0">Déconnexion</a>
            </li>
            <?php endif; ?>

          </ul>
        </div>
      </div>
    </nav> <!-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>-->
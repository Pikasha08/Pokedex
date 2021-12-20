<nav class="navbar navbar-expand-sm bg-secondary navbar-dark px-3 fixed-left">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <form action="" method="POST" class="search-pokemon">
                    <li>
                        <input type="text" name="pokeSearch" id="pokeName" placeholder="Search for a Pokémon">
                    </li>
                    <li class="nav-item">
                        <input type="submit" class="nav-button" name="pokemons" value="Pokemons">
                    </li>
                    <li class="nav-item">
                        <input type="submit" class="nav-button" name="moves" value="Moves">
                    </li>
                </form>
            </ul>
        </div>
    </div>
</nav>
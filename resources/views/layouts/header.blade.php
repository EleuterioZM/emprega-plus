<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img src="./img/logo.svg" width="110" height="32" alt="Emprega+" class="navbar-brand-image">
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link" href="./">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Home</span>
                    </a>
                </li>
                <!-- Perfil -->
                <li class="nav-item">
                    <a class="nav-link" href="./profile">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12c2.8 0 5 2.2 5 5s-2.2 5 -5 5s-5 -2.2 -5 -5s2.2 -5 5 -5z" />
                                <path d="M12 2c-2.8 0 -5 2.2 -5 5s2.2 5 5 5s5 -2.2 5 -5s-2.2 -5 -5 -5z" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Perfil</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#navbar-gestao" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <!-- Ícone de gestão -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
                <path d="M9 12l2 2l4 -4"/>
            </svg>
        </span>
        <span class="nav-link-title">Gestão</span>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('candidatos.index') }}">
            Gerir Candidatos
        </a>
        <a class="dropdown-item" href="{{ route('empregadores.index') }}">
            Gerir Empregadores
        </a>
    </div>
</li>
                <!-- Jobs -->
                <li class="nav-item">
                    <a class="nav-link" href="./jobs">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 3v18h14v-18h-14z" />
                                <path d="M5 6h14" />
                                <path d="M5 9h14" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Vagas</span>
                    </a>
                </li>
                <!-- Messages -->
                <li class="nav-item">
                    <a class="nav-link" href="./messages">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M21 12a2 2 0 1 1 -4 0a2 2 0 0 1 4 0" />
                                <path d="M12 12a2 2 0 1 1 -4 0a2 2 0 0 1 4 0" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Mensagens</span>
                    </a>
                </li>
                <!-- Notifications -->
                <li class="nav-item">
                    <a class="nav-link" href="./notifications">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12a2 2 0 1 1 -4 0a2 2 0 0 1 4 0" />
                                <path d="M21 12a2 2 0 1 1 -4 0a2 2 0 0 1 4 0" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Notificações</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

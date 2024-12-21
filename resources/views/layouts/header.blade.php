<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img src="./img/logo.svg" width="110" height="32" alt="Emprega+" class="navbar-brand-image">
            </a>
        </h1>

       
       
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-danger"
                style="text-align: center; width: 100%; font-size: 20px; padding: 15px; display: flex; flex-direction: column; align-items: center; justify-content: center;">

                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="27" height="27">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M15 12L2 12M2 12L5.5 9M2 12L5.5 15" stroke="#ffffff" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.3531 21.8897 19.1752 21.9862 17 21.9983M9.00195 17C9.01406 19.175 9.11051 20.3529 9.87889 21.1213C10.5202 21.7626 11.4467 21.9359 13 21.9827"
                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                    </g>
                </svg>

                <p style="margin-top: 5px; font-size: 13px; font-family:JetBrains Mono">Logout</p>
            </button>

        </form>
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link" href="dashboard">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg fill="#ffffff" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">
                        <path d="M27 18.039L16 9.501 5 18.039V14.56l11-8.54 11 8.538v3.481zm-2.75-.31v8.251h-5.5v-5.5h-5.5v5.5h-5.5v-8.25L16 11.543l8.25 6.186z"></path></g></svg>
                        </span>
                        <span class="nav-link-title">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('perfil.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.5 7.063C16.5 10.258 14.57 13 12 13c-2.572 0-4.5-2.742-4.5-5.938C7.5 3.868 9.16 2 12 2s4.5 1.867 4.5 5.063zM4.102 20.142C4.487 20.6 6.145 22 12 22c5.855 0 7.512-1.4 7.898-1.857a.416.416 0 0 0 .09-.317C19.9 18.944 19.106 15 12 15s-7.9 3.944-7.989 4.826a.416.416 0 0 0 .091.317z"
                                        fill="#ffffff"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="nav-link-title">Perfil</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-gestao" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">

                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Ícone de gestão -->
                            <svg fill="#ffffff" height="200px" width="20px" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 297 297"
                                xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 297 297"
                                stroke="#ffffff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <circle cx="187.272" cy="99.563" r="15.607"></circle>
                                        <path
                                            d="m289.904,84.057h-17.793c-1.433-4.403-3.214-8.693-5.324-12.831l12.588-12.587c2.771-2.772 2.771-7.264 0-10.036l-29.029-29.029c-2.772-2.77-7.264-2.77-10.036,0l-12.588,12.588c-4.139-2.11-8.428-3.89-12.83-5.324v-17.791c0-3.919-3.177-7.096-7.096-7.096h-41.053c-3.919,0-7.096,3.177-7.096,7.096v17.793c-4.403,1.434-8.692,3.214-12.83,5.325l-12.587-12.588c-1.331-1.331-3.136-2.079-5.018-2.079s-3.686,0.747-5.018,2.078l-29.026,29.027c-2.771,2.772-2.771,7.264 0,10.035l12.587,12.588c-2.109,4.138-3.889,8.427-5.324,12.831h-17.791c-3.919,0-7.096,3.177-7.096,7.096v41.053c0,3.919 3.177,7.096 7.096,7.096h17.792c1.434,4.403 3.214,8.691 5.324,12.829l-12.587,12.588c-1.331,1.331-2.079,3.136-2.079,5.018 0,1.882 0.747,3.686 2.079,5.018l29.03,29.029c2.77,2.77 7.263,2.77 10.035,0l12.587-12.587c4.139,2.11 8.428,3.89 12.831,5.324v17.793c0,3.919 3.177,7.096 7.096,7.096h41.053c3.919,0 7.096-3.177 7.096-7.096v-17.793c4.402-1.433 8.691-3.213 12.83-5.324l12.588,12.588c2.772,2.77 7.264,2.77 10.036,0l29.029-29.029c2.771-2.772 2.771-7.264 0-10.036l-12.588-12.587c2.11-4.139 3.89-8.427 5.324-12.83h17.793c3.919,0 7.096-3.177 7.096-7.096v-41.054c-0.005-3.919-3.182-7.096-7.101-7.096zm-102.632,76.295c-26.838,0-48.673-21.834-48.673-48.672s21.835-48.673 48.673-48.673 48.672,21.835 48.672,48.673-21.834,48.672-48.672,48.672z">
                                        </path>
                                        <path
                                            d="m112.009,217.91h-6.645c-0.307-0.798-0.635-1.589-0.983-2.37l4.7-4.701c2.771-2.771 2.771-7.263 0-10.035l-14.837-14.837c-2.77-2.768-7.263-2.77-10.035,0l-4.701,4.7c-0.781-0.348-1.572-0.676-2.37-0.983v-6.645c0-3.919-3.177-7.096-7.096-7.096h-20.981c-3.919,0-7.096,3.177-7.096,7.096v6.645c-0.798,0.307-1.589,0.635-2.37,0.983l-4.701-4.7c-2.77-2.77-7.263-2.77-10.035,0l-14.837,14.837c-2.771,2.772-2.771,7.264 0,10.035l4.7,4.701c-0.348,0.781-0.676,1.572-0.983,2.37h-6.643c-3.919,0-7.096,3.177-7.096,7.096v20.983c0,3.919 3.177,7.096 7.096,7.096h6.645c0.307,0.798 0.635,1.588 0.983,2.369l-4.7,4.701c-2.771,2.771-2.771,7.263 0,10.035l14.837,14.837c2.772,2.77 7.264,2.77 10.036,0l4.7-4.701c0.781,0.349 1.572,0.677 2.37,0.984v6.645c0,3.919 3.177,7.096 7.096,7.096h20.982c3.919,0 7.096-3.177 7.096-7.096v-6.645c0.798-0.307 1.589-0.635 2.37-0.983l4.701,4.7c2.77,2.77 7.263,2.77 10.035,0l14.837-14.837c2.771-2.772 2.771-7.264 0-10.035l-4.7-4.701c0.348-0.781 0.676-1.571 0.983-2.369h6.645c3.919,0 7.096-3.177 7.096-7.096v-20.983c-0.004-3.92-3.18-7.096-7.099-7.096zm-52.457,41.914c-13.414,0-24.328-10.914-24.328-24.328 0-13.414 10.914-24.328 24.328-24.328s24.328,10.914 24.328,24.328c-1.42109e-14,13.414-10.914,24.328-24.328,24.328z">
                                        </path>
                                        <path
                                            d="m204.767,123.829l-4.66-1.429-12.835,6.103-12.835-6.103-4.66,1.429c-4.95,1.65-8.397,6.073-8.86,11.196 6.502,7.206 15.907,11.745 26.355,11.745 10.447,0 19.853-4.539 26.355-11.746-0.463-5.123-3.91-9.545-8.86-11.195z">
                                        </path>
                                    </g>
                                </g>
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
                    <a class="nav-link" href="{{ route('job_posts.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 964.8 964.8" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M166.48,328.9c4.4-5.6,8.9-11.1,13.6-16.4c6-6.9,12.3-13.7,18.9-20.2c23.7-23.7,49.9-44,78.4-60.9v-6.6 c0-15.4-12.5-27.8-27.8-27.8h-30.9c-5.5,0-10.6,2.6-13.7,7.1l-45.6,64.5l-11.1-23.4l17.7-37.2c2.4-5.1-1.3-11-6.9-11h-35.4 c-5.6,0-9.4,5.9-6.9,11l17.7,37.2l-10.9,23l-44.5-63.9c-3.1-4.5-8.3-7.3-13.8-7.3h-32.5c-15.4,0-27.8,12.5-27.8,27.8v184.9h112.7 C130.78,380.8,147.081,353.8,166.48,328.9z"></path> <path d="M51.48,89.6c0,49.4,40.2,89.6,89.6,89.6s89.6-40.2,89.6-89.6c0-49.4-40.2-89.6-89.6-89.6S51.48,40.2,51.48,89.6z"></path> <path d="M896.28,197c-5.5,0-10.6,2.6-13.7,7.1l-45.6,64.5l-11.1-23.4L843.58,208c2.4-5.1-1.3-11-6.899-11h-35.4 c-5.6,0-9.399,5.9-6.899,11l17.699,37.2l-10.899,23l-44.4-63.9c-3.1-4.5-8.3-7.3-13.8-7.3h-32.5c-15.4,0-27.8,12.5-27.8,27.8v7.1 c28.1,16.7,54,36.9,77.399,60.3c6.801,6.8,13.301,13.8,19.5,20.9c4.4,5.1,8.801,10.4,12.9,15.7c19.4,24.9,35.8,51.9,48.8,80.8 h113.7V224.8c0-15.4-12.5-27.8-27.8-27.8H896.28L896.28,197z"></path> <path d="M729.181,89.6c0,49.4,40.2,89.6,89.6,89.6c49.4,0,89.601-40.2,89.601-89.6c0-49.4-40.2-89.6-89.601-89.6 C769.381,0,729.181,40.2,729.181,89.6z"></path> <path d="M940.28,875.2L817.381,781c-16.101,26.2-35.301,50.399-57.301,72.399c-1.8,1.801-3.699,3.601-5.6,5.4l124.9,95.7 c9.1,7,19.8,10.3,30.399,10.3c15,0,29.9-6.7,39.7-19.6C966.28,923.399,962.181,892,940.28,875.2z"></path> <path d="M616.08,571c0-15.4-12.5-27.8-27.8-27.8h-30.899c-5.5,0-10.601,2.6-13.7,7.1l-45.601,64.5l-11.1-23.4l17.7-37.199 c2.399-5.101-1.3-11-6.9-11h-35.399c-5.601,0-9.4,5.899-6.9,11l17.7,37.199l-10.9,23l-44.3-63.899c-3.1-4.5-8.3-7.3-13.8-7.3 h-32.5c-15.4,0-27.8,12.5-27.8,27.8v184.899h272.3V571H616.08z"></path>
                            <path d="M479.98,525.5c49.4,0,89.6-40.2,89.6-89.601c0-49.399-40.199-89.6-89.6-89.6s-89.6,40.2-89.6,89.6 C390.381,485.3,430.58,525.5,479.98,525.5z"></path> <path d="M334.78,915.399c45.9,19.4,94.601,29.2,144.7,29.2c50.2,0,98.9-9.8,144.7-29.2c40.899-17.3,77.899-41.5,110.2-71.899 c2.699-2.5,5.399-5.101,8-7.7c21.199-21.2,39.6-44.7,55-70c9.3-15.5,17.6-31.5,24.6-48.2c19.4-45.899,29.2-94.6,29.2-144.7 c0-50.1-9.8-98.899-29.2-144.699c-2.6-6.2-5.4-12.4-8.4-18.4c-18-36.9-41.899-70.4-71.3-99.8c-18.3-18.3-38.3-34.5-59.7-48.5 c-18.5-12.1-38-22.5-58.5-31.2c-45.899-19.4-94.6-29.2-144.699-29.2c-50.2,0-98.9,9.8-144.7,29.2c-20.101,8.5-39.3,18.7-57.5,30.5 c-21.8,14.1-42.1,30.5-60.7,49.1c-29.3,29.3-53.2,62.8-71.3,99.8c-2.9,6-5.8,12.199-8.4,18.399c-19.4,45.9-29.2,94.601-29.2,144.7 s9.8,98.9,29.2,144.7c18.7,44.3,45.5,84,79.7,118.2C250.681,869.8,290.48,896.6,334.78,915.399z M271.181,409.7c2-2.5,4-5,6.1-7.4 c4.8-5.7,9.8-11.2,15.2-16.5c50-50,116.4-77.5,187.1-77.5c70.7,0,137.101,27.5,187,77.5c5.7,5.7,11.101,11.6,16.2,17.7 c1.7,2.1,3.4,4.1,5.101,6.3c36.5,46.4,56.199,103.2,56.199,163.1c0,70.7-27.5,137.101-77.5,187.101s-116.399,77.5-187,77.5 c-70.6,0-137.1-27.5-187-77.5c-50-50-77.5-116.4-77.5-187.101C214.98,512.899,234.78,456.1,271.181,409.7z"></path> </g> </g> </g></svg>
                        </span>
                        <span class="nav-link-title">Vagas</span>
                    </a>
                </li>

                <!-- Feed -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('feed.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12.552 8C11.9997 8 11.552 8.44772 11.552 9C11.552 9.55228 11.9997 10 12.552 10H16.552C17.1043 10 17.552 9.55228 17.552 9C17.552 8.44772 17.1043 8 16.552 8H12.552Z" fill="#ffffff" fill-opacity="0.5"></path> <path d="M12.552 17C11.9997 17 11.552 17.4477 11.552 18C11.552 18.5523 11.9997 19 12.552 19H16.552C17.1043 19 17.552 18.5523 17.552 18C17.552 17.4477 17.1043 17 16.552 17H12.552Z" fill="#ffffff" fill-opacity="0.5"></path> <path d="M12.552 5C11.9997 5 11.552 5.44772 11.552 6C11.552 6.55228 11.9997 7 12.552 7H20.552C21.1043 7 21.552 6.55228 21.552 6C21.552 5.44772 21.1043 5 20.552 5H12.552Z" fill="#ffffff" fill-opacity="0.8"></path> <path d="M12.552 14C11.9997 14 11.552 14.4477 11.552 15C11.552 15.5523 11.9997 16 12.552 16H20.552C21.1043 16 21.552 15.5523 21.552 15C21.552 14.4477 21.1043 14 20.552 14H12.552Z" fill="#ffffff" fill-opacity="0.8"></path> <path d="M3.448 4.00208C2.89571 4.00208 2.448 4.44979 2.448 5.00208V10.0021C2.448 10.5544 2.89571 11.0021 3.448 11.0021H8.448C9.00028 11.0021 9.448 10.5544 9.448 10.0021V5.00208C9.448 4.44979 9.00028 4.00208 8.448 4.00208H3.448Z" fill="#ffffff"></path>
                        <path d="M3.448 12.9979C2.89571 12.9979 2.448 13.4456 2.448 13.9979V18.9979C2.448 19.5502 2.89571 19.9979 3.448 19.9979H8.448C9.00028 19.9979 9.448 19.5502 9.448 18.9979V13.9979C9.448 13.4456 9.00028 12.9979 8.448 12.9979H3.448Z" fill="#ffffff"></path> </g></svg>
                        </span>
                        <span class="nav-link-title">Feed</span>
                    </a>
                </li>

                <!-- Messages -->
                <li class="nav-item">
                    <a class="nav-link" href="./messages">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">
                            <path d="M8 10.5H16M8 14.5H11M21.0039 12C21.0039 16.9706 16.9745 21 12.0039 21C9.9675 21 3.00463 21 3.00463 21C3.00463 21 4.56382 17.2561 3.93982 16.0008C3.34076 14.7956 3.00391 13.4372 3.00391 12C3.00391 7.02944 7.03334 3 12.0039 3C16.9745 3 21.0039 7.02944 21.0039 12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </span>
                        <span class="nav-link-title">Mensagens</span>
                    </a>
                </li>
                <!-- Notifications -->
                <li class="nav-item">
                    <a class="nav-link" href="./notifications">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg fill="#ffffff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 2H8C7.46957 2 6.96086 2.21071 6.58579 2.58579C6.21071 2.96086 6 3.46957 6 4H15V9H20V20H6C6 20.5304 6.21071 21.0391 6.58579 21.4142C6.96086 21.7893 7.46957 22 8 22H20C20.5304 22 21.0391 21.7893 21.4142 21.4142C21.7893 21.0391 22 20.5304 22 20V8L16 2Z"></path> <path d="M11.3245 14.4883L12.6906 15.822V16.4942H2V15.822L3.3553 14.4883V11.1597C3.28833 10.2186 3.55162 9.28363 4.09982 8.51576C4.64802 7.74789 5.44681 7.1952 6.35864 6.95288V6.4975C6.35864 6.23295 6.46373 5.97923 6.6508 5.79216C6.83787 5.60509 7.09159 5.5 7.35614 5.5C7.62069 5.5 7.87441 5.60509 8.06148 5.79216C8.24855 5.97923 8.35364 6.23295 8.35364 6.4975V6.95288C9.25835 7.20335 10.0485 7.75916 10.59 8.52597C11.1315 9.29278 11.391 10.2233 11.3245 11.1597V14.4883Z"></path>
                        <path d="M8.26662 18.1094C8.01652 18.3595 7.67731 18.5 7.32361 18.5C6.96992 18.5 6.63071 18.3595 6.3806 18.1094C6.1305 17.8593 5.99 17.5201 5.99 17.1664H8.65722C8.65722 17.5201 8.51672 17.8593 8.26662 18.1094Z"></path> </g></svg>
                        </span>
                        <span class="nav-link-title">Notificações</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
<div class="p-3 control-sidebar-content">
    {{-- <div class="p-3">
        <h5>Configuraciones</h5>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center"><a
                    href=" {{ route('conceptos') }}">Conceptos</a></li>
            <li class="list-group-item d-flex justify-content-between align-items-center"><a
                    href=" {{ route('subtipos') }}"></a></li>
            <li class="list-group-item d-flex justify-content-between align-items-center"><a href="#">Departamentos</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center"><a
                    href="{{ route('config') }}">Configuración</a></li>
        </ul>
    </div> --}}
    <h5>Configuraciones</h5>
    <ul class="nav flex-column mb-5">
        <li class="nav-item">
            <a class="nav-link active" href=" {{ route('conceptos') }}">
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="ballot-check" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                    class="svg-inline--fa fa-ballot-check fa-w-14 fa-7x" width="12">
                    <path fill="currentColor"
                        d="M112 432h32c17.7 0 32-14.4 32-32v-32c0-17.6-14.3-32-32-32h-32c-17.7 0-32 14.4-32 32v32c0 17.6 14.3 32 32 32zm0-64h32v32h-32v-32zm0-192h32c17.7 0 32-14.4 32-32v-32c0-17.6-14.3-32-32-32h-32c-17.7 0-32 14.4-32 32v32c0 17.6 14.3 32 32 32zm0-64h32v32h-32v-32zM416 0H32C14.3 0 0 14.4 0 32v448c0 17.6 14.3 32 32 32h384c17.7 0 32-14.4 32-32V32c0-17.6-14.3-32-32-32zm0 480H32V32h384v448zM216 144h128c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8H216c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8zm0 128h128c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8H216c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8zm0 128h128c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8H216c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8zm-97.4-113.6c2.1 2.1 5.5 2.1 7.6 0l64.2-63.6c2.1-2.1 2.1-5.5 0-7.6l-12.6-12.7c-2.1-2.1-5.5-2.1-7.6 0l-47.6 47.2-20.6-20.9c-2.1-2.1-5.5-2.1-7.6 0l-12.7 12.6c-2.1 2.1-2.1 5.5 0 7.6l36.9 37.4z"
                        class=""></path>
                </svg>
                Conceptos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=" {{ route('subtipos') }}">
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="clipboard-list" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                    class="svg-inline--fa fa-clipboard-list fa-w-12 fa-7x" width="12">
                    <path fill="currentColor"
                        d="M280 240H168c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm0 96H168c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zM112 232c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zM336 64h-88.6c.4-2.6.6-5.3.6-8 0-30.9-25.1-56-56-56s-56 25.1-56 56c0 2.7.2 5.4.6 8H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM192 32c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm160 432c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16h48v20c0 6.6 5.4 12 12 12h168c6.6 0 12-5.4 12-12V96h48c8.8 0 16 7.2 16 16v352z"
                        class=""></path>
                </svg> Subtipos de Codigos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('config') }}">
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="building" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                    class="svg-inline--fa fa-building fa-w-14 fa-7x" width="12">
                    <path fill="currentColor"
                        d="M192 107v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12zm116-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zm-128 96h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zm128 0h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zm-128 96h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zm128 0h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zm140 205v20H0v-20c0-6.627 5.373-12 12-12h20V24C32 10.745 42.745 0 56 0h336c13.255 0 24 10.745 24 24v456h20c6.627 0 12 5.373 12 12zm-64-12V32H64v448h128v-85c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v85h128z"
                        class=""></path>
                </svg> Departamentos
            </a>
        </li>
    </ul>
    <h6>Navbar Variants</h6>
    <div class="d-flex">
        <div class="d-flex flex-wrap mb-3">
            <div class="bg-primary elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-secondary elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-info elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-success elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-danger elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-indigo elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-purple elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-pink elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-teal elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-cyan elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-dark elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-gray-dark elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-gray elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-light elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-warning elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-white elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-orange elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
        </div>
    </div>
    {{-- <h5>Panel de Configuracion</h5>
    <hr class="mb-2" /> --}}
    <!-- <div class="mb-1"><input type="checkbox" value="1" class="mr-1" /><span>Conceptos</span></div>
    <div class="mb-1"><input type="checkbox" value="1" class="mr-1" /><span>Tipo</span></div>
    <div class="mb-1"><input type="checkbox" value="1" class="mr-1" /><span>Subtipo</span></div> -->


    {{-- <ul class="list-group">
        <li class="list-group-item list-group-item-primary">
        </li>
        <li class="list-group-item list-group-item-secondary">This is a secondary list group item</li>
        <li class="list-group-item list-group-item-success">This is a success list group item</li>
        <li class="list-group-item list-group-item-danger">This is a danger list group item</li>
        <li class="list-group-item list-group-item-warning">This is a warning list group item</li>
        <li class="list-group-item list-group-item-info">This is a info list group item</li>
        <li class="list-group-item list-group-item-light">This is a light list group item</li>
        <li class="list-group-item list-group-item-dark">This is a dark list group item</li>
    </ul> --}}

    {{-- <h6>Navbar Variants</h6>
    <div class="d-flex">
        <div class="d-flex flex-wrap mb-3">
            <div class="bg-primary elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-secondary elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-info elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-success elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-danger elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-indigo elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-purple elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-pink elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-teal elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-cyan elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-dark elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-gray-dark elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-gray elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-light elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-warning elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-white elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
            <div class="bg-orange elevation-2"
                style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
            </div>
        </div>
    </div>
    <h6>Accent Color Variants</h6>
    <div class="d-flex"></div>
    <div class="d-flex flex-wrap mb-3">
        <div class="bg-primary elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-warning elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-info elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-danger elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-success elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-indigo elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-navy elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-purple elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-fuchsia elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-pink elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-maroon elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-orange elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-lime elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-teal elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
        <div class="bg-olive elevation-2"
            style="width: 40px; height: 20px; border-radius: 25px; margin-right: 10px; margin-bottom: 10px; opacity: 0.8; cursor: pointer;">
        </div>
    </div> --}}
</div>

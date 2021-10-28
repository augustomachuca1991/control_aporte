<div class="p-3 control-sidebar-content">
    <h5>Panel de Configuracion</h5>
    <hr class="mb-2" />
    <!-- <div class="mb-1"><input type="checkbox" value="1" class="mr-1" /><span>Conceptos</span></div>
    <div class="mb-1"><input type="checkbox" value="1" class="mr-1" /><span>Tipo</span></div>
    <div class="mb-1"><input type="checkbox" value="1" class="mr-1" /><span>Subtipo</span></div> -->
    <ul>
        <li><a href=" {{ route('conceptos') }}">Conceptos</a></li>
        <li><a href=" {{ route('subtipos') }}">Subtipos de Codigos</a></li>
        <li><a href="#">Departamentos</a></li>
        <li><a href="#">Configuración</a></li>
        {{-- <li><a href=" {{ route('tipos') }}">Tipo de Codigos</a></li> --}}
    </ul>

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
    </div>
</div>

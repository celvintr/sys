<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Consultar </h5>
    </x-slot>

    <div class="row">
        <div class="col">

            <form class="form">
                <div class="card card-custom">
                    <div class="card-header card-header-tabs-line">
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                        <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                                        <span class="nav-text">Datos Generales</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                                        <span class="nav-icon"><i class="flaticon2-drop"></i></span>
                                        <span class="nav-text">Dirección</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>DNI</label>
                                                <div class="input-group input-group-lg">
                                                    <input type="text" class="form-control text-bold" maxlength="13" placeholder="Buscar..."/>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-secondary" type="button">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="alert alert-custom alert-default" role="alert">
                                                    <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                                                    <div class="alert-text">
                                                        Buttons in input groups must wrapped in a <code>.input-group-prepend</code> or <code>.input-group-append</code> for proper alignment and sizing.
                                                      This is required due to default browser styles that cannot be overridden.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Full Name:</label>
                                        <input type="email" class="form-control form-control-solid" placeholder="Enter full name"/>
                                        <span class="form-text text-muted">Please enter your full name</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Email address:</label>
                                        <input type="email" class="form-control form-control-solid" placeholder="Enter email"/>
                                        <span class="form-text text-muted">Well never share your email with anyone else</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Subscription</label>
                                        <div class="input-group input-group-lg">
                                            <div class="input-group-prepend"><span class="input-group-text" >$</span></div>
                                            <input type="text" class="form-control form-control-solid" placeholder="99.9"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Communication:</label>
                                        <div class="checkbox-list">
                                            <label class="checkbox">
                                                <input type="checkbox"/>
                                                <span></span>
                                                Email
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox"/>
                                                <span></span>
                                                SMS
                                            </label>
                                            <label class="checkbox">
                                                <input type="checkbox"/>
                                                <span></span>
                                                Phone
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="reset" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                                ...
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

    @push('scripts')
    @endpush

    @push('styles')
    @endpush
</x-app-layout>

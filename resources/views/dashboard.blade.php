<x-app-layout>
    
    <x-slot name="header" >
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Tablero  
            <span style="color:#a1a5b7!important;font-size:.95rem!important"> | Administración </span>
        </h5>    
    </x-slot>

    <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset('metronic/media/bg/bg-3.jpg') }}'); width:100%; height:100%;">
        <div class="text-center p-5  position-relative ">
             <div class="d-flex flex-center mb-15">
                <a href="#">
                    <img src="{{ asset('metronic/media/logos/logo-letter-13.png') }}" class="max-h-75px" alt="" />
                </a>
            </div>
 
             <div class="login-signin">
                <div class="mb-20">

                   <h1> Sistema de gestión de custodios electorales </h1>
                     
                 </div>
 
 
            </div>
         </div>
    </div>

     
</x-app-layout>

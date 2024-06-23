<x-base-layout>

    <section>
        <div class="container">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
            <div class="row ">
                <div class="col-md-12 row">
                    <div class="card border shadow-sm p-3 mb-5 bg-body rounded">
                        <div class="card-body py-3 px-5">

                            @include('pages.admin.patient._appointment-billing-details')

                            <hr />

                            @include('pages.admin.patient._appointment-billing-figmadetails')

                            <hr/>

                            @include('pages.admin.patient._appointment-billing-consulting-charges')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>



</x-base-layout>

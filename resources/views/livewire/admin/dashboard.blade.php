<div>
    <x-slot name="title">
        Tablero
    </x-slot>

    <x-slot name="header">
        Tablero de Administrador
    </x-slot>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Nota + leída</h3>
                    <p>{{$mostViewedPost == null ? 'No hay nota publicada por el momento' : $mostViewedPost->title }}</p>
                </div>
                {{-- <div class="icon">
                    <i class="ion ion-newspaper-outline"></i>
                </div> --}}
                <a href="{{$mostViewedPost == null ? '#' : route('detail', ['id' => $mostViewedPost->id]) }}"
                    target="_blank" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Nota + leída/mes</h3>
                    <p>{{$mostViewedPostThisMonth== null? 'No hay nota publicada' : $mostViewedPostThisMonth->title }}</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-briefcase"></i> --}}
                </div>
                <a href="{{$mostViewedPostThisMonth== null ? '#' : route('detail', ['id' => $mostViewedPostThisMonth->id]) }}"
                    target="_blank" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Notas/mes</h3>
                    <p>Total de noticias publicadas este mes: {{ $totalPostsPublishedThisMonth }}</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-document"></i> --}}
                </div>
                <a href="{{ route('admin.post') }}" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Visitas/mes</h3>
                    <p>Total de visitas en todas las notas mensuales: {{ $totalViewsThisMonth }}</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-pie-graph"></i> --}}
                </div>
                <a href="{{ route('admin.post') }}" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Total Visitas</h3>
                    <p>Histórico del total de visitas de las notas: {{ $totalViews }}</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-plus"></i> --}}
                </div>
                <a href="{{ route('admin.post') }}" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Notas totales</h3>
                    <p>Se han publicado un total de: {{ $totalPosts }} notas en el proyecto</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-checkmark"></i> --}}
                </div>
                <a href="{{ route('admin.post') }}" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Usuarios</h3>
                    <p>Se encuentran registrados un total de: {{ $totalUsers }} usuarios</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-ios-book"></i> --}}
                </div>
                <a href="{{ route('admin.post') }}" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Sub categoría</h3>
                    <p>La subcategoría con más vistas es: {{ $mostViewedSubCategory->subcategory->name }}</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-sad"></i> --}}
                </div>
                <a href="{{ route('admin.post') }}" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
</div>
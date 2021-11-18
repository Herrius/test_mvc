
document.addEventListener( 'DOMContentLoaded', function () {
    new Splide( '#carrusel',{
        type   : 'no-loop',
        perPage: 4,
        perMove: 4,
        pagination:false,
    } ).mount();
} );

circliful.newCircleWithDataSet('activo', 'simple');
circliful.newCircleWithDataSet('reflexivo', 'simple');
circliful.newCircleWithDataSet('sensorial', 'simple');
circliful.newCircleWithDataSet('intuitivo', 'simple');
circliful.newCircleWithDataSet('visual', 'simple');
circliful.newCircleWithDataSet('verbal', 'simple');
circliful.newCircleWithDataSet('global', 'simple');
circliful.newCircleWithDataSet('secuencial', 'simple');

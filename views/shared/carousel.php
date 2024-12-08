<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="views/shared/uploads/cursel1.png" class="d-block w-100 custom-carousel-image" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img src="views/shared/uploads/cursel2.png" class="d-block w-100 custom-carousel-image" alt="Slide 2">
        </div>
        <div class="carousel-item">
            <img src="views/shared/uploads/cursel3.png" class="d-block w-100 custom-carousel-image" alt="Slide 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon custom-arrow" aria-hidden="true"></span>
        <span class="visually-hidden"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon custom-arrow" aria-hidden="true"></span>
        <span class="visually-hidden"></span>
    </button>
</div>

<style>
    .custom-carousel-image {
        max-height: 600px;
        object-fit: cover;
    }

    #carouselExampleIndicators {
        max-width: 100%;
        max-height: 600px;
        margin: 0 auto;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: transparent; 
        background-size: contain; 
    }

    .carousel-control-prev-icon {
        background-image: url('https://cdn-icons-png.flaticon.com/512/271/271220.png'); 
    }

    .carousel-control-next-icon {
        background-image: url('https://cdn-icons-png.flaticon.com/512/271/271228.png'); 
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 50px; 
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

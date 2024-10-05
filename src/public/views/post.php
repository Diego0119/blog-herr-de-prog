<?php include('../../header.php'); ?>

<body>

<?php include('../../navbar.php'); ?>

<div class="container mt-4">

    <button type="button" class="btn custom-btn">Volver</button>

    <div class="row my-2">

        <div class="col-9">
            <div class='border p-2 text-center rounded shadow-sm post-card'>
                <p class="fs-1 fw-bold post-title">Título del Post</p>
            </div>
            <div class='border p-2 my-2 text-center rounded shadow-sm post-card'>
                <img src="https://placehold.co/800x600" class="rounded my-2 img-fluid" alt="Post Image">
            </div>
            <div class='border p-2 text-justify rounded shadow-sm post-card'>
                <p class="text-justify post-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae iusto
                    maiores cumque aspernatur incidunt ex nam quo recusandae, possimus autem, aperiam quisquam sint
                    quod dolorum esse tenetur ab rem vero.</p>   
            </div>
        </div>

        <div class="col-3 sidebar-creadores">
            <div class="border p-4 rounded">
                <h5 class="fw-bold">Post Recientes</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-dark">Post 1</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Post 2</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Post 3</a></li>
                    </ul>
            </div>
            <button type="button" class="btn custom-btn">Siguiente post</button>  
        </div>
    
    </div>     

</div>
<div class="container">
    <h4>Calificación:</h4>
    <div class="star-rating">
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
    </div> <!-- Estaba probando para ponerle que los usuarios califiquen, por lo que vi se necesita js asi que ahi voy a ver como es XD -->
</div>

</body>

<?php include('../../footer.php'); ?>
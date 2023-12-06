<?php include("templete/cabecera.php"); ?>
            <div class="jumbotron">
                <h1 class="display-3">BETTERBOOKS</h1>
                <p class="lead">Empresa dedica a la venta de libros</p>
                <hr class="my-2">
            </div>
            <?php
            // Datos de la empresa
            $nombreEmpresa = "Librería BETTERBOOKS";
            $vision = "VISIÓN";
            $mision = "MISIÓN";
            $visionEmpresa = "Ser la principal fuente de inspiración y conocimiento para nuestros clientes, ofreciendo una selección diversa y de calidad de libros que promueva la cultura, la educación y el enriquecimiento personal.";
            $misionEmpresa = "Proporcionar un espacio acogedor y estimulante donde los lectores encuentren una amplia variedad de libros que satisfagan sus intereses y necesidades. Nuestro compromiso es fomentar el amor por la lectura, impulsar el pensamiento crítico y contribuir al crecimiento intelectual y cultural de nuestra comunidad.";

            // Mostrar la información en la página
            echo "<h2>$nombreEmpresa</h2>";
            echo "<br><br><h3>$vision</h3>";
            echo "<p>$visionEmpresa<p>";
            echo "<h3>$mision</h3>";
            echo "<p>$misionEmpresa</p>";
            ?>
<?php include("templete/pie.php"); ?>
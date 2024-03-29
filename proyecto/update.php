<!DOCTYPE html>
<html style="font-size: 16px">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <script src="../librerias/materialize/jquery-3.4.0.min.js"></script>
    <script src="../librerias/materialize/js/materialize.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Administracion</title>
    <link rel="stylesheet" href="estilos.css" media="screen" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body class="container">
    <div class="container-fluid" aling="center">
        <div class="formulario">
            <a class="btn btn-primary" href="index.php">INICIO</a>
            <a class="btn btn-primary" href="crear.php">CREAR</a>
            <a class="btn btn-primary" href="leer.php">LEER</a>


            <!-- Inicia codigo actualizar cliente-->

            <?php
            // Creamos la conexión

            $servername = "localhost";
            $database = "crud";
            $username = "root";
            $password = "unad2021";

            $conexion = mysqli_connect($servername, $username, $password, $database);

            //Tomando datos por ID desde la pagina "leer.php"

            if (isset($_GET['id'])) {

                $id = $_GET['id'];

                $sql = "SELECT * FROM games WHERE id = '$id'";

                $resultado = mysqli_query($conexion, $sql);

                if (mysqli_num_rows($resultado) > 0) {
                    $row = mysqli_fetch_array($resultado);
                    $id = $row['id'];
                    $genero = $row['genero'];
                    $nombrejuego = $row['name'];
                    $fechalanzamiento = $row['añolanzamiento'];
                    $tipoconsola = $row['console'];
                    $desarrollador =  $row['desarrollador'];
                }
            }
            ?>
            <!-- Formulario para actualizar datos -->


            <h2>Actualización de juego</h2>
            <form action="update.php?id=<?php echo $_GET['id']; ?>" method="post">
                <p>ID: <br><input type="text" name="id" value="<?php echo $id; ?>" readonly class="form-control-plaintext"></p>
                <p>Nombre del Juego: <br><input type="text" name="NombreJuego" value="<?php echo $nombrejuego; ?>"></p>

                <p>Género: <br><select name="Genero" value="<?php echo $genero; ?>">
                        <option>Acción</option>
                        <option>Arcade</option>
                        <option>Deportivo</option>
                        <option>Estrategia</option>
                        <option>Simulación</option>

                    </select></p>

                <p>Tipo de Consola: <br><select name="TipoConsola" value="<?php echo $tipoconsola; ?>">
                        <option>Xbox</option>
                        <option>PlayStation</option>
                        <option>PC</option>
                    </select></p>

                <p>Fecha de Lanzamiento: <br><input type="date" name="FechaLanzamiento" value="<?php echo $fechalanzamiento; ?>"></p>

                <p>Desarrollador: <br><input type="text" name="Desarrollador" value="<?php echo $desarrollador; ?>"></p>
                <input type="submit" value="Actualizar" name="update" class="btn btn-success">
                <a class="btn btn-dark" href='javascript:history.go(-1)'>Volver</a>


                <br>


            </form>


            <?php
            //Nuevos datos tomados desde el formulario anterior

            if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $genero = $_POST['Genero'];
                $nombrejuego = $_POST['NombreJuego'];
                $fechalanzamiento = $_POST['FechaLanzamiento'];
                $tipoconsola = $_POST['TipoConsola'];
                $desarrollador =  $_POST['Desarrollador'];

                //Nuevos valores a actualizar en la BD

                $sql = "UPDATE games SET name = '$nombrejuego', genero = '$genero',
    console = '$tipoconsola', añolanzamiento = '$fechalanzamiento', desarrollador = '$desarrollador' WHERE id = '$id'";


                mysqli_query($conexion, $sql);

                if ($resultado == true) {
                    echo "Registros actualizados correctamente";
                } else {
                    echo "Error: " . $sql . "<br>" . $conexion->error;
                }
                mysqli_close($conexion);
                header("location:leer.php");
            }

            ?>



        </div>
        <footer class="pie">
            <div class="pie">
                <h4>GRUPO 5415646_xX</h4>
                <h5>Auto Text es una forma de almacenar partes de un documento de Word que está disponible para su uso en cualquier documento. En otras palabras, con las entradas de Texto automático que ha almacenado, no necesita escribir el mismo contenido una y otra vez. Pero, ¿cómo podemos usar las entradas de Auto Text rápidamente? Kutools for Word, Panel de Autotexto puede guardar, leer e insertar entradas de autotexto fácilmente en el documento.</h5>
            </div>
        </footer>

        <script>
            $(".nav").find("li").click(function() {
                $(".nav li").removeClass('nav_activa')
                $(this).addClass('nav_activa')
            })
        </script>


    </div>

</body>

</html>
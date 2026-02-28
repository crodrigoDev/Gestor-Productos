<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Gestor de Productos - Elektroniko</title>
</head>
<body>
    <div class="container-lg d-flex justify-content-between align-items-center mb-3 mt-3">
        <h1>
            Lista de Productos
        </h1>
        <a href="index.php?action=agregarview" class="btn btn-success btn-sm">
            <i class="bi bi-plus-lg text-white "> AGREGAR</i>
        </a>
    </div>
    <div class="container-lg">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <td>ID</td>
                    <td>NOMBRE</td>
                    <td>MARCA</td>
                    <td>DESCRIPCION</td>
                    <td>PRECIO</td>
                    <td>STOCK</td>
                    <td>ESTADO</td>
                    <td>EDITAR</td>
                    <td>ELIMINAR</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto){ ?>
                <tr>
                    <td><?php echo $producto['id_prod']?></td>
                    <td><?php echo $producto['nombre_prod']?></td>
                    <td><?php echo $producto['marca_prod']?></td>
                    <td><?php echo $producto['desc_prod']?></td>
                    <td><?php echo $producto['precio']?></td>
                    <td><?php echo $producto['stock']?></td>
                    <td class="text-center">
                        <a href="index.php?action=<?= $producto['estado'] ? 'desactivar' : 'activar' ?>&id_prod=<?= $producto['id_prod'] ?>"
                           class="badge <?= $producto['estado'] ? 'bg-success' : 'bg-danger' ?> text-decoration-none">
                            <?= $producto['estado'] ? 'Activo' : 'Inactivo' ?>
                        </a>
                    </td>
                    <td class="text-center">
                        <span>
                            <a href="index.php?action=editarview&id_prod=<?php echo $producto['id_prod']?>
                            " class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square" style="color: black;"></i>
                            </a>
                        </span>
                    </td>
                    <td class="text-center">
                        <span>
                            <a href="index.php?action=eliminar&id_prod=<?php echo $producto['id_prod']?>
                            " class="btn btn-danger btn-sm">
                                <i class="bi bi-archive-fill" style="color: black;"></i>
                            </a>
                        </span>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
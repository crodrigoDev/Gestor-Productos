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
    <div class="container-lg d-flex gap-4 align-items-center mb-3 mt-3">
        <a href="index.php?action=listar" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left text-white"></i>
        </a>
        <h1>
            Editar Producto
        </h1>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="index.php?action=editar" method="POST">
                    <input type="hidden" name="id_prod" value="<?php echo $producto['id_prod'] ?>">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre_prod" maxlength="50" 
                            value="<?php echo $producto['nombre_prod'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca_prod" maxlength="50" 
                            value="<?php echo $producto['marca_prod'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="desc_prod" rows="3" maxlength="200" required><?php echo $producto['desc_prod'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" 
                                value="<?php echo $producto['precio'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" min="0"
                                value="<?php echo $producto['stock'] ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="estado" name="estado"
                            <?php echo isset($producto) && $producto['estado'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="estado">Activo</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Actualizar Producto</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
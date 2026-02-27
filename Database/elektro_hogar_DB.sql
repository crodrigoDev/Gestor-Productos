CREATE DATABASE IF NOT EXISTS elektroniko;
USE elektroniko;

CREATE TABLE producto(
	id_prod int primary key auto_increment,
    nombre_prod char(50) not null,
    marca_prod char(50) not null,
    desc_prod char(200) not null,
    precio decimal(10, 2) not null,
    stock int not null,
    estado bool not null
);
    
INSERT producto (nombre_prod, marca_prod, desc_prod, precio, stock, estado) values 
	-- Televisores
	("Smart TV 55'' 4K", "Samsung", "Televisor UHD con HDR y apps integradas", 1800.00, 15, TRUE),
	("LED 32'' HD", "LG", "Televisor compacto ideal para dormitorios", 750.00, 25, TRUE),

	-- Celulares
	("Galaxy S23", "Samsung", "Smartphone con cámara triple y 256GB", 3500.00, 10, TRUE),
	("iPhone 14", "Apple", "Pantalla OLED y chip A15 Bionic", 4200.00, 8, TRUE),

	-- Hornos
	("Horno Eléctrico 45L", "Oster", "Horno multifunción con temporizador", 550.00, 20, TRUE),
	("Microondas 30L", "Panasonic", "Microondas con grill y descongelado rápido", 480.00, 18, TRUE),

	-- Aspiradoras
	("Aspiradora Robot", "Xiaomi", "Robot aspirador con mapeo inteligente", 1200.00, 12, TRUE),
	("Aspiradora Vertical", "Dyson", "Potente aspiradora inalámbrica", 2200.00, 7, TRUE),

	-- Refrigeradoras
	("Refrigeradora No Frost 350L", "Samsung", "Refrigeradora con dispensador de agua", 2800.00, 9, TRUE),
	("Refrigeradora 2 puertas 400L", "LG", "Amplio espacio y eficiencia energética A+", 3100.00, 6, TRUE);
    
DELIMITER $$

-- Crear producto
CREATE PROCEDURE sp_crear_producto(
    IN p_nombre_prod CHAR(50),
    IN p_marca_prod CHAR(50),
    IN p_desc_prod CHAR(200),
    IN p_precio DECIMAL(10,2),
    IN p_stock INT,
    IN p_estado BOOL
)
BEGIN
    INSERT producto (nombre_prod, marca_prod, desc_prod, precio, stock, estado)
    VALUES (p_nombre_prod, p_marca_prod, p_desc_prod, p_precio, p_stock, p_estado);
END$$

-- Listar productos
CREATE PROCEDURE sp_listar_productos()
BEGIN
    SELECT
        id_prod,
        nombre_prod,
        marca_prod,
        desc_prod,
        precio,
        stock,
        estado
	FROM producto;
END$$

-- Obtener producto por id
CREATE PROCEDURE sp_obtener_producto(
    IN p_id_prod INT
)
BEGIN
    SELECT
        id_prod,
        nombre_prod,
        marca_prod,
        desc_prod,
        precio,
        stock,
        estado
	FROM producto
    WHERE id_prod = p_id_prod;
END$$

-- Actualizar producto
CREATE PROCEDURE sp_actualizar_producto(
    IN p_id_prod INT,
    IN p_nombre_prod CHAR(50),
    IN p_marca_prod CHAR(50),
    IN p_desc_prod CHAR(200),
    IN p_precio DECIMAL(10,2),
    IN p_stock INT,
    IN p_estado BOOL
)
BEGIN
    UPDATE producto
    SET
        nombre_prod = p_nombre_prod,
        marca_prod = p_marca_prod,
        desc_prod = p_desc_prod,
        precio = p_precio,
        stock = p_stock,
        estado = p_estado
    WHERE id_prod = p_id_prod;
END$$

-- Cambiar estado de producto
CREATE PROCEDURE sp_cambiar_estado_producto(
    IN p_id_prod INT,
    IN p_estado BOOL
)
BEGIN
    UPDATE producto SET estado = p_estado WHERE id_prod = p_id_prod;
END$$

-- Eliminar producto
CREATE PROCEDURE sp_eliminar_producto(
	IN p_id_prod INT
)
BEGIN
	DELETE FROM producto WHERE id_prod = p_id_prod;
END $$

DELIMITER ;
/*
-- PRODUCTO
CALL sp_crear_producto('Galaxy A54', 'Samsung', 'Smartphone gama media con 128GB', 1500.00, 20, TRUE);
CALL sp_listar_productos();
CALL sp_obtener_producto(1);
CALL sp_actualizar_producto(11, 'Galaxy A54 Pro', 'Samsung', 'Smartphone gama media con 256GB', 1700.00, 18, TRUE);
CALL sp_cambiar_estado_producto(11, FALSE);
CALL sp_eliminar_producto(11);
*/

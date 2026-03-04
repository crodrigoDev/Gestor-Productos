<?php

use PHPUnit\Framework\TestCase;

class ProductoTest extends TestCase
{
    private ?ProductoModel $modelo = null;

    protected function setUp(): void
    {
        $reflection = new ReflectionClass(DatabaseConnection::class);
        $prop = $reflection->getProperty('instance');
        $prop->setAccessible(true);
        $prop->setValue(null, null);

        $this->modelo = new ProductoModel();
    }

    // Busca un producto por nombre en la lista
    private function buscarPorNombre(string $nombre): ?array
    {
        foreach ($this->modelo->listar() as $p) {
            if ($p['nombre_prod'] === $nombre) return $p;
        }
        return null;
    }

    // Test: agregar() - Crear un producto
    public function testAgregar(): void
    {
        $this->modelo->agregar('Test Crear', 'Marca Test', 'Descripcion test', 100.00, 5, 1);
        $producto = $this->buscarPorNombre('Test Crear');

        $this->assertNotNull($producto);
        $this->assertEquals('Test Crear', $producto['nombre_prod']);
        $this->assertEquals('Marca Test', $producto['marca_prod']);
        $this->assertEquals(100.00, (float) $producto['precio']);
        $this->assertEquals(5, (int) $producto['stock']);
        $this->assertEquals(1, (int) $producto['estado']);

        $this->modelo->eliminar($producto['id_prod']);
    }

    // Test: listar() - Obtener todos los productos
    public function testListar(): void
    {
        $this->modelo->agregar('Test Listar', 'Marca', 'Desc', 50.00, 1, 1);
        $productos = $this->modelo->listar();

        $this->assertIsArray($productos);
        $this->assertNotEmpty($productos);
        $this->assertArrayHasKey('id_prod', $productos[0]);
        $this->assertArrayHasKey('nombre_prod', $productos[0]);

        $prod = $this->buscarPorNombre('Test Listar');
        $this->modelo->eliminar($prod['id_prod']);
    }

    // Test: listar_prod() - Obtener un producto por ID
    public function testListarProd(): void
    {
        $this->modelo->agregar('Test ObtenerUno', 'Marca', 'Desc', 75.00, 3, 1);
        $creado = $this->buscarPorNombre('Test ObtenerUno');
        $id = $creado['id_prod'];

        $producto = $this->modelo->listar_prod($id);

        $this->assertIsArray($producto);
        $this->assertEquals($id, $producto['id_prod']);
        $this->assertEquals('Test ObtenerUno', $producto['nombre_prod']);

        $this->modelo->eliminar($id);
    }

    // Test: editar() - Actualizar un producto
    public function testEditar(): void
    {
        $this->modelo->agregar('Test Editar', 'Marca Orig', 'Desc orig', 80.00, 4, 1);
        $creado = $this->buscarPorNombre('Test Editar');
        $id = $creado['id_prod'];

        $this->modelo->editar($id, 'Editado', 'Marca Nueva', 'Desc nueva', 150.00, 10, 0);
        $producto = $this->modelo->listar_prod($id);

        $this->assertEquals('Editado', $producto['nombre_prod']);
        $this->assertEquals('Marca Nueva', $producto['marca_prod']);
        $this->assertEquals(150.00, (float) $producto['precio']);
        $this->assertEquals(10, (int) $producto['stock']);
        $this->assertEquals(0, (int) $producto['estado']);

        $this->modelo->eliminar($id);
    }

    // Test: cambiarEstado() - Activar/Desactivar producto
    public function testCambiarEstado(): void
    {
        $this->modelo->agregar('Test Estado', 'Marca', 'Desc', 60.00, 2, 1);
        $creado = $this->buscarPorNombre('Test Estado');
        $id = $creado['id_prod'];

        // Desactivar
        $this->modelo->cambiarEstado($id, 0);
        $producto = $this->modelo->listar_prod($id);
        $this->assertEquals(0, (int) $producto['estado']);

        // Activar
        $this->modelo->cambiarEstado($id, 1);
        $producto = $this->modelo->listar_prod($id);
        $this->assertEquals(1, (int) $producto['estado']);

        $this->modelo->eliminar($id);
    }

    // Test: eliminar() - Borrar un producto
    public function testEliminar(): void
    {
        $this->modelo->agregar('Test Eliminar', 'Marca', 'Desc', 40.00, 1, 1);
        $creado = $this->buscarPorNombre('Test Eliminar');
        $id = $creado['id_prod'];

        $this->modelo->eliminar($id);

        $producto = $this->modelo->listar_prod($id);
        $this->assertNull($producto);
    }

    // Limpieza de seguridad
    public static function tearDownAfterClass(): void
    {
        try {
            $cn = new mysqli('localhost', 'root', '', 'elektroniko');
            $nombres = ['Test Crear', 'Test Listar', 'Test ObtenerUno', 'Test Editar', 'Editado', 'Test Estado', 'Test Eliminar'];
            foreach ($nombres as $n) {
                $cn->query("DELETE FROM producto WHERE nombre_prod = '" . $cn->real_escape_string($n) . "'");
            }
            $cn->close();
        } catch (\Exception $e) {}
    }
}
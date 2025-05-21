# Documentación del Proyecto de Microservicios con CodeIgniter

## Descripción General
Este proyecto es una prueba de concepto de una Arquitectura de Microservicios construida usando CodeIgniter 3, desarrollada siguiendo los principios de Test Driven Development (TDD). El sistema está compuesto por tres servicios principales descoplados que se comunican entre sí mediante colas RabbitMQ.

## Arquitectura del Sistema

### Servicios Principales
1. **Servicio Financiero** (Puerto 8081)
   - Gestión de facturas
   - API REST para operaciones CRUD de facturas
   - Base de datos MySQL independiente

2. **Servicio de Órdenes** (Puerto 8082)
   - Gestión de órdenes de compra
   - Base de datos MySQL independiente

3. **Servicio de Almacén** (Puerto 8083)
   - Gestión de inventario
   - Base de datos MySQL independiente

### Comunicación entre Servicios
- Los servicios se comunican de forma asíncrona mediante RabbitMQ
- Cada servicio tiene su propio worker que se suscribe a las colas relevantes
- La comunicación entre servicios se realiza mediante helpers que envían mensajes a través de AMQP

## Requisitos del Sistema

### Requisitos Obligatorios
- Docker
- Docker Compose
- Composer

### Componentes (incluidos en Docker)
- Apache HTTP Server
- PHP 7.3+ (compatible con PHP 8.0)
- MySQL 8.0
- RabbitMQ

## Instalación y Configuración

### Instalación de Dependencias
**Método Recomendado (usando script)**
```bash
chmod +x ./install-dependency.sh
./install-dependency.sh
```

**Instalación Manual**
```bash
cd financial && composer install
cd ../order && composer install
cd ../warehouse && composer install
```

### Iniciar el Sistema
```bash
docker-compose up
```

Nota: Es normal que el contenedor PHP falle algunas veces al inicio mientras espera que el contenedor de RabbitMQ esté listo.

### Migración de Base de Datos
Acceder a las siguientes rutas para iniciar la migración en cada servicio:
```
http://localhost:8081/tdd-microservice-poc/index.php/migrate
http://localhost:8082/tdd-microservice-poc/index.php/migrate
http://localhost:8083/tdd-microservice-poc/index.php/migrate
```

## API Reference

### Servicio Financiero (Financial Service)

#### Facturas

##### Listar Facturas
- **GET** `localhost:8081/tdd-microservice-poc/index.php/api/v1/invoices`
- Retorna lista de todas las facturas

##### Crear Nueva Factura
- **POST** `localhost:8081/tdd-microservice-poc/index.php/api/v1/invoices`
- Body de la Petición:
```json
{
    "order_id": "1",
    "total": "10000",
    "status": "incomplete"
}
```

##### Obtener Factura Específica
- **GET** `localhost:8081/tdd-microservice-poc/index.php/api/v1/invoices/{invoice_id}`

##### Actualizar Factura
- **PUT** `localhost:8081/tdd-microservice-poc/index.php/api/v1/invoices/{invoice_id}`
- Body de la Petición:
```json
{
    "status": "waiting"
}
```

##### Eliminar Factura
- **DELETE** `localhost:8081/tdd-microservice-poc/index.php/api/v1/invoices/{invoice_id}`

## Estructura del Proyecto

```
codeigniter-microservice/
├── docker-compose.yaml     # Configuración de contenedores
├── Dockerfile             # Configuración de imagen Docker
├── install-dependency.sh  # Script de instalación de dependencias
│
├── financial/            # Servicio Financiero
│   ├── application/
│   │   ├── controllers/  # Controladores REST
│   │   ├── models/      # Modelos de datos
│   │   └── config/      # Configuraciones
│   └── start_worker.sh   # Script de inicio del worker
│
├── order/               # Servicio de Órdenes
│   └── application/
│       └── ...
│
└── warehouse/          # Servicio de Almacén
    └── application/
        └── ...
```

## Workers y Procesamiento Asíncrono
Cada servicio tiene su propio worker que se ejecuta continuamente para procesar mensajes de la cola. Los workers se inician automáticamente cuando se usa docker-compose. Si no se usa Docker, se pueden iniciar manualmente ejecutando el script `start_worker.sh` en cada directorio de servicio.

## Pruebas
El proyecto está desarrollado siguiendo TDD (Test Driven Development). Cada servicio tiene su propia suite de pruebas ubicada en el directorio `application/tests/`.

## Consideraciones de Desarrollo
1. Cada servicio es completamente independiente con su propia base de datos
2. La comunicación entre servicios es asíncrona a través de RabbitMQ
3. Se sigue el patrón REST para las APIs
4. Las pruebas son una parte fundamental del desarrollo

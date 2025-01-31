# - VFH Mini CRM -

For English version, see [README_EN.md](README_EN.md)

## Descripción

**VFH Mini CRM** es un sistema sencillo que implementa las funcionalidades básicas de un CRM. 
Este sistema sigue el **patrón repositorio**, lo que permite manejar el flujo de datos de forma organizada y eficiente.

### Características principales:
- Implementación del patrón repositorio.
- CRUD completo para todos los módulos.
- Validaciones y métodos específicos en cada módulo.
- Autenticación con **Laravel UI** (Login y Registro).
- Diseño basado en plantilla **AdminLTE**.
- Módulos principales:
  - **Clientes**
  - **Contactos**
  - **Actividades**
  - **Oportunidades**
  - **Usuarios**
- No cuenta con sistema de roles por el momento.

## Requisitos del Sistema

Para ejecutar **VFH Mini CRM**, asegúrate de contar con los siguientes requisitos:

- **Servidor Web**: Apache/Nginx
- **PHP**: Versión 8.2 o superior
- **Composer**: Última versión
- **NodeJS**: Versión 18 o superior
- **MySQL**: Versión 5.8 o superior

## Instalación

### 1. Clonar el repositorio
```bash
  git clone https://github.com/vfaundez-dev/mini-crm.git
  cd vfh-mini-crm
```

### 2. Configurar entorno
Copiar el archivo de entorno y configurar los parámetros necesarios:
```bash
cp .env.example .env
```

Modificar las credenciales de la base de datos en el archivo `.env`:
```env
DB_HOST=tu_host
DB_DATABASE=vfh_mini_crm
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 3. Instalar dependencias
```bash
composer install
npm install
```

### 4. Generar clave de aplicación
```bash
php artisan key:generate
```

### 5. Crear la base de datos
Asegúrate de que la base de datos **vfh_mini_crm** esté creada en MySQL.

### 6. Ejecutar migraciones y seeders
```bash
php artisan migrate --seed
```

### 7. Instalar AdminLTE y plugins asociados
```bash
npm run build
```

### 8. Iniciar servidores
Iniciar servidor de desarrollo para AdminLTE:
```bash
npm run dev
```

Iniciar servidor de Laravel:
```bash
php artisan serve
```

## Uso
Accede al sistema a través de: [http://localhost:8000](http://localhost:8000) o tu host configurado.

## Licencia

![Creative Commons License](https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png)  
Este proyecto está licenciado bajo la [Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License](https://creativecommons.org/licenses/by-nc-nd/4.0/).

### Resumen
- **Atribución**: Debe proporcionar crédito adecuado al autor original.
- **No Comercial**: No puede utilizar el material para fines comerciales.
- **Sin Derivados**: Si remezcla, transforma o crea a partir del material, no puede distribuir el material modificado.

Para más detalles, consulte el archivo `LICENSE` incluido en este repositorio.

---
Desarrollado y mantenido por **© 2025 Vladimir Faundez Hernández. Todos los derechos reservados.**

🗺️ Sistema de Gestión de Rutas - Panamá
📋 Tabla de Contenidos
Descripción del Proyecto

Características Principales

Tecnologías Utilizadas

Instalación y Configuración

Estructura del Proyecto

Funcionalidades Detalladas

Algoritmos Implementados

Interfaz de Usuario

Casos de Uso

Documentación Técnica

Contribuciones

Licencia

Autor

Agradecimientos

🎯 Descripción del Proyecto
Sistema de Gestión de Rutas es una aplicación web desarrollada en PHP que implementa un grafo no dirigido para la gestión y visualización de rutas entre ciudades de Panamá. Este proyecto fue desarrollado como parte de la materia de Estructuras de Datos y demuestra la implementación práctica de algoritmos fundamentales de grafos en un contexto real.

Objetivos Principales
Implementar una estructura de datos de grafo eficiente

Demostrar el funcionamiento de algoritmos clásicos de grafos

Crear una interfaz visual profesional para la interacción

Proporcionar una herramienta educativa para el estudio de estructuras de datos

Mostrar la aplicación práctica de conceptos teóricos

✨ Características Principales
🏗️ Estructuras de Datos Implementadas
Grafo No Dirigido con lista de adyacencia

Matriz de Adyacencia para representación alternativa

Algoritmo de Dijkstra para cálculo de rutas más cortas

BFS (Breadth-First Search) para recorrido en anchura

DFS (Depth-First Search) para recorrido en profundidad

🚀 Funcionalidades del Sistema
✅ Gestión completa de ciudades (agregar/eliminar)

✅ Conexiones configurables entre ciudades con distancias

✅ Cálculo de rutas más cortas usando Dijkstra

✅ Recorridos BFS y DFS desde cualquier ciudad

✅ Visualización dual (lista y matriz de adyacencia)

✅ Mapa interactivo de Panamá

✅ Estadísticas en tiempo real del grafo

✅ Sistema de persistencia con sesiones PHP

✅ Interfaz responsive y moderna

🛠️ Tecnologías Utilizadas
Backend
PHP 7.4+ - Lenguaje de programación principal

Sesiones PHP - Para persistencia de datos entre recargas

Algoritmos de Grafos - Implementación personalizada sin dependencias externas

Frontend
HTML5 - Estructura semántica de la aplicación

CSS3 - Estilos personalizados con tema rojo, negro y blanco

JavaScript Vanilla - Interactividad del mapa y validaciones

Responsive Design - Compatible con dispositivos móviles y tablets

Arquitectura
Patrón MVC - Separación clara de responsabilidades

Programación Orientada a Objetos - Diseño modular y extensible

Git - Control de versiones

🚀 Instalación y Configuración
Requisitos del Sistema
PHP 7.4 o superior

Servidor web (Apache, Nginx, o PHP built-in server)

Navegador web moderno (Chrome, Firefox, Edge, Safari)

128MB de RAM mínimo recomendado

Pasos de Instalación Detallados
Opción 1: Usando el servidor integrado de PHP
bash
# 1. Clonar el repositorio
git clone https://github.com/MillionaireD/Sistema-rutas-panama.git
cd Sistema-rutas-panama

# 2. Iniciar servidor PHP
php -S localhost:8000

# 3. Acceder en el navegador
# http://localhost:8000
Opción 2: Usando XAMPP/WAMP/MAMP
bash
# 1. Copiar la carpeta del proyecto a:
# XAMPP: C:\xampp\htdocs\
# WAMP: C:\wamp\www\
# MAMP: /Applications/MAMP/htdocs/

# 2. Renombrar carpeta a 'sistema-rutas'

# 3. Acceder en el navegador
# http://localhost/sistema-rutas
Opción 3: Configuración manual con Apache
apache
# En el archivo httpd.conf o .htaccess
<Directory "/ruta/a/tu/proyecto">
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
Verificación de la Instalación
Accede a la aplicación en tu navegador

Verifica que aparezca el título "Sistema de Gestión de Rutas - Panamá"

Confirma que la lista de ciudades se carga correctamente

Prueba la funcionalidad de búsqueda de rutas

📁 Estructura del Proyecto
text
Sistema-rutas-panama/
│
├── 📄 index.php                 # Página principal de la aplicación
├── 📁 classes/                  # Clases PHP del sistema
│   ├── 📄 Graph.php            # Clase principal del grafo
│   └── 📄 RouteManager.php     # Gestor de rutas y lógica de negocio
├── 📁 css/                      # Estilos de la aplicación
│   └── 📄 style.css            # Hoja de estilos principal
├── 📄 .gitignore               # Archivos excluidos de Git
├── 📄 LICENSE                  # Licencia MIT
└── 📄 README.md                # Este archivo de documentación
Descripción de Archivos
1. index.php
Punto de entrada principal de la aplicación

Contiene toda la interfaz de usuario

Maneja las solicitudes POST de los formularios

Integra HTML, PHP y JavaScript

2. classes/Graph.php
Implementa la estructura de datos del grafo

Contiene los algoritmos fundamentales (Dijkstra, BFS, DFS)

Maneja la lista de adyacencia y matriz de adyacencia

Proporciona métodos para manipulación del grafo

3. classes/RouteManager.php
Actúa como controlador entre la interfaz y el grafo

Gestiona las operaciones del sistema

Proporciona estadísticas y análisis del grafo

Maneja la inicialización de datos de ejemplo

4. css/style.css
Estilos personalizados con tema rojo, negro y blanco

Diseño responsive para diferentes dispositivos

Animaciones y transiciones para mejor UX

Estilos específicos para componentes visuales

🔧 Funcionalidades Detalladas
1. Gestión de Ciudades
Agregar nuevas ciudades: Interfaz simple con validación

Eliminar ciudades existentes: Con confirmación y actualización automática

Validación de nombres: Evita duplicados y nombres vacíos

2. Gestión de Conexiones
Agregar rutas: Entre ciudades existentes con distancias

Eliminar conexiones: Remove enlaces específicos del grafo

Validación de distancias: Solo valores positivos permitidos

3. Algoritmos de Búsqueda
Ruta más corta (Dijkstra): Implementación optimizada

Búsqueda en anchura (BFS): Para exploración por niveles

Búsqueda en profundidad (DFS): Para recorrido completo

4. Visualización de Datos
Lista de adyacencia: Representación textual del grafo

Matriz de adyacencia: Tabla interactiva con resaltado

Mapa interactivo: Representación gráfica de ciudades y rutas

5. Análisis del Grafo
Estadísticas básicas: Número de ciudades y conexiones

Conectividad: Verificación de grafo conexo/desconexo

Densidad: Porcentaje de conexiones respecto al máximo posible

Grados: Máximo y mínimo grado de las ciudades

⚙️ Algoritmos Implementados
1. Algoritmo de Dijkstra
Propósito: Encontrar la ruta más corta entre dos ciudades

Complejidad Temporal: O((V + E) log V)

Implementación:

php
public function shortestPath($start, $end) {
    // Usa SplPriorityQueue para eficiencia
    // Implementa relajación de aristas
    // Retorna distancia y camino óptimo
}
Características:

Manejo de caminos inexistentes

Optimización con cola de prioridad

Reconstrucción del camino óptimo

2. Búsqueda en Anchura (BFS)
Propósito: Recorrer el grafo por niveles

Complejidad Temporal: O(V + E)

Implementación:

php
public function breadthFirstSearch($start) {
    // Usa cola FIFO
    // Visita nodos por niveles
    // Retorna orden de visita
}
Aplicaciones:

Verificar conectividad del grafo

Encontrar componentes conexos

Navegación nivel por nivel

3. Búsqueda en Profundidad (DFS)
Propósito: Recorrer el grafo en profundidad

Complejidad Temporal: O(V + E)

Implementación:

php
public function depthFirstSearch($start) {
    // Implementación iterativa con stack
    // Explora ramas completamente
    // Retorna orden de visita
}
Aplicaciones:

Detectar ciclos

Orden topológico

Recorrido completo del grafo

🎨 Interfaz de Usuario
Diseño Visual
Tema de colores: Rojo, negro y blanco

Tipografía: Segoe UI para mejor legibilidad

Layout: Grid CSS moderno con flexibilidad

Componentes: Tarjetas con efectos hover y sombras

Secciones de la Interfaz
1. Cabecera Principal
Título del sistema

Subtítulo descriptivo

Información del curso

2. Panel de Control del Sistema
Botón de reinicio completo

Mensajes de estado y error

3. Mapa Interactivo
Representación visual de Panamá

Marcadores de ciudades

Líneas de conexión

Rutas resaltadas

4. Panel de Gestión
Agregar/Eliminar ciudades

Agregar/Eliminar conexiones

Formularios con validación

5. Panel de Algoritmos
Ruta más corta (Dijkstra)

Búsqueda BFS

Búsqueda DFS

Resultados detallados

6. Panel de Visualización
Lista de adyacencia con scroll

Matriz de adyacencia interactiva

Estadísticas del grafo

Características de Usabilidad
Responsive: Se adapta a móviles, tablets y desktop

Feedback visual: Mensajes de confirmación y error

Validación en tiempo real: Previene errores de entrada

Accesibilidad: Contraste adecuado y navegación clara

📊 Casos de Uso
Caso 1: Planificación de Viajes
Usuario: Turista planeando un viaje por Panamá

Pasos:

Seleccionar ciudad de origen (ej: Ciudad de Panama)

Seleccionar ciudad destino (ej: David)

Ejecutar "Buscar Ruta Más Corta"

Ver ruta óptima con distancia total

Visualizar en el mapa interactivo

Resultado: Ruta óptima con distancias y ciudades intermedias

Caso 2: Análisis de Conectividad
Usuario: Estudiante de estructuras de datos

Pasos:

Agregar nueva ciudad sin conexiones

Verificar que el grafo cambia a "Desconectado"

Ejecutar BFS desde diferentes ciudades

Analizar componentes conexos

Restaurar conectividad agregando rutas

Resultado: Comprensión práctica de conectividad en grafos

Caso 3: Comparación de Algoritmos
Usuario: Desarrollador aprendiendo algoritmos

Pasos:

Ejecutar BFS desde una ciudad

Ejecutar DFS desde la misma ciudad

Comparar órdenes de visita

Analizar diferencias en los recorridos

Probar con diferentes configuraciones del grafo

Resultado: Entendimiento de diferencias entre BFS y DFS

Caso 4: Optimización de Rutas
Usuario: Empresa de logística

Pasos:

Cargar ciudades y distancias reales

Probar diferentes combinaciones origen-destino

Analizar rutas alternativas

Verificar tiempos y distancias

Exportar resultados para análisis

Resultado: Datos para optimización de rutas de transporte

📚 Documentación Técnica
Estructura de Datos del Grafo
Representación Interna
php
class Graph {
    private $adjacencyList;  // Array asociativo de arrays
    private $nodes;          // Array de nombres de ciudades
    
    // Ejemplo de estructura:
    // [
    //   'Ciudad de Panama' => ['Colon' => 78, 'La Chorrera' => 38],
    //   'Colon' => ['Ciudad de Panama' => 78, 'El Porvenir' => 85],
    //   ...
    // ]
}
Métodos Principales
1. Manipulación del Grafo
php
// Agregar ciudad
public function addCity($city): bool

// Agregar conexión
public function addConnection($city1, $city2, $distance): bool

// Eliminar ciudad
public function removeCity($city): bool

// Eliminar conexión
public function removeConnection($city1, $city2): bool
2. Consultas y Análisis
php
// Obtener ciudades
public function getCities(): array

// Obtener conexiones de una ciudad
public function getConnections($city): array

// Verificar conectividad
public function isConnected(): bool

// Obtener grado de una ciudad
public function getDegree($city): int
3. Algoritmos
php
// Dijkstra - Ruta más corta
public function shortestPath($start, $end): array

// Búsqueda en anchura
public function breadthFirstSearch($start): array

// Búsqueda en profundidad
public function depthFirstSearch($start): array
Flujo de Datos
1. Inicialización
text
Usuario accede → RouteManager se instancia → 
Grafo se inicializa → Datos de ejemplo cargados → 
Interfaz renderizada
2. Procesamiento de Formularios
text
Usuario envía formulario → PHP procesa POST → 
RouteManager ejecuta acción → Grafo actualizado → 
Resultados guardados en sesión → Página recargada
3. Visualización de Resultados
text
Datos del grafo obtenidos → Convertidos a JSON → 
JavaScript renderiza mapa → CSS aplica estilos → 
Interfaz actualizada
Manejo de Sesiones
Almacenamiento
php
// Resultados guardados en $_SESSION
$_SESSION['shortestPath'] = $path;
$_SESSION['shortestDistance'] = $distance;
$_SESSION['dfsPath'] = $dfsResult;
$_SESSION['bfsPath'] = $bfsResult;
Persistencia
Los resultados sobreviven a recargas de página

Se mantienen hasta reinicio del sistema o cierre de navegador

Permite análisis continuo sin pérdida de datos

🔍 Validación y Manejo de Errores
Tipos de Validación
1. Validación de Entrada
php
// Nombre de ciudad no vacío
if (empty(trim($city))) {
    return ['success' => false, 'message' => '...'];
}

// Distancia positiva
if ($distance <= 0) {
    return ['success' => false, 'message' => '...'];
}

// Evitar autoconexión
if ($city1 === $city2) {
    return ['success' => false, 'message' => '...'];
}
2. Validación de Existencia
php
// Verificar que ciudades existan
if (!isset($this->adjacencyList[$city1]) || 
    !isset($this->adjacencyList[$city2])) {
    return false;
}
3. Validación de Estado
php
// Verificar ruta existente
if ($result['distance'] === INF) {
    return ['success' => false, 'message' => '...'];
}
Mensajes de Error
Errores Comunes y Soluciones
"La ciudad 'X' ya existe"

Solución: Usar un nombre diferente o eliminar la existente

"Error al agregar conexión. Verifique que ambas ciudades existan"

Solución: Asegurarse de que las ciudades estén creadas primero

"No existe ruta entre 'X' y 'Y'"

Solución: Agregar conexiones intermedias o verificar conectividad

"La distancia debe ser un número positivo"

Solución: Ingresar un valor mayor que 0

🧪 Pruebas y Verificación
Pruebas Recomendadas
1. Prueba de Funcionalidad Básica
bash
# Verificar que todas las secciones cargan
1. Acceder a la aplicación
2. Verificar título y subtítulo
3. Confirmar que aparecen 18 ciudades iniciales
4. Verificar que el mapa se renderiza
2. Prueba de Algoritmos
bash
# Probar Dijkstra
1. Seleccionar: Ciudad de Panama → David
2. Verificar ruta y distancia
3. Comparar con ruta esperada

# Probar BFS
1. Seleccionar Santiago como inicio
2. Verificar orden de visita
3. Confirmar que visita todas las ciudades conectadas

# Probar DFS
1. Seleccionar Colon como inicio
2. Comparar orden con BFS
3. Verificar que visita todas las ciudades
3. Prueba de Manejo de Errores
bash
# Probar casos límite
1. Intentar conectar ciudad consigo misma
2. Intentar agregar ciudad existente
3. Intentar eliminar ciudad inexistente
4. Probar con distancias negativas o cero
Métricas de Calidad
Cobertura de Funcionalidades
✅ Gestión de ciudades: 100%

✅ Gestión de conexiones: 100%

✅ Algoritmos: 100%

✅ Visualización: 100%

✅ Manejo de errores: 100%

Rendimiento
Tiempo de carga inicial: < 1 segundo

Tiempo de Dijkstra: O((V+E) log V)

Uso de memoria: Optimizado para hasta 100 ciudades

Responsive: Funciona en dispositivos móviles

🔄 Mantenimiento y Actualizaciones
Estructura para Nuevas Funcionalidades
1. Agregar Nuevo Algoritmo
php
// 1. Agregar método en Graph.php
public function nuevoAlgoritmo($parametros) {
    // Implementación
}

// 2. Agregar método en RouteManager.php
public function ejecutarNuevoAlgoritmo($parametros) {
    // Llamada y manejo de resultados
}

// 3. Agregar interfaz en index.php
// Formulario y visualización de resultados
2. Extender Visualizaciones
javascript
// 1. Agregar nueva función de renderizado
function nuevaVisualizacion(datos) {
    // Lógica de renderizado
}

// 2. Integrar con datos PHP
const nuevosDatos = <?php echo json_encode($datos); ?>;
nuevaVisualizacion(nuevosDatos);
Buenas Prácticas de Código
1. Convenciones de Nomenclatura
php
// Clases: PascalCase
class GraphManager

// Métodos: camelCase
public function findShortestPath()

// Variables: snake_case o camelCase
$city_list = [];
$shortestPath = [];

// Constantes: MAYÚSCULAS
const MAX_CITIES = 100;
2. Documentación de Código
php
/**
 * Calcula la ruta más corta entre dos ciudades
 * 
 * @param string $start Ciudad de inicio
 * @param string $end Ciudad destino
 * @return array ['distance' => float, 'path' => array]
 * @throws Exception Si las ciudades no existen
 */
public function shortestPath($start, $end) {
    // Implementación
}
3. Manejo de Errores
php
try {
    $result = $graph->shortestPath($start, $end);
} catch (Exception $e) {
    // Log del error
    error_log($e->getMessage());
    
    // Mensaje amigable al usuario
    return ['success' => false, 'message' => 'Error al calcular ruta'];
}
🤝 Contribuciones
Cómo Contribuir
1. Reportar Issues
Bug report: Describir problema, pasos para reproducir, resultado esperado vs actual

Feature request: Describir funcionalidad, justificación, casos de uso

Documentación: Correcciones, mejoras, ejemplos adicionales

2. Proponer Mejoras
Fork el repositorio

Crear rama para la funcionalidad

bash
git checkout -b feature/nueva-funcionalidad
Implementar cambios con commits descriptivos

bash
git commit -m "feat: agregar algoritmo de Prim para árbol de expansión mínima"
Push a la rama

bash
git push origin feature/nueva-funcionalidad
Abrir Pull Request con descripción detallada

3. Áreas de Mejora Potencial
Algoritmos adicionales: Kruskal, Floyd-Warshall, A*

Visualizaciones: Gráficos de estadísticas, animaciones de algoritmos

Exportación: CSV, JSON, PDF de rutas

API REST: Para integración con otras aplicaciones

Base de datos: Persistencia permanente con MySQL/PostgreSQL

Guía de Estilo de Código
PHP
php
// Buena práctica
class GraphManager {
    private $adjacencyList;
    
    public function addCity(string $city): bool {
        if (empty(trim($city))) {
            return false;
        }
        // Resto de la implementación
    }
}

// Evitar
class graph_manager {
    var $adjacency_list;
    
    function AddCity($city) {
        // Sin validación
        $this->adjacency_list[$city] = array();
    }
}
JavaScript
javascript
// Buena práctica
function renderMap(cities, connections) {
    const mapContainer = document.getElementById('map');
    // Implementación clara
}

// Evitar
function render_map(cities, connections) {
    // Código spaghetti
}
HTML/CSS
html
<!-- Buena práctica -->
<div class="card graph-info">
    <h2 class="section-title">Información del Grafo</h2>
</div>

<!-- Evitar -->
<DIV class="card graph_info">
    <H2>informacion del grafo</H2>
</DIV>
📄 Licencia
Este proyecto está bajo la Licencia MIT - ver el archivo LICENSE para detalles.

👥 Autores
Tu Nombre - Desarrollo inicial - TuUsuario

🙏 Agradecimientos
Universidad de Panamá - Facultad de Informática

Profesores de Estructuras de Datos

Comunidad de desarrollo PHP

Todos los contribuidores y testers

🚀 Características Técnicas Destacadas
Optimización
Lista de adyacencia para representación eficiente del grafo

SplPriorityQueue para implementación óptima de Dijkstra

Caché de resultados usando sesiones PHP

Lazy loading para la matriz de adyacencia

Seguridad
Sanitización de inputs con htmlspecialchars()

Validación de datos en servidor

Manejo de errores personalizado

Protección contra XSS

Usabilidad
Interfaz intuitiva con feedback visual

Tooltips informativos en todos los elementos

Confirmaciones para acciones destructivas

Mensajes de estado claros y descriptivos

🔧 Solución de Problemas
Problemas Comunes y Soluciones
"Error al agregar conexión. Verifique que ambas ciudades existan"

Verificar que las ciudades seleccionadas existen

Asegurarse de que no haya espacios en blanco en los nombres

Mapa no se muestra correctamente

Verificar que JavaScript esté habilitado

Revisar la consola del navegador para errores

Los resultados no persisten al recargar

Verificar que las sesiones estén habilitadas en PHP

Asegurarse de que no haya problemas con cookies

Interfaz no se ve bien en móvil

Verificar que el viewport esté configurado correctamente

Recargar la página limpiando caché (Ctrl+F5)

Requisitos de Servidor
PHP 7.4 o superior

Habilitada la extensión de sesiones

Memoria suficiente para grafos grandes (recomendado 128MB+)

📚 Recursos Adicionales
Para Aprender Más
Documentación oficial de PHP

Algoritmos de Grafos - GeeksforGeeks

Estructuras de Datos en PHP
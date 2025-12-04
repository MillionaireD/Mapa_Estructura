🗺️ Sistema de Gestión de Rutas - Panamá
📋 Descripción del Proyecto
Sistema de Gestión de Rutas es una aplicación web desarrollada en PHP que implementa un grafo no dirigido para la gestión y visualización de rutas entre ciudades de Panamá. Este proyecto fue desarrollado como parte de la materia de Estructuras de Datos y demuestra la implementación práctica de algoritmos fundamentales de grafos en un contexto real.

🎯 Objetivos del Proyecto
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

🚀 Funcionalidades
✅ Gestión completa de ciudades (agregar/eliminar)

✅ Conexiones entre ciudades con distancias configurables

✅ Cálculo de rutas más cortas usando Dijkstra

✅ Recorridos BFS y DFS desde cualquier ciudad

✅ Visualización de lista y matriz de adyacencia

✅ Mapa interactivo de Panamá

✅ Estadísticas del grafo en tiempo real

✅ Sistema de persistencia con sesiones PHP

✅ Interfaz responsive y moderna

🏙️ Ciudades Incluidas
El sistema viene preconfigurado con 18 ciudades principales de Panamá:

Ciudad de Panama

Colon

David

Santiago

Chitre

La Chorrera

Penonome

Aguadulce

Anton

Arraijan

Capira

Changuinola

Puerto Armuelles

Almirante

Bocas del Toro

El Porvenir

Las Tablas

Pedregal

🛠️ Tecnologías Utilizadas
Backend
PHP 7.4+ - Lenguaje de programación principal

Sesiones PHP - Para persistencia de datos

Algoritmos de Grafos - Implementación personalizada

Frontend
HTML5 - Estructura de la aplicación

CSS3 - Estilos personalizados (tema rojo, negro y blanco)

JavaScript Vanilla - Interactividad del mapa

Responsive Design - Compatible con dispositivos móviles

Estructura del Proyecto
text
sistema-rutas-panama/
│
├── index.php                 # Página principal de la aplicación
├── classes/
│   ├── Graph.php            # Clase principal del grafo
│   └── RouteManager.php     # Gestor de rutas y lógica de negocio
├── css/
│   └── style.css            # Estilos CSS personalizados
└── README.md                # Documentación del proyecto
🚀 Instalación y Configuración
Requisitos del Sistema
PHP 7.4 o superior

Servidor web (Apache, Nginx, o PHP built-in server)

Navegador web moderno (Chrome, Firefox, Edge)

Pasos de Instalación
Clonar el repositorio:

bash
git clone https://github.com/tu-usuario/sistema-rutas-panama.git
cd sistema-rutas-panama
Configurar el entorno:

bash
# Opción 1: Usar el servidor integrado de PHP
php -S localhost:8000

# Opción 2: Usar XAMPP/WAMP/MAMP
# Copiar la carpeta al directorio htdocs/www del servidor
Acceder a la aplicación:

Abrir navegador web

Visitar: http://localhost:8000

Estructura de archivos: Asegurarse de que los archivos estén organizados así:

text
sistema-rutas-panama/
├── index.php
├── classes/
│   ├── Graph.php
│   └── RouteManager.php
└── css/
    └── style.css
🧩 Arquitectura del Sistema
Graph.php - Clase del Grafo
php
class Graph {
    // Propiedades
    private $adjacencyList;  // Lista de adyacencia
    private $nodes;          // Array de ciudades
    
    // Métodos principales
    public function addCity($city);          // Agregar ciudad
    public function addConnection($c1, $c2); // Agregar conexión
    public function shortestPath($start, $end); // Dijkstra
    public function breadthFirstSearch($start); // BFS
    public function depthFirstSearch($start);   // DFS
    public function isConnected();            // Verificar conectividad
}
RouteManager.php - Controlador Principal
php
class RouteManager {
    private $graph;
    
    // Funcionalidades expuestas
    public function findShortestPath($start, $end);
    public function performBFS($start);
    public function performDFS($start);
    public function getGraphStatistics();
    public function resetSystem();
}
📊 Algoritmos Implementados
1. Dijkstra - Ruta Más Corta
Complejidad: O((V + E) log V)

php
public function shortestPath($start, $end) {
    // Implementación con SplPriorityQueue
    // Retorna: distancia y camino óptimo
}
2. BFS - Recorrido en Anchura
Complejidad: O(V + E)

php
public function breadthFirstSearch($start) {
    // Usa cola FIFO para exploración por niveles
    // Retorna orden de visita de ciudades
}
3. DFS - Recorrido en Profundidad
Complejidad: O(V + E)

php
public function depthFirstSearch($start) {
    // Implementación iterativa con stack
    // Retorna orden de visita en profundidad
}
🎨 Interfaz de Usuario
Diseño Visual
Tema de colores: Rojo, negro y blanco

Layout: Grid CSS moderno

Componentes: Tarjetas con efectos hover

Responsive: Se adapta a móviles y tablets

Secciones Principales
Información del Grafo - Estadísticas en tiempo real

Gestión de Ciudades - Agregar/eliminar ciudades

Gestión de Conexiones - Agregar/eliminar rutas

Algoritmos - Dijkstra, BFS y DFS

Visualización - Lista y matriz de adyacencia

Mapa Interactivo - Representación gráfica

📈 Métricas del Proyecto
✅ 18 ciudades preconfiguradas

✅ 21 conexiones iniciales

✅ 3 algoritmos implementados

✅ 2 representaciones del grafo

✅ 100% código PHP nativo

✅ 0 dependencias externas

🧪 Casos de Uso
Ejemplo 1: Calcular Ruta Más Corta
php
$routeManager = new RouteManager();
$result = $routeManager->findShortestPath('Ciudad de Panama', 'David');
// Resultado: Ruta óptima con distancia total
Ejemplo 2: Realizar Recorrido BFS
php
$bfsResult = $routeManager->performBFS('Santiago');
// Resultado: Orden de visita usando BFS
Ejemplo 3: Obtener Estadísticas
php
$stats = $routeManager->getGraphStatistics();
// Incluye: ciudades, conexiones, densidad, grados
🔍 Validación y Pruebas
El sistema incluye validación para:

✅ Nombres de ciudades no vacíos

✅ Distancias positivas

✅ Evitar conexiones reflexivas

✅ Verificación de existencia de ciudades

✅ Manejo de grafos desconectados

🎓 Aplicación Académica
Conceptos Demostrados
Estructuras de Datos: Grafos, listas, matrices

Algoritmos: Dijkstra, BFS, DFS

POO en PHP: Clases, encapsulamiento, herencia

Interfaz Web: HTML, CSS, JavaScript integrado

Arquitectura MVC: Separación de responsabilidades

Competencias Desarrolladas
Análisis: Diseño de estructuras de datos eficientes

Implementación: Codificación de algoritmos complejos

Interfaz: Creación de interfaces de usuario intuitivas

Integración: Conexión entre backend y frontend

Documentación: Explicación clara de funcionalidades

🤝 Contribuciones
Las contribuciones son bienvenidas. Por favor:

Fork el proyecto

Crea una rama para tu feature (git checkout -b feature/AmazingFeature)

Commit tus cambios (git commit -m 'Add some AmazingFeature')

Push a la rama (git push origin feature/AmazingFeature)

Abre un Pull Request

📄 Licencia
Este proyecto está bajo la Licencia MIT - ver el archivo LICENSE para detalles.

👥 Autores
Miguel Lasprilla - Desarrollo inicial - @MillionaireD
Ricardo Justiniani - Desarrollo complementario

🙏 Agradecimientos
Universidad de Panamá - Facultad de Informática

Profesor de Estructuras de Datos

Comunidad de desarrollo PHP

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

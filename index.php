<?php
session_start();
require_once 'classes/Graph.php';
require_once 'classes/RouteManager.php';

$routeManager = new RouteManager();
$message = '';
$messageType = '';

$shortestPath = $_SESSION['shortestPath'] ?? [];
$shortestDistance = $_SESSION['shortestDistance'] ?? 0;
$dfsPath = $_SESSION['dfsPath'] ?? [];
$bfsPath = $_SESSION['bfsPath'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset_system'])) {
        $result = $routeManager->resetSystem();
        $message = $result['message'];
        $messageType = $result['success'] ? 'success' : 'error';
        
        unset($_SESSION['shortestPath']);
        unset($_SESSION['shortestDistance']);
        unset($_SESSION['dfsPath']);
        unset($_SESSION['bfsPath']);
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    elseif (isset($_POST['add_city'])) {
        $city = trim($_POST['city_name']);
        $result = $routeManager->addCity($city);
        $message = $result['message'];
        $messageType = $result['success'] ? 'success' : 'error';
    }
    elseif (isset($_POST['remove_city'])) {
        $city = $_POST['city_to_remove'];
        $result = $routeManager->removeCity($city);
        $message = $result['message'];
        $messageType = $result['success'] ? 'success' : 'error';
    }
    elseif (isset($_POST['add_connection'])) {
        $city1 = $_POST['connection_city1'];
        $city2 = $_POST['connection_city2'];
        $distance = intval($_POST['distance']);
        $result = $routeManager->addConnection($city1, $city2, $distance);
        $message = $result['message'];
        $messageType = $result['success'] ? 'success' : 'error';
    }
    elseif (isset($_POST['remove_connection'])) {
        $city1 = $_POST['remove_connection_city1'];
        $city2 = $_POST['remove_connection_city2'];
        $result = $routeManager->removeConnection($city1, $city2);
        $message = $result['message'];
        $messageType = $result['success'] ? 'success' : 'error';
    }
    elseif (isset($_POST['find_path'])) {
        $start = $_POST['path_start'];
        $end = $_POST['path_end'];
        $result = $routeManager->findShortestPath($start, $end);
        $message = $result['message'];
        $messageType = $result['success'] ? 'success' : 'error';
        
        if ($result['success']) {
            $shortestPath = $result['path'];
            $shortestDistance = $result['distance'];
            $_SESSION['shortestPath'] = $shortestPath;
            $_SESSION['shortestDistance'] = $shortestDistance;
        }
    }
    elseif (isset($_POST['perform_dfs'])) {
        $start = $_POST['dfs_start'];
        $result = $routeManager->performDFS($start);
        $message = $result['message'];
        $messageType = $result['success'] ? 'success' : 'error';
        
        if ($result['success']) {
            $dfsPath = $result['path'];
            $_SESSION['dfsPath'] = $dfsPath;
        }
    }
    elseif (isset($_POST['perform_bfs'])) {
        $start = $_POST['bfs_start'];
        $result = $routeManager->performBFS($start);
        $message = $result['message'];
        $messageType = $result['success'] ? 'success' : 'error';
        
        if ($result['success']) {
            $bfsPath = $result['path'];
            $_SESSION['bfsPath'] = $bfsPath;
        }
    }
}

$cities = $routeManager->getCities();
$adjacencyList = $routeManager->getAdjacencyList();
$adjacencyMatrix = $routeManager->getAdjacencyMatrix();
$graphStats = $routeManager->getGraphStatistics();
$cityCoordinates = $routeManager->getCityCoordinates();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Rutas - Panamá</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Sistema de Gestión de Rutas - Panamá</h1>
            <p class="subtitle">Grafo no dirigido con algoritmos BFS, DFS y Dijkstra</p>
            <div class="course-info">
                Proyecto de Estructuras de Datos
            </div>
        </header>
        
        <div class="content">
            <div class="card system-controls">
                <h2>Controles del Sistema</h2>
                <form method="post">
                    <button type="submit" name="reset_system" class="btn btn-danger" 
                            onclick="return confirm('¿Estás seguro de que quieres reiniciar el sistema? Se perderán todos los cambios.')">
                        Reiniciar Sistema Completo
                    </button>
                </form>
            </div>

            <?php if (!empty($message)): ?>
                <div class="message <?php echo $messageType; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <!-- Mapa Interactivo -->
            <div class="card map-container">
                <h2>Mapa de Panamá</h2>
                <div class="map-controls">
                    <button onclick="clearMap()" class="btn btn-warning">Limpiar Mapa</button>
                    <button onclick="updateMap()" class="btn btn-primary">Actualizar Mapa</button>
                </div>
                <div id="panamaMap">
                    <!-- Mapa se renderiza aquí -->
                </div>
            </div>
            
            <div class="dashboard">
                <div class="card graph-info">
                    <h2>Información del Grafo</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Total de Ciudades:</span>
                            <span class="value"><?php echo $graphStats['totalCities']; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Total de Conexiones:</span>
                            <span class="value"><?php echo $graphStats['totalConnections']; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Estado del Grafo:</span>
                            <span class="value <?php echo $graphStats['connected'] ? 'connected' : 'disconnected'; ?>">
                                <?php echo $graphStats['connected'] ? 'Conectado' : 'Desconectado'; ?>
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="label">Densidad:</span>
                            <span class="value"><?php echo $graphStats['density']; ?>%</span>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <h2>Agregar Ciudad</h2>
                    <form method="post" class="form">
                        <input type="text" name="city_name" placeholder="Nombre de la ciudad" required>
                        <button type="submit" name="add_city" class="btn btn-primary">Agregar Ciudad</button>
                    </form>
                </div>
                
                <div class="card">
                    <h2>Eliminar Ciudad</h2>
                    <form method="post" class="form">
                        <select name="city_to_remove" required>
                            <option value="">Seleccione una ciudad</option>
                            <?php foreach ($cities as $city): ?>
                                <option value="<?php echo htmlspecialchars($city); ?>">
                                    <?php echo htmlspecialchars($city); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" name="remove_city" class="btn btn-danger">Eliminar Ciudad</button>
                    </form>
                </div>
                
                <div class="card">
                    <h2>Agregar Conexión</h2>
                    <form method="post" class="form">
                        <div class="form-row">
                            <select name="connection_city1" required>
                                <option value="">Ciudad 1</option>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?php echo htmlspecialchars($city); ?>">
                                        <?php echo htmlspecialchars($city); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <select name="connection_city2" required>
                                <option value="">Ciudad 2</option>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?php echo htmlspecialchars($city); ?>">
                                        <?php echo htmlspecialchars($city); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="number" name="distance" placeholder="Distancia (km)" min="1" required>
                        </div>
                        <button type="submit" name="add_connection" class="btn btn-primary">Agregar Conexión</button>
                    </form>
                </div>
                
                <div class="card">
                    <h2>Eliminar Conexión</h2>
                    <form method="post" class="form">
                        <div class="form-row">
                            <select name="remove_connection_city1" required>
                                <option value="">Ciudad 1</option>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?php echo htmlspecialchars($city); ?>">
                                        <?php echo htmlspecialchars($city); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <select name="remove_connection_city2" required>
                                <option value="">Ciudad 2</option>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?php echo htmlspecialchars($city); ?>">
                                        <?php echo htmlspecialchars($city); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" name="remove_connection" class="btn btn-danger">Eliminar Conexión</button>
                    </form>
                </div>
                
                <div class="card">
                    <h2>Ruta Más Corta</h2>
                    <form method="post" class="form">
                        <div class="form-row">
                            <select name="path_start" required>
                                <option value="">Ciudad inicio</option>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?php echo htmlspecialchars($city); ?>">
                                        <?php echo htmlspecialchars($city); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <select name="path_end" required>
                                <option value="">Ciudad destino</option>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?php echo htmlspecialchars($city); ?>">
                                        <?php echo htmlspecialchars($city); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" name="find_path" class="btn btn-success">Buscar Ruta Más Corta</button>
                    </form>
                    
                    <?php if (!empty($shortestPath)): ?>
                        <div class="result">
                            <h3>Ruta Encontrada:</h3>
                            <p><strong>Ruta:</strong> <?php echo implode(' → ', $shortestPath); ?></p>
                            <p><strong>Distancia Total:</strong> <?php echo $shortestDistance; ?> km</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="card">
                    <h2>Búsqueda en Profundidad (DFS)</h2>
                    <form method="post" class="form">
                        <select name="dfs_start" required>
                            <option value="">Ciudad inicio</option>
                            <?php foreach ($cities as $city): ?>
                                <option value="<?php echo htmlspecialchars($city); ?>">
                                    <?php echo htmlspecialchars($city); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" name="perform_dfs" class="btn btn-info">Ejecutar DFS</button>
                    </form>
                    
                    <?php if (!empty($dfsPath)): ?>
                        <div class="result">
                            <h3>Recorrido DFS:</h3>
                            <p><?php echo implode(' → ', $dfsPath); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="card">
                    <h2>Búsqueda en Anchura (BFS)</h2>
                    <form method="post" class="form">
                        <select name="bfs_start" required>
                            <option value="">Ciudad inicio</option>
                            <?php foreach ($cities as $city): ?>
                                <option value="<?php echo htmlspecialchars($city); ?>">
                                    <?php echo htmlspecialchars($city); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" name="perform_bfs" class="btn btn-info">Ejecutar BFS</button>
                    </form>
                    
                    <?php if (!empty($bfsPath)): ?>
                        <div class="result">
                            <h3>Recorrido BFS:</h3>
                            <p><?php echo implode(' → ', $bfsPath); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="visualization">
                <div class="card">
                    <h2>Lista de Adyacencia</h2>
                    <div class="adjacency-list">
                        <?php if (empty($adjacencyList)): ?>
                            <p class="no-data">No hay ciudades en el grafo</p>
                        <?php else: ?>
                            <?php foreach ($adjacencyList as $city => $connections): ?>
                                <div class="city-node">
                                    <strong><?php echo htmlspecialchars($city); ?></strong>
                                    <?php if (empty($connections)): ?>
                                        <span class="no-connections">Sin conexiones</span>
                                    <?php else: ?>
                                        <div>
                                            <?php 
                                            $connectionStrings = [];
                                            foreach ($connections as $neighbor => $distance) {
                                                $connectionStrings[] = "{$neighbor} ({$distance} km)";
                                            }
                                            echo implode(', ', $connectionStrings);
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <small>Grado: <?php echo count($connections); ?></small>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="card">
                    <h2>Matriz de Adyacencia</h2>
                    <div class="matrix-container">
                        <?php if (empty($adjacencyMatrix)): ?>
                            <p class="no-data">No hay ciudades en el grafo</p>
                        <?php else: ?>
                            <table class="adjacency-matrix">
                                <thead>
                                    <tr>
                                        <th>Ciudad</th>
                                        <?php foreach ($cities as $city): ?>
                                            <th title="<?php echo htmlspecialchars($city); ?>">
                                                <?php 
                                                echo strlen($city) > 10 ? 
                                                    htmlspecialchars(substr($city, 0, 8)) . '...' : 
                                                    htmlspecialchars($city); 
                                                ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cities as $city1): ?>
                                        <tr>
                                            <th title="<?php echo htmlspecialchars($city1); ?>">
                                                <?php 
                                                echo strlen($city1) > 10 ? 
                                                    htmlspecialchars(substr($city1, 0, 8)) . '...' : 
                                                    htmlspecialchars($city1); 
                                                ?>
                                            </th>
                                            <?php foreach ($cities as $city2): ?>
                                                <td class="<?php echo $adjacencyMatrix[$city1][$city2] > 0 ? 'connected' : 'disconnected'; ?>"
                                                    title="<?php echo $city1 . ' → ' . $city2 . ': ' . $adjacencyMatrix[$city1][$city2] . ' km'; ?>">
                                                    <?php echo $adjacencyMatrix[$city1][$city2]; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <footer>
            <p>Sistema de Gestión de Rutas - Panamá &copy; 2025 | Proyecto de Estructuras de Datos</p>
        </footer>
    </div>

    <script>
        // Datos para el mapa
        const cityCoordinates = <?php echo json_encode($cityCoordinates); ?>;
        const adjacencyList = <?php echo json_encode($adjacencyList); ?>;
        const shortestPath = <?php echo json_encode($shortestPath); ?>;

        function renderMap() {
            const map = document.getElementById('panamaMap');
            map.innerHTML = '';

            // Dibujar conexiones
            Object.keys(adjacencyList).forEach(city1 => {
                Object.keys(adjacencyList[city1]).forEach(city2 => {
                    if (cityCoordinates[city1] && cityCoordinates[city2]) {
                        drawConnection(city1, city2, adjacencyList[city1][city2]);
                    }
                });
            });

            // Dibujar ciudades
            Object.keys(cityCoordinates).forEach(city => {
                if (cityCoordinates[city]) {
                    drawCity(city, cityCoordinates[city].x, cityCoordinates[city].y);
                }
            });

            // Dibujar ruta más corta si existe
            if (shortestPath.length > 0) {
                drawShortestPath();
            }
        }

        function drawCity(city, x, y) {
            const map = document.getElementById('panamaMap');
            const marker = document.createElement('div');
            marker.className = 'city-marker';
            marker.style.left = x + '%';
            marker.style.top = y + '%';
            marker.title = city;
            marker.onclick = () => selectCity(city);
            map.appendChild(marker);

            // Etiqueta
            const label = document.createElement('div');
            label.className = 'city-label';
            label.textContent = city;
            label.style.left = (x + 2) + '%';
            label.style.top = (y + 2) + '%';
            map.appendChild(label);
        }

        function drawConnection(city1, city2, distance) {
            const coords1 = cityCoordinates[city1];
            const coords2 = cityCoordinates[city2];
            
            if (!coords1 || !coords2) return;

            const map = document.getElementById('panamaMap');
            const line = document.createElement('div');
            line.className = 'connection-line';
            
            const dx = coords2.x - coords1.x;
            const dy = coords2.y - coords1.y;
            const length = Math.sqrt(dx * dx + dy * dy);
            const angle = Math.atan2(dy, dx) * 180 / Math.PI;

            line.style.width = length + '%';
            line.style.left = coords1.x + '%';
            line.style.top = coords1.y + '%';
            line.style.transform = 'rotate(' + angle + 'deg)';
            line.title = city1 + ' - ' + city2 + ': ' + distance + ' km';
            
            map.appendChild(line);
        }

        function drawShortestPath() {
            for (let i = 0; i < shortestPath.length - 1; i++) {
                const city1 = shortestPath[i];
                const city2 = shortestPath[i + 1];
                const coords1 = cityCoordinates[city1];
                const coords2 = cityCoordinates[city2];
                
                if (coords1 && coords2) {
                    const map = document.getElementById('panamaMap');
                    const pathLine = document.createElement('div');
                    pathLine.className = 'path-line';
                    
                    const dx = coords2.x - coords1.x;
                    const dy = coords2.y - coords1.y;
                    const length = Math.sqrt(dx * dx + dy * dy);
                    const angle = Math.atan2(dy, dx) * 180 / Math.PI;

                    pathLine.style.width = length + '%';
                    pathLine.style.left = coords1.x + '%';
                    pathLine.style.top = coords1.y + '%';
                    pathLine.style.transform = 'rotate(' + angle + 'deg)';
                    
                    map.appendChild(pathLine);
                }
            }
        }

        function selectCity(city) {
            // Llenar selects automáticamente
            const selects = document.querySelectorAll('select');
            selects.forEach(select => {
                if (!select.value) {
                    for (let option of select.options) {
                        if (option.text === city) {
                            select.value = option.value;
                            break;
                        }
                    }
                }
            });
        }

        function clearMap() {
            const map = document.getElementById('panamaMap');
            map.innerHTML = '';
        }

        function updateMap() {
            renderMap();
        }

        // Inicializar mapa cuando cargue la página
        document.addEventListener('DOMContentLoaded', renderMap);
    </script>
</body>
</html>
<?php
/**
 * Clase RouteManager - Gestor de rutas con ciudades de Panamá
 */
class RouteManager {
    private $graph;
    
    public function __construct() {
        $this->graph = new Graph();
        $this->initializePanamaData();
    }
    
    private function initializePanamaData() {
        $panamaCities = [
            'Ciudad de Panama', 'Colon', 'David', 'Santiago', 
            'Chitre', 'La Chorrera', 'Penonome', 'Aguadulce',
            'Anton', 'Arraijan', 'Capira', 'Changuinola',
            'Puerto Armuelles', 'Almirante', 'Bocas del Toro',
            'El Porvenir', 'Las Tablas', 'Pedregal'
        ];
        
        foreach ($panamaCities as $city) {
            $this->graph->addCity($city);
        }
        
        $connections = [
            ['Ciudad de Panama', 'Colon', 78],
            ['Ciudad de Panama', 'La Chorrera', 38],
            ['Ciudad de Panama', 'Arraijan', 22],
            ['La Chorrera', 'Capira', 20],
            ['Capira', 'Santiago', 180],
            ['Santiago', 'David', 120],
            ['Santiago', 'Chitre', 45],
            ['Santiago', 'Penonome', 35],
            ['Penonome', 'Aguadulce', 25],
            ['Penonome', 'Anton', 15],
            ['Aguadulce', 'Chitre', 30],
            ['David', 'Puerto Armuelles', 55],
            ['David', 'Pedregal', 8],
            ['Changuinola', 'Almirante', 15],
            ['Changuinola', 'Bocas del Toro', 12],
            ['Bocas del Toro', 'Almirante', 25],
            ['Colon', 'El Porvenir', 85],
            ['Chitre', 'Las Tablas', 40],
            ['Arraijan', 'La Chorrera', 18],
            ['El Porvenir', 'Bocas del Toro', 120],
            ['Las Tablas', 'Aguadulce', 35]
        ];
        
        foreach ($connections as $connection) {
            $this->graph->addConnection($connection[0], $connection[1], $connection[2]);
        }
    }
    
    public function addCity($city) {
        if (empty(trim($city))) {
            return ['success' => false, 'message' => 'El nombre de la ciudad no puede estar vacío'];
        }
        
        $result = $this->graph->addCity(trim($city));
        
        if ($result) {
            return ['success' => true, 'message' => "Ciudad '$city' agregada correctamente"];
        } else {
            return ['success' => false, 'message' => "La ciudad '$city' ya existe"];
        }
    }
    
    public function removeCity($city) {
        $result = $this->graph->removeCity($city);
        
        if ($result) {
            return ['success' => true, 'message' => "Ciudad '$city' eliminada correctamente"];
        } else {
            return ['success' => false, 'message' => "La ciudad '$city' no existe"];
        }
    }
    
    public function addConnection($city1, $city2, $distance) {
        if ($city1 === $city2) {
            return ['success' => false, 'message' => 'No se puede conectar una ciudad consigo misma'];
        }
        
        if ($distance <= 0) {
            return ['success' => false, 'message' => 'La distancia debe ser un número positivo'];
        }
        
        $result = $this->graph->addConnection($city1, $city2, $distance);
        
        if ($result) {
            return ['success' => true, 'message' => "Conexión entre '$city1' y '$city2' agregada correctamente"];
        } else {
            return ['success' => false, 'message' => "Error al agregar conexión. Verifique que ambas ciudades existan"];
        }
    }
    
    public function removeConnection($city1, $city2) {
        $result = $this->graph->removeConnection($city1, $city2);
        
        if ($result) {
            return ['success' => true, 'message' => "Conexión entre '$city1' y '$city2' eliminada correctamente"];
        } else {
            return ['success' => false, 'message' => "Error al eliminar conexión. Verifique que exista"];
        }
    }
    
    public function findShortestPath($start, $end) {
        if ($start === $end) {
            return [
                'success' => false,
                'message' => 'La ciudad de inicio y destino deben ser diferentes'
            ];
        }
        
        $result = $this->graph->shortestPath($start, $end);
        
        if ($result['distance'] === INF) {
            return [
                'success' => false,
                'message' => "No existe ruta entre '$start' y '$end'"
            ];
        }
        
        return [
            'success' => true,
            'distance' => $result['distance'],
            'path' => $result['path'],
            'message' => "Ruta más corta: " . implode(' → ', $result['path']) . " (Distancia: " . $result['distance'] . " km)"
        ];
    }
    
    public function performDFS($start) {
        $result = $this->graph->depthFirstSearch($start);
        
        if (empty($result)) {
            return [
                'success' => false,
                'message' => "La ciudad '$start' no existe"
            ];
        }
        
        return [
            'success' => true,
            'path' => $result,
            'message' => "DFS desde '$start': " . implode(' → ', $result)
        ];
    }
    
    public function performBFS($start) {
        $result = $this->graph->breadthFirstSearch($start);
        
        if (empty($result)) {
            return [
                'success' => false,
                'message' => "La ciudad '$start' no existe"
            ];
        }
        
        return [
            'success' => true,
            'path' => $result,
            'message' => "BFS desde '$start': " . implode(' → ', $result)
        ];
    }
    
    public function getConnectivityInfo() {
        $components = $this->graph->getConnectedComponents();
        $isConnected = $this->graph->isConnected();
        
        return [
            'isConnected' => $isConnected,
            'components' => $components,
            'componentCount' => count($components),
            'largestComponent' => $isConnected ? count($this->graph->getCities()) : max(array_map('count', $components))
        ];
    }
    
    public function getGraphStatistics() {
        $cities = $this->graph->getCities();
        $totalConnections = 0;
        $maxDegree = 0;
        $minDegree = PHP_INT_MAX;
        $cityWithMaxDegree = '';
        $cityWithMinDegree = '';
        
        foreach ($cities as $city) {
            $degree = $this->graph->getDegree($city);
            $totalConnections += $degree;
            
            if ($degree > $maxDegree) {
                $maxDegree = $degree;
                $cityWithMaxDegree = $city;
            }
            
            if ($degree < $minDegree) {
                $minDegree = $degree;
                $cityWithMinDegree = $city;
            }
        }
        
        $actualConnections = $totalConnections / 2;
        $totalPossibleConnections = count($cities) * (count($cities) - 1) / 2;
        $density = $totalPossibleConnections > 0 ? $actualConnections / $totalPossibleConnections : 0;
        
        $connectivityInfo = $this->getConnectivityInfo();
        
        return [
            'totalCities' => count($cities),
            'totalConnections' => $actualConnections,
            'density' => round($density * 100, 2),
            'maxDegree' => $maxDegree,
            'minDegree' => $minDegree,
            'cityWithMaxDegree' => $cityWithMaxDegree,
            'cityWithMinDegree' => $cityWithMinDegree,
            'connected' => $connectivityInfo['isConnected'],
            'componentCount' => $connectivityInfo['componentCount'],
            'largestComponent' => $connectivityInfo['largestComponent']
        ];
    }
    
    public function getAdjacencyList() {
        return $this->graph->getAdjacencyList();
    }
    
    public function getAdjacencyMatrix() {
        return $this->graph->getAdjacencyMatrix();
    }
    
    public function getCities() {
        return $this->graph->getCities();
    }
    
    public function getCityCoordinates() {
        return [
            'Ciudad de Panama' => ['x' => 75, 'y' => 45],
            'Colon' => ['x' => 45, 'y' => 30],
            'David' => ['x' => 15, 'y' => 70],
            'Santiago' => ['x' => 35, 'y' => 55],
            'Chitre' => ['x' => 45, 'y' => 65],
            'La Chorrera' => ['x' => 65, 'y' => 40],
            'Penonome' => ['x' => 50, 'y' => 50],
            'Aguadulce' => ['x' => 40, 'y' => 60],
            'Anton' => ['x' => 55, 'y' => 50],
            'Arraijan' => ['x' => 70, 'y' => 35],
            'Capira' => ['x' => 60, 'y' => 45],
            'Changuinola' => ['x' => 20, 'y' => 25],
            'Puerto Armuelles' => ['x' => 10, 'y' => 80],
            'Almirante' => ['x' => 25, 'y' => 30],
            'Bocas del Toro' => ['x' => 15, 'y' => 20],
            'El Porvenir' => ['x' => 30, 'y' => 15],
            'Las Tablas' => ['x' => 50, 'y' => 70],
            'Pedregal' => ['x' => 18, 'y' => 75]
        ];
    }
    
    public function resetSystem() {
        $this->graph->reset();
        $this->initializePanamaData();
        return ['success' => true, 'message' => 'Sistema reiniciado correctamente'];
    }
}
?>
<?php
/**
 * Clase Graph - Implementa un grafo no dirigido para gestión de rutas
 */
class Graph {
    private $adjacencyList;
    private $nodes;
    
    public function __construct() {
        $this->adjacencyList = [];
        $this->nodes = [];
    }
    
    public function addCity($city) {
        $city = trim($city);
        if (isset($this->adjacencyList[$city]) || empty($city)) {
            return false;
        }
        
        $this->adjacencyList[$city] = [];
        $this->nodes[] = $city;
        return true;
    }
    
    public function removeCity($city) {
        if (!isset($this->adjacencyList[$city])) {
            return false;
        }
        
        foreach ($this->adjacencyList[$city] as $neighbor => $distance) {
            unset($this->adjacencyList[$neighbor][$city]);
        }
        
        unset($this->adjacencyList[$city]);
        
        $key = array_search($city, $this->nodes);
        if ($key !== false) {
            unset($this->nodes[$key]);
            $this->nodes = array_values($this->nodes);
        }
        
        return true;
    }
    
    public function addConnection($city1, $city2, $distance) {
        if (!isset($this->adjacencyList[$city1]) || !isset($this->adjacencyList[$city2])) {
            return false;
        }
        
        $this->adjacencyList[$city1][$city2] = $distance;
        $this->adjacencyList[$city2][$city1] = $distance;
        return true;
    }
    
    public function removeConnection($city1, $city2) {
        if (!isset($this->adjacencyList[$city1]) || !isset($this->adjacencyList[$city2])) {
            return false;
        }
        
        unset($this->adjacencyList[$city1][$city2]);
        unset($this->adjacencyList[$city2][$city1]);
        
        return true;
    }
    
    public function getCities() {
        return $this->nodes;
    }
    
    public function getConnections($city) {
        return isset($this->adjacencyList[$city]) ? $this->adjacencyList[$city] : [];
    }
    
    public function getAdjacencyList() {
        return $this->adjacencyList;
    }
    
    public function getAdjacencyMatrix() {
        $matrix = [];
        $cities = $this->getCities();
        
        foreach ($cities as $city1) {
            foreach ($cities as $city2) {
                $matrix[$city1][$city2] = 0;
            }
        }
        
        foreach ($this->adjacencyList as $city => $connections) {
            foreach ($connections as $neighbor => $distance) {
                $matrix[$city][$neighbor] = $distance;
            }
        }
        
        return $matrix;
    }
    
    public function depthFirstSearch($start) {
        if (!isset($this->adjacencyList[$start])) {
            return [];
        }
        
        $visited = [];
        $stack = [$start];
        
        while (!empty($stack)) {
            $current = array_pop($stack);
            
            if (!in_array($current, $visited)) {
                $visited[] = $current;
                
                foreach ($this->adjacencyList[$current] as $neighbor => $distance) {
                    if (!in_array($neighbor, $visited)) {
                        $stack[] = $neighbor;
                    }
                }
            }
        }
        
        return $visited;
    }
    
    public function breadthFirstSearch($start) {
        if (!isset($this->adjacencyList[$start])) {
            return [];
        }
        
        $visited = [$start];
        $queue = [$start];
        
        while (!empty($queue)) {
            $current = array_shift($queue);
            
            foreach ($this->adjacencyList[$current] as $neighbor => $distance) {
                if (!in_array($neighbor, $visited)) {
                    $visited[] = $neighbor;
                    $queue[] = $neighbor;
                }
            }
        }
        
        return $visited;
    }
    
    public function shortestPath($start, $end) {
        if (!isset($this->adjacencyList[$start]) || !isset($this->adjacencyList[$end])) {
            return ['distance' => INF, 'path' => []];
        }
        
        $distances = [];
        $previous = [];
        $queue = new SplPriorityQueue();
        
        foreach ($this->adjacencyList as $city => $connections) {
            $distances[$city] = INF;
            $previous[$city] = null;
        }
        
        $distances[$start] = 0;
        $queue->insert($start, 0);
        
        while (!$queue->isEmpty()) {
            $current = $queue->extract();
            
            if ($current === $end) {
                break;
            }
            
            foreach ($this->adjacencyList[$current] as $neighbor => $distance) {
                $alt = $distances[$current] + $distance;
                
                if ($alt < $distances[$neighbor]) {
                    $distances[$neighbor] = $alt;
                    $previous[$neighbor] = $current;
                    $queue->insert($neighbor, -$alt);
                }
            }
        }
        
        $path = [];
        $current = $end;
        
        while ($current !== null) {
            array_unshift($path, $current);
            $current = $previous[$current];
        }
        
        if (empty($path) || $path[0] !== $start) {
            return ['distance' => INF, 'path' => []];
        }
        
        return [
            'distance' => $distances[$end],
            'path' => $path
        ];
    }
    
    public function isConnected() {
        if (empty($this->nodes)) {
            return true;
        }
        
        $visited = $this->breadthFirstSearch($this->nodes[0]);
        return count($visited) === count($this->nodes);
    }
    
    public function getConnectedComponents() {
        $visited = [];
        $components = [];
        
        foreach ($this->nodes as $city) {
            if (!in_array($city, $visited)) {
                $component = $this->breadthFirstSearch($city);
                $components[] = $component;
                $visited = array_merge($visited, $component);
            }
        }
        
        return $components;
    }
    
    public function getDegree($city) {
        return isset($this->adjacencyList[$city]) ? count($this->adjacencyList[$city]) : 0;
    }
    
    public function reset() {
        $this->adjacencyList = [];
        $this->nodes = [];
        return true;
    }
}
?>
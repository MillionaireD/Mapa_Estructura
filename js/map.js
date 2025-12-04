/**
 * Mapa Interactivo de Panamá - Sistema de Rutas
 * Proyecto de Estructuras de Datos
 */

class PanamaMap {
    constructor() {
        this.mapElement = document.getElementById('panamaMap');
        this.cityCoordinates = {};
        this.connections = [];
        this.currentPath = [];
        this.initializeCoordinates();
        this.init();
    }

    // Coordenadas aproximadas de las ciudades en el contenedor del mapa
    initializeCoordinates() {
        this.cityCoordinates = {
            'Ciudad de Panamá': { x: 75, y: 45 },
            'Colón': { x: 45, y: 30 },
            'David': { x: 15, y: 70 },
            'Santiago': { x: 35, y: 55 },
            'Chitré': { x: 45, y: 65 },
            'La Chorrera': { x: 65, y: 40 },
            'Penonomé': { x: 50, y: 50 },
            'Aguadulce': { x: 40, y: 60 },
            'Antón': { x: 55, y: 50 },
            'Arraiján': { x: 70, y: 35 },
            'Capira': { x: 60, y: 45 },
            'Changuinola': { x: 20, y: 25 },
            'Puerto Armuelles': { x: 10, y: 80 },
            'Almirante': { x: 25, y: 30 },
            'Bocas del Toro': { x: 15, y: 20 },
            'El Porvenir': { x: 30, y: 15 },
            'Las Tablas': { x: 50, y: 70 },
            'Pedregal': { x: 18, y: 75 }
        };
    }

    init() {
        this.renderMap();
        this.setupEventListeners();
    }

    renderMap() {
        // Limpiar mapa
        this.mapElement.innerHTML = '';
        
        // Dibujar conexiones primero (para que queden detrás de los markers)
        this.drawConnections();
        
        // Dibujar ciudades
        this.drawCities();
        
        // Dibujar ruta actual si existe
        if (this.currentPath.length > 0) {
            this.drawPath(this.currentPath);
        }
    }

    drawCities() {
        Object.keys(this.cityCoordinates).forEach(city => {
            const coords = this.cityCoordinates[city];
            const marker = document.createElement('div');
            marker.className = 'city-marker connected';
            marker.style.left = `${coords.x}%`;
            marker.style.top = `${coords.y}%`;
            marker.setAttribute('data-city', city);
            marker.setAttribute('title', city);

            // Tooltip
            marker.addEventListener('mouseenter', (e) => {
                this.showTooltip(e, city);
            });
            marker.addEventListener('mouseleave', () => {
                this.hideTooltip();
            });

            this.mapElement.appendChild(marker);
        });
    }

    drawConnections() {
        this.connections.forEach(connection => {
            const city1Coords = this.cityCoordinates[connection.city1];
            const city2Coords = this.cityCoordinates[connection.city2];
            
            if (city1Coords && city2Coords) {
                // Dibujar línea de conexión
                const line = this.createConnectionLine(city1Coords, city2Coords, connection.distance);
                this.mapElement.appendChild(line);
            }
        });
    }

    createConnectionLine(start, end, distance) {
        const dx = end.x - start.x;
        const dy = end.y - start.y;
        const length = Math.sqrt(dx * dx + dy * dy);
        const angle = Math.atan2(dy, dx) * 180 / Math.PI;

        const line = document.createElement('div');
        line.className = 'connection-line';
        line.style.left = `${start.x}%`;
        line.style.top = `${start.y}%`;
        line.style.width = `${length}%`;
        line.style.transform = `rotate(${angle}deg)`;

        // Agregar etiqueta de distancia
        const label = document.createElement('div');
        label.className = 'connection-label';
        label.style.left = `${start.x + dx/2}%`;
        label.style.top = `${start.y + dy/2}%`;
        label.textContent = `${distance}km`;

        line.appendChild(label);
        return line;
    }

    drawPath(path) {
        // Remover ruta anterior
        document.querySelectorAll('.path-line').forEach(el => el.remove());

        for (let i = 0; i < path.length - 1; i++) {
            const city1 = path[i];
            const city2 = path[i + 1];
            const city1Coords = this.cityCoordinates[city1];
            const city2Coords = this.cityCoordinates[city2];

            if (city1Coords && city2Coords) {
                const dx = city2Coords.x - city1Coords.x;
                const dy = city2Coords.y - city1Coords.y;
                const length = Math.sqrt(dx * dx + dy * dy);
                const angle = Math.atan2(dy, dx) * 180 / Math.PI;

                const pathLine = document.createElement('div');
                pathLine.className = 'path-line';
                pathLine.style.left = `${city1Coords.x}%`;
                pathLine.style.top = `${city1Coords.y}%`;
                pathLine.style.width = `${length}%`;
                pathLine.style.transform = `rotate(${angle}deg)`;

                this.mapElement.appendChild(pathLine);
            }
        }

        // Resaltar ciudades en la ruta
        document.querySelectorAll('.city-marker').forEach(marker => {
            const city = marker.getAttribute('data-city');
            if (path.includes(city)) {
                marker.style.background = '#27ae60';
                marker.style.transform = 'scale(1.3)';
            }
        });
    }

    showTooltip(event, city) {
        const tooltip = document.createElement('div');
        tooltip.className = 'map-tooltip';
        tooltip.textContent = city;
        tooltip.style.left = `${event.pageX + 10}px`;
        tooltip.style.top = `${event.pageY - 30}px`;
        tooltip.id = 'mapTooltip';

        document.body.appendChild(tooltip);
    }

    hideTooltip() {
        const tooltip = document.getElementById('mapTooltip');
        if (tooltip) {
            tooltip.remove();
        }
    }

    setupEventListeners() {
        // Event listeners para los markers de ciudades
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('city-marker')) {
                const city = e.target.getAttribute('data-city');
                this.onCityClick(city);
            }
        });
    }

    onCityClick(city) {
        // Disparar evento personalizado para que el sistema principal pueda escuchar
        const event = new CustomEvent('citySelected', { 
            detail: { city: city } 
        });
        document.dispatchEvent(event);
    }

    // Métodos públicos para actualizar el mapa
    updateConnections(adjacencyList) {
        this.connections = [];
        Object.keys(adjacencyList).forEach(city1 => {
            Object.keys(adjacencyList[city1]).forEach(city2 => {
                const distance = adjacencyList[city1][city2];
                this.connections.push({
                    city1: city1,
                    city2: city2,
                    distance: distance
                });
            });
        });
        this.renderMap();
    }

    showShortestPath(path) {
        this.currentPath = path;
        this.renderMap();
        
        // Animación especial para la ruta
        setTimeout(() => {
            document.querySelectorAll('.path-line').forEach((line, index) => {
                line.style.animationDelay = `${index * 0.2}s`;
            });
        }, 100);
    }

    clearPath() {
        this.currentPath = [];
        this.renderMap();
    }

    highlightCity(city) {
        document.querySelectorAll('.city-marker').forEach(marker => {
            if (marker.getAttribute('data-city') === city) {
                marker.style.background = '#f39c12';
                marker.style.transform = 'scale(1.5)';
                setTimeout(() => {
                    marker.style.background = '';
                    marker.style.transform = '';
                }, 2000);
            }
        });
    }
}

// Inicializar el mapa cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.panamaMap = new PanamaMap();
});


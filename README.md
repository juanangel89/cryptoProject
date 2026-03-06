Análisis de Requisitos

Requisitos Funcionales (RF)
Son las funciones que el usuario puede realizar en la aplicación.

Visualización en Tiempo Real: El sistema debe mostrar el precio actualizado de las 9 criptomonedas más importantes.

Gráficos Comparativos: El sistema debe generar un gráfico mixto que contraste el precio (línea) contra la variación porcentual de 24h (barras).

Buscador Reactivo: El usuario debe poder filtrar monedas por nombre o símbolo sin recargar la página.

Detalles Expandidos: Al interactuar con la gráfica o la lista, se deben mostrar datos técnicos como Volumen y Market Cap.

Requisitos No Funcionales (RNF)
Son las propiedades que hacen que el sistema sea profesional y eficiente.

Eficiencia de API: Implementar un sistema de caché para no exceder el límite de peticiones de CoinMarketCap.

Precisión Numérica: Manejo de hasta 2 decimales para precios y porcentajes para facilitar la lectura.

Responsividad: La interfaz debe adaptarse a diferentes tamaños de pantalla (gracias a Chart.js y CSS).

Seguridad: Uso de variables de entorno (.env) para proteger las credenciales de la API.2. 

Estructura de Datos (Data Model)Para que el proyecto fuera ligero, definimos un modelo de datos "plano" que el controlador de Laravel entrega al frontend. Esta es la estructura del objeto JSON que viaja entre el servidor y el cliente:

Campo               Tipo         Descripción
name                String       Nombre completo (ej: Bitcoin).
symbol              String       Código de mercado (ej: BTC).
logo                String(URL)  Enlace a la imagen oficial de la moneda.
price               Float        Precio actual redondeado a 2 decimales.
percent_change_24h  Float        Variación positiva o negativa del día.
market_cap          Integer      Valor total de mercado.


#!/bin/bash

# Start CakePHP development server with proper static file serving
# This script uses the router.php to serve static assets while routing dynamic requests through CakePHP

echo "Starting CakePHP development server..."
echo "Listening on http://localhost:8765"
echo ""
echo "Press Ctrl+C to stop the server"
echo ""

cd "$(dirname "$0")/webroot"
php -S localhost:8765 router.php

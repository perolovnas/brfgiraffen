#!/bin/bash

# Watch all SCSS files in the current directory and its subdirectories
sass --watch --style=compressed .:. &

# Run npm run sync
npm run sync